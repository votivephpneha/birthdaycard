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
						  	      <input type="text" class="form-control" id="fname" placeholder="" name="fname" value="@if($user){{ $user->fname }}@endif">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="last_name">Last Name</label>
						  	      <input type="text" class="form-control" id="lname" placeholder="" name="lname" value="@if($user){{ $user->lname }}@endif">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="door_no">Door No </label>
						  	      <input type="text" class="form-control" id="door_no" placeholder="" name="door_no" value="" autocomplete="off">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="address">Street Name </label>
						  	      <input type="text" class="form-control" id="address" placeholder="" name="address" value="@if($user){{ $user->address }}@endif" autocomplete="off">
						  	    </div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="city">Town / City</label>
						  	     
						  	      <input type="text" class="form-control" id="city" placeholder="" name="city">
						  	    </div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="post_code">Postcode / ZIP</label>
						  	      <input type="text" class="form-control" id="post_code" placeholder="" name="post_code">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="phone_no">Phone</label>
						  	      <input type="text" class="form-control" id="phone_no" placeholder="" name="phone_no" value="@if($user){{ $user->phone }}@endif">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="email_address">Email Address</label>
						  	      <input type="text" class="form-control" id="email_address" placeholder="" name="email_address" value="@if($user){{ $user->email }}@endif">
						  	    </div>
							</div>
						</div>
						<h5>Reciver Information</h5>	
						<div class="row bill-info">
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="first_name">First Name</label>
						  	      
						  	      <input type="text" class="form-control" id="fname_rc" placeholder="" name="fname_rc" value="@if($user){{ $user->fname }}@endif">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="last_name">Last Name</label>
						  	      <input type="text" class="form-control" id="lname_rc" placeholder="" name="lname_rc" value="@if($user){{ $user->lname }}@endif">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="door_no">Door No </label>
						  	      <input type="text" class="form-control" id="door_no_rc" placeholder="" name="door_no_rc" value="" autocomplete="off">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="address">Street Name </label>
						  	      <input type="text" class="form-control" id="address_rc" placeholder="" name="address_rc" value="@if($user){{ $user->address }}@endif" autocomplete="off">
						  	    </div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="city">Town / City</label>
						  	     
						  	      <input type="text" class="form-control" id="city_rc" placeholder="" name="city_rc">
						  	    </div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="post_code">Postcode / ZIP</label>
						  	      <input type="text" class="form-control" id="post_code_rc" placeholder="" name="post_code_rc">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="phone_no">Phone</label>
						  	      <input type="text" class="form-control" id="phone_no_rc" placeholder="" name="phone_no_rc" value="@if($user){{ $user->phone }}@endif">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="email_address">Email Address</label>
						  	      <input type="text" class="form-control" id="email_address_rc" placeholder="" name="email_address_rc" value="@if($user){{ $user->email }}@endif">
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
						  	      
						  	      <textarea class="form-control" id="order_notes" placeholder="Notes about your order, e.g. special notes for delivery." name="order_notes" rows="2" cols="5" name="order_notes"></textarea>
						  	    </div>
							</div>
						</div>
					
				</div>
				<div class="amt_details_form col-md-5">
					<div class="order_div">
						<h3>Your Order</h3>
						<div class="total_cost_div">
							
							<div class="checkout_items">
								<table style="width:100%" class="checkout_table_data">
									
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
							<button type="submit" name="btn" class="place-order-btn">Pay Now</button>
							</div>
							
						</div>
					</div>

				</div>
			
		</div>
	</form>
</div>	
@endsection