@extends('Front.layout.layout')
@section('title', 'Birthdaycards')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<style>
	.cart_page{
		margin-top:50px;
	}

</style>
<div class="cart_titlebar">
<div class="container cart_header">
		<h2>Cart</h2>
	</div>
</div>
<div class="container cart_page">
	<div class="cart_content">
		    @if ($message = Session::get('message'))
		      <div class="alert alert-success">
		          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		      {{ $message }}
		    </div>
		     @endif
		     
		    <div class="cart_data_table table-responsive"> 
				<table class="table cart_infos">
					<thead>
						<tr>
							<th></th>
							<th>Add Address</th>
							<th>Image</th>
							<th>Title</th>
							<th>Quantity</th>
							<th>Card Type</th>
							<th>Price</th>
							
						</tr>
					</thead>
					<tbody class="cart_data">
						
						<tr>
							<td colspan="6">Total</td>
							<td class="total_price">
								
							</td>
						</tr>
					</tbody>
				</table>
			</div>
				<div class="empty-cart" style="display: none">
					<span>No item available.</span>
					<span><a href="{{ url('birthday-cards') }}">Continue Shopping</a></span>
				</div>
				

			
			<div class="checkout_btns">
				<a href="{{ url('checkout') }}"  class="checkout_btn">Checkout</a>
				
				
					<a href="{{ url('express_checkout') }}" class="checkout_btn">Express Checkout</a>
				
				
			</div>
			
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
	var cart_id_array = localStorage.getItem("cart_id_array");
	var arry_json = JSON.parse(cart_id_array);
		
	if(!cart_id_array || arry_json.length<1){
		$(".checkout_btn").hide();
		$(".cart_infos").hide();
		$(".empty-cart").show();
	}

	var sum = 0;
	$.each(arry_json,function(i,val){
	    

		$.ajax({
		  type: "GET",
		  url: "{{ url('cart_data') }}",
		  data: {cart_id:val},
		  cache: false,
		  success: function(data){
		  	//console.log("data",data);
		  	if(data){
		  		$(".cart_data").prepend(data);
			  	var card_price = $.trim($(".cart_price-"+val).html()).replace("$","");
			  	
			  	sum = parseInt(sum) + parseInt(card_price);

			  	console.log("cart_price2",sum);

			  	$(".total_price").html("$"+sum.toFixed(2));
			  }else{
			  	$(".empty-cart").show();
			  	$(".cart_infos").hide();
			  }
		  	
		  }
		});
		
	});

	$.ajax({
	  type: "GET",
	  url: "{{ url('check_gift_data') }}",
	  data: {cart_ids:cart_id_array},
	  cache: false,
	  success: function(data){
	  	console.log("data_value",data);
	  	if(data == 1){
	  		$(".checkout_btn a").removeAttr("href");
	  		
	  	}
	  }

	});		 

	function deleteCartItem(cart_id){
		
		$.ajax({
		  type: "GET",
		  url: "{{ url('delete_cart_item') }}",
		  data: {cart_id:cart_id},
		  cache: false,
		  success: function(data){
		  	//alert(data);
		  	window.location.href = "{{ url('cart') }}"; 
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