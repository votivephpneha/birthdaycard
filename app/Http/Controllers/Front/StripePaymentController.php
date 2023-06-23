<?php
    
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use File;
use Session;
use Illuminate\Support\Str;
use App\Models\User;
use DB,Validator;
use Hash;
use Auth;
use Mail;
use Stripe;

     
class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)
    {
        $order_id = $request->order_id;
        $data['order_data'] = DB::table('order')->where("order_id",$order_id)->get()->first();
        return view('Front/stripe')->with($data);
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        $order_data = DB::table('order')->where("order_id",$request->order_id)->get()->first();

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        $charge = Stripe\Charge::create ([
                "amount" => $order_data->total*100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment from birthdaystoreuk.co.uk" 
        ]);
        
        //print_r($charge->payment_method_details);
        $transaction_id = $charge->id;
        $user_id = session::get("user_id");
        $order_id = $request->order_id;
        $status = 1;
        $sub_total = $order_data->sub_total;
        $card_number_txn = $request->card_no;
        $payment_type = $charge->payment_method_details->card->brand;
        $total_amount = $order_data->total;
        if(!empty($charge)){
            DB::table('payment_transactions')->insert(['transaction_id'=>$transaction_id,'user_id'=>$user_id,'order_id'=>$order_id,'sub_total'=>$sub_total,'card_number_txn'=>$card_number_txn,'payment_type'=>$payment_type,'total_amount'=>$total_amount,'created_at'=>date('Y-m-d H:i:s')]);
            //Session::flash('success', 'Payment successful!');
            
            $order_otp = mt_rand(1000,9999);
            $token = Str::random(64);
            $email = $order_data->email;
            Mail::send('Front.order-otp', ['token' => $token,'email'=>$order_data->email,'order_otp'=>$order_otp], function($message) use($request){
                        $message->to($request->order_email);
                        $message->from('votivephp.neha@gmail.com','BirthdayCards');
                        $message->subject('Otp For Payment');

            });

            return redirect('otp_verification/'.$request->order_id);
           
        }
        
              
        
    }

    public function otp_verify(Request $request){
        
        $order_otp = mt_rand(1000,9999);
        $token = Str::random(64);
        $user_data = session::get("user_data");
        $email = $user_data['email_address'];
        //print_r($user_data);die;
        


        Session::put("card_name",$request->card_name);
        Session::put("card_no",$request->card_no);
        Session::put("cvv",$request->cvv);
        Session::put("expiration-month",$request->expiration_month);
        Session::put("expiration_year",$request->expiration_year);
        Session::put("email",$email);
        Session::flash('Success', 'OTP is sent on your email');

        
        $order_id = "ord-".mt_rand(1000,9999);
        $cart_id_array = $request->cart_id_array;
        $cart_id_arr = json_decode($cart_id_array);
        //print_r($cart_id_arr);
        $order_total_price = 0;
        
        foreach ($cart_id_arr as $cart_id) {
            $cart_data = DB::table('cart_table')->where('cart_id',$cart_id)->where('status',1)->get()->first();
            //echo $card_price = $cart_data->price;
            //print_r($cart_data);
            $order_total_price = $order_total_price + $cart_data->price;
        }
        
        
        
        $post_order = DB::table('order')->insert(['order_id'=>$order_id,'customer_id'=>$user_data['user_id'],'fname'=>$user_data['fname'],'lname'=>$user_data['lname'], 'phone_no'=>$user_data['phone_no'], 'email'=>$user_data['email_address'], 'door_number'=>$user_data['door_no'],'address'=>$user_data['address'], 'city'=>$user_data['city'], 'postal_code'=>$user_data['post_code'],'receiver_fname'=>$user_data['fname_rc'],'receiver_lname'=>$user_data['lname_rc'], 'receiver_phone_no'=>$user_data['phone_no_rc'], 'receiver_email'=>$user_data['email_address_rc'], 'receiver_door_number'=>$user_data['door_no_rc'], 'receiver_address'=>$user_data['address_rc'], 'receiver_city'=>$user_data['address_rc'], 'receiver_postal_code'=>$user_data['post_code_rc'], 'order_notes'=>$user_data['order_notes'], 'total'=> $order_total_price, 'sub_total'=> $order_total_price, 'order_status'=>'0', 'pay_status'=>'Pending','status'=>'0','otp'=>$order_otp, 'created_at'=>date('Y-m-d H:i:s')]);
        

        if($post_order){  
         
            

            foreach ($cart_id_arr as $cart_id) {
             $cart_data = DB::table('cart_table')->where('cart_id',$cart_id)->where('status',1)->get()->first();
             if(!empty($cart_data)){
                 $card_id = $cart_data->card_id;
                 $card_size_id = $cart_data->sizes;
                 $qty = $cart_data->qty;
                 $card_price = $cart_data->price;
                 $video_id = $cart_data->video_id;
                 $predesigned_text_id = $cart_data->predesigned_text_id;
                 $order_details = DB::table('order_details')->insert(['order_id'=>$order_id,'user_id'=>$user_data['user_id'], 'card_id'=>$card_id, 'card_size_id'=>$card_size_id, 'video_id'=>$video_id, 'predesigned_text_id'=>$predesigned_text_id, 'qty'=>$qty, 'card_price'=>$card_price, 'created_at'=>date('Y-m-d H:i:s')]);

                 if($card_size_id != 0){
                     $card_qty_data = DB::table('card_sizes')->where('id',$card_size_id)->where('card_id',$card_id)->get()->first();
                    
                     $remaining_qty = $card_qty_data->card_size_qty - $qty;

                     $card_qty_update = DB::table('card_sizes')->where('id',$card_size_id)->where('card_id',$card_id)->update(['card_size_qty'=>$remaining_qty,'created_at'=>date('Y-m-d H:i:s')]);
                 }
             }
                
             DB::table('cart_table')->where('cart_id',$cart_id)->where('status',1)->delete();
                
         }
         
         Mail::send('Front.order-otp', ['token' => $token,'email'=> $email,'order_otp'=>$order_otp], function($message) use($request,$email){
                    $message->to($email);
                    $message->from('birthday@birthdaystoreuk.co.uk','BirthdayCards');
                    $message->subject('Otp For Payment');

        });           
         // Mail::send('Front.order-invoice', ['token' => $token,'email'=>$email_address,'order_id'=>$order_id], function($message) use($request){
         //                $message->to($request->email_address);
         //                $message->from('birthday@birthdaystoreuk.co.uk','BirthdayCards');
         //                $message->subject('Order Invoice');

         // });

            return redirect('otp_verification/'.$order_id);
        
            

        }    
    }

    public function otp_verification(Request $request){
        $data['order_id'] = $request->order_id;
        $data['card_name'] = Session::get("card_name");
        $data['card_no'] = Session::get("card_no");
        $data['cvv'] = Session::get("cvv");
        $data['expiration_month'] = Session::get("expiration-month");
        $data['expiration_year'] = Session::get("expiration_year",$request->expiration_year);
        $data['email'] = Session::get("email");

        return view('Front/otp_verification')->with($data);
    }

    public function post_otp(Request $request){
        $get_otp = DB::table('order')->where("order_id",$request->order_id)->get()->first();
        
        if($get_otp->otp == $request->otp){
            
            

            
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
                $charge = Stripe\Charge::create ([
                        "amount" => $get_otp->total*100,
                        "currency" => "usd",
                        "source" => $request->stripeToken,
                        "description" => "Payment from birthdaystoreuk.co.uk" 
                ]);
                
                //print_r($charge->payment_method_details);
                $transaction_id = $charge->id;
                $user_id = session::get("user_id");
                $order_id = $get_otp->order_id;
                $status = 1;
                $sub_total = $get_otp->sub_total;
                $card_number_txn = $request->card_no;
                $payment_type = $charge->payment_method_details->card->brand;
                $total_amount = $get_otp->total;
                if(!empty($charge)){
                    DB::table('payment_transactions')->insert(['transaction_id'=>$transaction_id,'user_id'=>$user_id,'order_id'=>$order_id,'sub_total'=>$sub_total,'card_number_txn'=>$card_number_txn,'payment_type'=>$payment_type,'total_amount'=>$total_amount,'created_at'=>date('Y-m-d H:i:s')]);

                    DB::table('order')->update(['status'=>$status,'created_at'=>date('Y-m-d H:i:s')]);
                    //Session::flash('success', 'Payment successful!');
                    // $token = Str::random(64);
                    // Mail::send('Front.order-invoice', ['token' => $token,'email'=>$order_data->email,'order_id'=>$order_id], function($message) use($request){
                    //             $message->to($request->email_address);
                    //             $message->from('votivephp.neha@gmail.com','BirthdayCards');
                    //             $message->subject('Order Invoice');

                    // });
                    if(Auth::user()){
                     return redirect('order_status/'.$get_otp->order_id);
                    }else{
                     return redirect('ex_order_status/'.$get_otp->order_id);
                    }
                }
           
        }else{

            Session::flash('error', 'Invalid OTP');
            return redirect('otp_verification/'.$request->order_id);
        }
    }
}