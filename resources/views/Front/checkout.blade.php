@extends('Front.layout.layout')
@section('title', 'Birthdaycards')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<style type="text/css">
	.checkout_page{
		margin-top: 50px;
	}
</style>
<div class="checkout_titlebar">
<div class="container checkout_header">
		<h2>Checkout</h2>
	</div>
	<?php
		$user = Auth::user();
		//$user_data = session::get("user_data");
	?>
</div>
<div class="container checkout_page">
	
	<form method="post" name="checkout_form" action="@if(Auth::user()) {{ url('post_checkout') }}@else {{ url('ex_post_checkout') }} @endif">
		@csrf
		<div class="row">
			
				<div class="bill_details_form col-md-7">
					<h3>Billing Details</h3>
						<h5>Sender Information</h5>
						<div class="row bill-info">
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="first_name">First Name</label>
						  	      <input type="hidden" name="cart_id_array" class="cart_id_array" value="">
						  	      <input type="text" class="form-control" id="fname" placeholder="" name="fname" value="@if($user_data) {{ $user_data['fname'] }} @endif">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="last_name">Last Name</label>
						  	      <input type="text" class="form-control" id="lname" placeholder="" name="lname" value=" @if($user_data) {{ $user_data['lname'] }} @endif">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="door_no">Door No </label>
						  	      <input type="text" class="form-control" id="door_no" placeholder="" name="door_no" value="@if($user_data) {{ $user_data['door_no'] }} @endif" autocomplete="off">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="address">Street Name </label>
						  	      <input type="text" class="form-control" id="address" placeholder="" name="address" value="@if($user_data) {{ $user_data['address'] }} @endif" autocomplete="off">
						  	    </div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="city">Town / City</label>
						  	     
						  	      <input type="text" class="form-control" id="city" placeholder="" value="@if($user_data) {{ $user_data['city'] }} @endif" name="city">
						  	    </div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="post_code">Postcode / ZIP</label>
						  	      <input type="text" class="form-control" id="post_code" placeholder="" value="@if($user_data) {{ $user_data['post_code'] }} @endif" name="post_code">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="phone_no">Phone</label>
						  	      <input type="text" class="form-control" id="phone_no" placeholder="" name="phone_no" value="@if($user_data) {{ $user_data['phone_no'] }} @endif">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="email_address">Email Address</label>
						  	      <input type="text" class="form-control" id="email_address" placeholder="" name="email_address" value="@if($user_data) {{ $user_data['email_address'] }} @endif">
						  	    </div>
							</div>
						</div>
						<h5>Reciver Information</h5>	
						<div class="row bill-info">
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="first_name">First Name</label>
						  	      
						  	      <input type="text" class="form-control" id="fname_rc" placeholder="" name="fname_rc" value="@if($user_data) {{ $user_data['fname_rc'] }} @endif">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="last_name">Last Name</label>
						  	      <input type="text" class="form-control" id="lname_rc" placeholder="" name="lname_rc" value=" @if($user_data) {{ $user_data['lname_rc'] }} @endif">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="door_no">Door No </label>
						  	      <input type="text" class="form-control" id="door_no_rc" placeholder="" name="door_no_rc" value="@if($user_data) {{ $user_data['door_no_rc'] }} @endif" autocomplete="off">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="address">Street Name </label>
						  	      <input type="text" class="form-control" id="address_rc" placeholder="" name="address_rc" value="@if($user_data) {{ $user_data['address'] }} @endif" autocomplete="off">
						  	    </div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="city">Town / City</label>
						  	     
						  	      <input type="text" class="form-control" id="city_rc" placeholder="" value="@if($user_data) {{ $user_data['city_rc'] }} @endif" name="city_rc">
						  	    </div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="post_code">Postcode / ZIP</label>
						  	      <input type="text" class="form-control" id="post_code_rc" placeholder="" value="@if($user_data) {{ $user_data['post_code_rc'] }} @endif" name="post_code_rc">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="phone_no">Phone</label>
						  	      <input type="text" class="form-control" id="phone_no_rc" placeholder="" name="phone_no_rc" value="@if($user_data) {{ $user_data['phone_no_rc'] }} @endif">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="email_address">Email Address</label>
						  	      <input type="text" class="form-control" id="email_address_rc" placeholder="" name="email_address_rc" value="@if($user_data) {{ $user_data['email_address_rc'] }} @endif">
						  	    </div>
							</div>
						</div>	
						<div class="row addi-info">
							<div class="col-md-12 additional-fields">
							<div class="additional-title">
								<h3>Additional information</h3>
							</div>
								<div class="form-group">
						  	      <label for="order_notes">Order Notes (Optional)</label>
						  	      
						  	      <textarea class="form-control" id="order_notes" placeholder="Notes about your order, e.g. special notes for delivery." name="order_notes" rows="2" cols="5" name="order_notes">@if($user_data) {{ $user_data['order_notes'] }}@endif</textarea>
						  	    </div>
							</div>
						</div>
					
				</div>
				<div class="amt_details_form col-md-5">
					<div class="order_div">
						<h3>Ordered Item</h3>
						<div class="total_cost_div">
							
							<div class="checkout_items">
								<table style="width:100%" id="tableId" class="checkout_table_data">
									
									<tr class="order_amt">
										<th>Total Cost</th>
										<td class="total_cost_order">
											<input type="hidden" name="order_total_price" class="order_total_price" value="">
											<span class="pay_now_price">
												
											</span>
										</td>
									</tr>
								</table>
							</div>
							
							<div class="total-submit">
							<button type="submit" name="btn" class="place-order-btn">Continue</button>
							</div>
							
						</div>
					</div>

				</div>
			
		</div>
	</form>
</div>	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
	function deleteCartItem(cart_id){
		
		$.ajax({
		  type: "GET",
		  url: "{{ url('delete_cart_item') }}",
		  data: {cart_id:cart_id},
		  cache: false,
		  success: function(data){
		  	//alert(window.location.path);
		  	var table = document.getElementById("tableId");
		  	
		  	if(table.rows.length <= 2){
			  	window.location.href = "{{ url('cart') }}"; 
			  }else{
			  	
			  	if(window.location.pathname == "checkout"){
			  		window.location.href = "{{ url('checkout') }}"; 
			  	}else{
			  		window.location.href = "{{ url('express_checkout') }}";
			  	}
			  }
		  	
		  }
		});

		var cart_id_array = localStorage.getItem("cart_id_array");
  		var arry_json = JSON.parse(cart_id_array);
  		const arry_json1 = arry_json.filter(function (letter) {
		    return letter !== cart_id;
		});
  		//arry_json.pop(cart_id);
  		console.log("arry_json",arry_json1);

  		var new_json = JSON.stringify(arry_json1);
  		localStorage.setItem("cart_id_array",new_json);
	}
</script>
@endsection