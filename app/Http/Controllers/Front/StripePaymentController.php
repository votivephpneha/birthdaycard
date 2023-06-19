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
        
        $order_data = DB::table('order')->where("order_id",$request->order_id)->get()->first();
        $order_otp = mt_rand(1000,9999);
        $token = Str::random(64);
        $email = $order_data->email;
        Mail::send('Front.order-otp', ['token' => $token,'email'=>$order_data->email,'order_otp'=>$order_otp], function($message) use($request){
                    $message->to($request->order_email);
                    $message->from('birthday@birthdaystoreuk.co.uk','BirthdayCards');
                    $message->subject('Otp For Payment');

        });

        $otp_update = DB::table('order')->where('order_id',$request->order_id)->update(['otp'=>$order_otp, 'created_at'=>date('Y-m-d H:i:s')]);

        Session::put("card_name",$request->card_name);
        Session::put("card_no",$request->card_no);
        Session::put("cvv",$request->cvv);
        Session::put("expiration-month",$request->expiration_month);
        Session::put("expiration_year",$request->expiration_year);
        Session::put("email",$email);
        Session::flash('Success', 'OTP is sent on your email');
        return redirect('otp_verification/'.$request->order_id);
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