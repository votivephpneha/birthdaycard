@extends('Admin.layout.layout')

@section('title', 'Order details')


@section('current_page_css')
<style>
.profile-img {
    max-width: 100% !important;
    height: auto !important;
    border-radius: 50% !important;
    border: 3px solid #adb5bd;
    margin: 0 auto;
    padding: 3px;
    width: 100px;
}
.m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;   
    }
    .w-85{
        width:85%;   
    }
    .w-15{
        width:15%;   
    }
    .logo img{
        width:200px;
        height:60px;        
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
        text-align: center;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
        
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
    .float-right{
        float:right;
    }

</style>

@endsection

@section('current_page_js')

<script type="text/javascript">
$('#order_status').on('change', function() {

    var val = $('#order_status').val();

    if (val == 2) {
        $('#cancel_area').html(
        '<textarea style="width: 337px;" class="form-control animated"  id="cancel_reason" name="cancel_reason" placeholder="Enter cancel reason..." rows="3"></textarea>'
        );

    }

});

function myFunction(text_id) {
    //alert(text_id);
    var predta = text_id.split(',');
    
    var predesigned_ids = JSON.stringify(predta);
    console.log("predesigned_ids",predesigned_ids);
    //console.log("predta",val);
    $.ajax({
        type: 'get',
        url: "{{ url('admin/getText') }}",
        data: {text_id:predesigned_ids},
        
        success: function(resultData) { 
            console.log(resultData);
            $(".order_text_data").html(resultData);
         }
    });
    
    
}
</script>



@endsection

@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Order Details</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <!-- <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
            </span> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        @if(Session::has('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ Session::get('success')}}</strong>
        </div>
        @endif
        <div class="row">
            <form id="supdate" role="form" method="POST" action="{{ route('order.status.change') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="order_id" id="order_id" value="{{$orderdetail[0]->order_id}}">
                <input type="hidden" name="return_flag" id="return_flag" value="0">
                <input type="hidden" name="id" id="id" value="{{$orderdetail[0]->id}}">
                <div class="col-lg-8">
                    <label>Order Status: </label>
                    <select class="select2_group form-control" name="order_status" id="order_status">
                        <!-- <optgroup label="Select order status"> -->
                        <option value="0" @if($orderdetail[0]->order_status == 0) selected @endif
                            >Ordered</option>
                        <option value="1" @if($orderdetail[0]->order_status == 1) selected @endif
                            >In Progress</option>
                        <option value="2" @if($orderdetail[0]->order_status == 2) selected @endif
                            >Cancelled</option>
                        <option value="3" @if($orderdetail[0]->order_status == 3) selected @endif >Order ready</option>
                        <option value="4" @if($orderdetail[0]->order_status == 4) selected @endif >In transit</option>
                        <option value="5" @if($orderdetail[0]->order_status == 5) selected @endif >Out for delivery
                        </option>
                        <option value="6" @if($orderdetail[0]->order_status == 6) selected @endif >Delivered</option>
                        </optgroup>
                    </select>
                    <div id="cancel_area"></div>
                </div>
                <div class="col-lg-4">
                    <button class="btn btn-dark btn_submit mt-5" style="margin-top : 24px;" type="submit"
                        id="extraSearch">Submit</button>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <h4 class="brief"><i>Order Details(#{{$orderdetail[0]->order_id}})</i></h4>
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                            <tbody class="fw-semibold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Order date :
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        {{ date('d/m/Y', strtotime($orderdetail[0]->created_at))}}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Order ID :
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        #{{$orderdetail[0]->order_id}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Order Status :
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">@if($orderdetail[0]->order_status
                                        ==0) Ordered @endif
                                        @if($orderdetail[0]->order_status ==1) In Progress @endif
                                        @if($orderdetail[0]->order_status ==2) Cancelled @endif
                                        @if($orderdetail[0]->order_status ==3) Order ready @endif
                                        @if($orderdetail[0]->order_status ==4)In transit @endif
                                        @if($orderdetail[0]->order_status ==5) Out for delivery
                                        @endif
                                        @if($orderdetail[0]->order_status ==6)Delivered @endif
                                        @if($orderdetail[0]->order_status ==7) Return request
                                        declined @endif </td>
                                </tr>
                                <tr>
                                    <?php if(!empty($orderdetail[0]->order_notes)){ ?>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Order Note :
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end"> {{$orderdetail[0]->order_notes  }}
                                    </td>
                                    <?php } ?>
                                </tr>
                                <tr>
                                    <?php if(!empty($orderdetail[0]->cancel_reason)){ ?>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Cancel Reason :
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        {{$orderdetail[0]->cancel_reason  }}</td>
                                    <?php } ?>
                                </tr>


                            </tbody>
                        </table>
                        <h4 class="brief"><i>Payment Details</i></h4>
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                            <tbody class="fw-semibold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Payment Method:
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">{{$orderdetail[0]->payment_method}}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Payment Status:
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">{{$orderdetail[0]->pay_status}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="x_panel">
                    <h4 class="brief"><i>Billing Details(#{{$orderdetail[0]->order_id}})</i></h4>
                    <!-- <div class="x_title">
                    </div> -->
                    <div class="x_content">
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                            <tbody class="fw-semibold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Name :
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">{{$admindata->fname}} {{$admindata->lname}}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Email :
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        {{$admindata->email}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Phone :
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">{{$admindata->phone}}</td>
                                </tr>
                                <tr>

                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Address :
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                    {{$orderdetail[0]->door_number}} {{$orderdetail[0]->address}},{{$orderdetail[0]->city}}
                                        {{$orderdetail[0]->postal_code}}
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="x_panel">
                    <h4 class="brief"><i>Receiver Details(#{{$orderdetail[0]->order_id}})</i></h4>
                    <!-- <div class="x_title">
                    </div> -->
                    <div class="x_content">
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                            <tbody class="fw-semibold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Name :
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">{{$orderdetail[0]->receiver_fname}} {{$orderdetail[0]->receiver_lname}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Email :
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                        {{$orderdetail[0]->receiver_email}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Phone :
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">{{$orderdetail[0]->receiver_phone_no}}</td>
                                </tr>
                                <tr>

                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            Address:
                                        </div>
                                    </td>
                                    <td class="fw-bold text-end">
                                    {{$orderdetail[0]->receiver_door_number}} {{$orderdetail[0]->receiver_address}},{{$orderdetail[0]->receiver_city}}
                                        {{$orderdetail[0]->receiver_postal_code}}
                                    </td>

                                </tr>
                                    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table row -->
        
            <div class="row">
                <div class="col-xs-12 table ">
                <div class=" table-striped">
    <table class="table table-striped">
        <tr>    
            <th class="">Card Title</th>
            <th class="">Card Type</th>
            <th class="">Unit Price	</th>
            <th class="">Qty</th>
            <th class="">Qr Link</th>
            <th>Predesign Text detail</th>
            
            <!-- <th class="">Subtotal</th>
            <th class="">Tax Amount</th>
            <th class="">Grand Total</th> -->
        </tr>
        @foreach($card_details as $data)
        <tr align="center">
            <!-- <td>M101</td> -->          
            <td>{{$data->card_title}}</td>
            @if(!empty($data->card_size) && !empty($data->card_type) )
            <td>{{$data->card_type}}<br>{{$data->card_size}}</td>
            @else
            <td>Gift</td>
            @endif
            @if(!empty($data->price))
            <td>${{number_format($data->price, 2)}}</td>
            @else
            <td>${{number_format($data->card_price, 2)}}</td>
            @endif            
            <td>{{$data->qty}}</td>
            @if($data->qr_image_link)
            <td>{{$data->qr_image_link}}</td>
            @else
            <td>No Link</td>
            @endif
            @if(!empty($data->predesigned_text_id))
                                                <td><button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal"  onclick="myFunction('<?php echo $data->predesigned_text_id?>')">
                                                 view
                                                </button></td>
                                                @else
                                                <td>No Text</td>
                                                @endif
            <!-- <td>${{number_format($data->card_price, 2)}}</td>
            <td>$0.00</td>
            <td>${{number_format($data->card_price, 2)}}</td> -->
           
        </tr>
        @endforeach
      
        <tr>
            <td colspan="7">
                <div class="total-part">
                    <div class="total-left w-85 float-left" align="right">
                        <p>Sub Total:</p>
                        <p>Tax (%):</p>
                        <p>Total Payable:</p>
                    </div>
                    <div class="total-right w-15 float-left text-bold" align="right">
                        <p>${{number_format($orderdetail[0]->sub_total, 2)}}</p>
                        <p>$0.00</p>
                        <p>${{number_format($orderdetail[0]->total, 2)}}</p>
                    </div>
                    <div style="clear: both;"></div>
                </div> 
            </td>
        </tr>
    </table>
</div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->



    </div>
</div>
<!-- /page content -->

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Predesign Text</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
        <div class="card_text_dtl">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Text</th>
      <th scope="col">Size</th>
      <th scope="col">Font</th>
      <th scope="col">Colour</th>
      <th scope="col">Horizontal Alignment</th>
      <th scope="col">Vertical Alignment</th>
    </tr>
  </thead>
  <tbody class="order_text_data">
    <!-- <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr> -->
  </tbody>
</table>
        </div>          
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
      
    </div>
  </div> 
@endsection