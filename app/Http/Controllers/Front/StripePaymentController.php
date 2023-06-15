<?php
    
namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;     
use Illuminate\Http\Request;
use Session;
use Stripe;
use DB,Validator;
use Auth;
use Mail;
     
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
            $token = Str::random(64);
            Mail::send('Front.order-invoice', ['token' => $token,'email'=>$order_data->email,'order_id'=>$order_id], function($message) use($request){
                        $message->to($request->email_address);
                        $message->from('votivephp.neha@gmail.com','BirthdayCards');
                        $message->subject('Order Invoice');

            });
            if(Auth::user()){
             return redirect('order_status/'.$request->order_id);
            }else{
             return redirect('ex_order_status/'.$request->order_id);
            }
        }
        
              
        
    }
}