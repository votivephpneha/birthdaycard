<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\PaymentTransaction;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use \PDF;
use Auth;
use DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    $data['payhisList'] = PaymentTransaction::join('order', 'order.order_id', '=', 'payment_transactions.order_id')
                    ->select("payment_transactions.*","order.*","order.order_id as order_ids","payment_transactions.id as payment_id")
                    ->where("order.status",1)
                    ->orderby('payment_transactions.id','DESC')
                    ->get();
     
    //  $data['payhisList'] = Order::orderby('id','DESC')->get(); 
     return  view('Admin.payment_history.payment_transaction_list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     $paytrandata = PaymentTransaction::join('order', 'order.order_id', '=', 'payment_transactions.order_id')
     ->select("payment_transactions.*","order.*","order.order_id as order_ids","payment_transactions.id as payment_id","payment_transactions.payment_method as paymethod")       
     ->where('payment_transactions.id',$id)
     ->get();
    //  $paytrandata = Order::where('id',$id)->get();  
    return  view('Admin.payment_history.view_payment_details',compact('paytrandata'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // get category list by ajax
    public function GetPaymentTranslist(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list = array(
        0 =>'id',
        1 =>'srno',
        2=> 'trans_id',
        3=> 'order_id',
        4=> 'customer',
        5=> 'amount',
        6=> 'payment_status',   
        7=> 'date',                    
        8=> 'action'
        );
            
        $totalDataRecord = PaymentTransaction::count();
            
        $totalFilteredRecord = $totalDataRecord;
            
        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {
        $paytran_data = PaymentTransaction::join('users', 'users.id', '=', 'payment_transactions.user_id')
        ->join('order', 'order.id', '=', 'payment_transactions.order_id')
        ->select("payment_transactions.*","users.fname as firstname","users.lname as lastname","order.order_id as order_id1")       
        ->offset($start_val)
        ->limit($limit_val)
        ->orderBy('payment_transactions.id', 'ASC')
        // ->orderBy($order_val,$dir_val)
        ->get();
        // dd( $paytran_data);
        }
        else {
        $search_text = $request->input('search.value');

        $paytran_data =  PaymentTransaction::join('users', 'users.id', '=', 'payment_transactions.user_id')
        ->join('order', 'order.id', '=', 'payment_transactions.order_id')
        ->select("payment_transactions.*","users.fname as firstname","users.lname as lastname","order.order_id as order_id1")
                            ->where(function ($query) use ($search_text) {
                                $query->where('payment_transactions.id', 'LIKE',"%{$search_text}%");
                                // ->orWhere('sub_categories.name', 'LIKE',"%{$search_text}%")
                                // ->orWhere('sub_categories.status', 'LIKE',"%{$search_text}%")
                                // ->orWhere('categories.name', 'LIKE',"%{$search_text}%");
                            })
                            ->offset($start_val)
                            ->limit($limit_val)
                            ->orderBy('payment_transactions.id', 'ASC')
                            // ->orderBy($order_val,$dir_val)
                            ->get();

        $totalFilteredRecord =  $paytran_data->count();
        }
            
        $data_val = array();
        if(!empty($paytran_data))
        {
            $i = $start_val+1;
        //  echo"<pre>",print_r($user_data);die;
        foreach ($paytran_data as $value)
        {
            
            $nestedData['id'] = $value->id;
            $nestedData['srno'] = $i;
            $nestedData['trans_id'] = $value->transaction_id; 
            $nestedData['order_id'] = $value->order_id1;   
            $nestedData['customer'] = $value->firstname ." ". $value->lastname; 
            $nestedData['amount'] =  '$'.number_format($value->total_amount, 2);   
            $nestedData['payment_status'] = $value->payment_status;   
            $nestedData['date'] = date('Y-m-d', strtotime($value->created_at));  
                               
            $nestedData['action'] = '<button class="btn btn-dark p-2">
            <a href="'.route('view.payment.detail',[$value->id]) .'" class="text-white" style=" color: #FFFFFF;"><i class="fa fa-eye" ></i>View</button></a>';
            
            $data_val[] = $nestedData;

            $i++;
                    
        }
        }
        $draw_val = $request->input('draw');
        $get_json_data = array(
        "draw"            => intval($draw_val),
        "recordsTotal"    => intval($totalDataRecord),
        "recordsFiltered" => intval($totalFilteredRecord),
        "data"            => $data_val
        );
            
        echo json_encode($get_json_data);  
 
    }


    //payment  invoice
    public function Payment_Invoice($id)
    {
        $paymentdata = PaymentTransaction::join('order', 'order.order_id', '=', 'payment_transactions.order_id')
        ->select("payment_transactions.*","order.*","order.order_id as order_ids","payment_transactions.payment_method as paymethod")       
        ->where('payment_transactions.id',$id)
        ->get();


        $card_details = DB::table("order_details")
                        ->select("order_details.*","cards.card_title","card_sizes.card_type","card_sizes.card_size","card_sizes.card_price As price","order.total","order.sub_total")
                        ->leftJoin("order","order.order_id","=","order_details.order_id")
                        ->leftJoin("payment_transactions","payment_transactions.order_id","=","order.order_id")
                        ->leftJoin("cards","cards.id","=","order_details.card_id")
                        ->leftJoin("card_sizes","card_sizes.id","=","order_details.card_size_id")
                        ->where('payment_transactions.id',$id)                    
                        ->get();
                        
        $path= public_path('images/logo1.jpg');
       
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $src ='data:image/' . $type . ';base64,' . base64_encode($data);

        $invoicenum = '#'.str_pad($paymentdata[0]->id + 1, 8, "0", STR_PAD_LEFT);
        // dd( $invoicenum);
        $authdata =  Auth::user();

        $todaydate =  $todayDate = Carbon::now()->format('Y-m-d');
        $pdf = \PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,'defaultFont' => 'sans-serif'])->loadView('Admin.payment_history.view_payment_invoice',compact('paymentdata','authdata','invoicenum','card_details','src'));
        $pdf->stream();
        return $pdf->download('invoice'.$paymentdata[0]->id.'-'.$todaydate.'.pdf');
    }
}
