@extends('Front.layout.layout')
@section('title', 'Home')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<div class="checkout_titlebar">
<div class="container checkout_header">
    <h2>Add address information</h2>
  </div>
 
</div>
<div class="container checkout_page">
  
  <form method="post" name="checkout_form" action="{{ url('saveAddress') }}">
    @csrf
    <div class="row">
      
        <div class="bill_details_form col-md-12">
          
            <h5>Sender Information</h5>
            <div class="row bill-info">
              <div class="col-md-6">
                <div class="form-group">
                      <label for="first_name">First Name</label>
                      <input type="hidden" name="cart_id" value="{{ $cart_id }}">
                      <input type="hidden" name="cart_id_array" class="cart_id_array" value="">
                      <input type="text" class="form-control" id="fname" placeholder="" name="fname" value="{{ $cart_data->fname }}">
                    </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="last_name">Last Name</label>
                      <input type="text" class="form-control" id="lname" placeholder="" name="lname" value="{{ $cart_data->lname }}">
                    </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="door_no">Door No </label>
                      <input type="text" class="form-control" id="door_no" placeholder="" name="door_no" value="{{ $cart_data->door_number }}" autocomplete="off">
                    </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="address">Street Name </label>
                      <input type="text" class="form-control" id="address" placeholder="" name="address" value="{{ $cart_data->address }}" autocomplete="off">
                    </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                      <label for="city">Town / City</label>
                     
                      <input type="text" class="form-control" id="city" placeholder="" value="{{ $cart_data->city }}" name="city">
                    </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                      <label for="post_code">Postcode / ZIP</label>
                      <input type="text" class="form-control" id="post_code" placeholder="" value="{{ $cart_data->postal_code }}" name="post_code">
                    </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="phone_no">Phone</label>
                      <input type="text" class="form-control" id="phone_no" placeholder="" name="phone_no" value="{{ $cart_data->phone_no }}">
                    </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="email_address">Email Address</label>
                      <input type="text" class="form-control" id="email_address" placeholder="" name="email_address" value="{{ $cart_data->email }}">
                    </div>
              </div>
            </div>
            <h5>Reciver Information</h5>  
            <div class="row bill-info" style="margin-bottom: 1em">
              <div class="col-md-6">
                <div class="form-group">
                      <label for="first_name">First Name</label>
                      
                      <input type="text" class="form-control" id="fname_rc" placeholder="" name="fname_rc" value="{{ $cart_data->receiver_fname }}">
                    </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="last_name">Last Name</label>
                      <input type="text" class="form-control" id="lname_rc" placeholder="" name="lname_rc" value="{{ $cart_data->receiver_lname }}">
                    </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="door_no">Door No </label>
                      <input type="text" class="form-control" id="door_no_rc" placeholder="" name="door_no_rc" value="{{ $cart_data->receiver_door_number }}" autocomplete="off">
                    </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="address">Street Name </label>
                      <input type="text" class="form-control" id="address_rc" placeholder="" name="address_rc" value="{{ $cart_data->receiver_address }}" autocomplete="off">
                    </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                      <label for="city">Town / City</label>
                     
                      <input type="text" class="form-control" id="city_rc" placeholder="" value="{{ $cart_data->receiver_city }}" name="city_rc">
                    </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                      <label for="post_code">Postcode / ZIP</label>
                      <input type="text" class="form-control" id="post_code_rc" placeholder="" value="{{ $cart_data->receiver_postal_code }}" name="post_code_rc">
                    </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="phone_no">Phone</label>
                      <input type="text" class="form-control" id="phone_no_rc" placeholder="" name="phone_no_rc" value="{{ $cart_data->receiver_phone_no }}">
                    </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                      <label for="email_address">Email Address</label>
                      <input type="text" class="form-control" id="email_address_rc" placeholder="" name="email_address_rc" value="{{ $cart_data->receiver_email }}">
                    </div>
              </div>
            </div>  
            <div class="gift_submit_btn" style="text-align: center;">
              <button type="submit" class="btn btn-default order-now">Save</button>
            </div>
        </div>
        
      
    </div>
  </form>
</div>  


@endsection

