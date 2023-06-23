@extends('Front.layout.layout')
@section('title', 'Home')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<style type="text/css">
    .payment_page{
        margin-top:150px;
    }
</style>    
<section class="payment-page">   
<div class="container payment_page">
    
    <!-- <h1>Laravel - Stripe Payment Gateway Integration Example <br/> ItSolutionStuff.com</h1> -->
    
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                        <h3 class="panel-title" >Card Details</h3>
                </div>
                <div class="panel-body">
    
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
    
                    <form 
                            role="form" 
                            action="{{ url('otp_verify') }}" 
                            method="post" name="payment_form"
                            >
                        @csrf
    
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <input type="hidden" name="order_email" value="{{ session::get('email') }}">
                                <input type="hidden" name="cart_id_array" class="cart_id_array" value="">
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control' size='4' name="card_name" type='text'>
                            </div>
                        </div>
    
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group required'>
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' class='form-control card-number' size='20'
                                    type='text' name="card_no">
                            </div>
                        </div>
    
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                <label class='control-label'>CVV</label> <input autocomplete='off'
                                    class='form-control card-cvc' placeholder='ex. 311' size='4'
                                    type='text' name="cvv">
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text' name="expiration_month">
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text' name="expiration_year">
                            </div>
                        </div>
    
                        <!-- <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.</div>
                            </div>
                        </div> -->
    
                        <div class="row">
                            <div class="col-xs-12 mt-3 pay-now-brn">
                               
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                            </div>
                        </div>
                            
                    </form>
                </div>
            </div>        
        </div>
        <div class="col-md-5">
            <div class="order_div">
                <h3>Ordered Item</h3>
                <div class="total_cost_div">
                    
                    <div class="checkout_items">
                        <table style="width:100%">
                            
                            <tbody class="checkout_table_data"></tbody>
                            <tfoot>
                                <tr class="order_amt">
                                    <th>Total Cost</th>
                                    <td class="total_cost_order">
                                        <input type="hidden" name="order_total_price" class="order_total_price" value="">
                                        <span class="pay_now_price">
                                            
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        
                    </div>
                    
                    
                </div>
            </div>  
        </div>
    </div>
        
</div>
    
</section>

@endsection