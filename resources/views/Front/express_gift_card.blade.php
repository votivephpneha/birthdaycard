@extends('Front.layout.layout')
@section('title', 'Birthdaycards')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<style type="text/css">
	.checkout_gift{
		margin-top:150px;
	}
</style>
<form method="post" action="{{ url('submit_ex_gift_card') }}">
    <input type="hidden" name="order_id" value="{{ $order_id }}">
    @csrf
<div class="checkout_gift container">
	<div class="gift_heading">
		<h2>Select Gift</h2>
	</div>

   <div class="grid-wrapper grid-col-auto">
   	<div class="row">
     
        @foreach($gift_card as $g_card)
       <!--    <div class="col-md-3 col-6">
            <label for="radio-card-1" class="radio-card" onclick="selectGift('{{ $g_card->id }}')">
              <input type="hidden" name="card_id" class="gift_card_id" value="">
              <input type="radio" name="gift_id" value="{{ $g_card->id }}" class="gift-radio gift-radio-{{ $g_card->id }}">
              <div class="card-content-wrapper">
              
                <div class="card-content">
                  <img
                    src="{{ url('public/upload/cards') }}/{{ $g_card->card_image }}"
                    alt=""
                  />
                
                </div>
                 <div class="gidt-sent">  <span class="check-icon">Select Gift</span></div>
              </div>
            </label>
        </div> -->
        @endforeach
    </div>
        <!-- /.grid-wrapper -->

<div class="all-selct">
         <form>
          <div class="row">
            @foreach($gift_card as $g_card)
            <div class="col-md-3 col-6">  
              <div class="card-content-wrapper"> 

                <div class="card-content">
                  <img
                    src="{{ url('public/upload/cards') }}/{{ $g_card->card_image }}"
                    alt=""
                  />
                  <!-- <h4>Lorem ipsum dolor.</h4>
                  <h5>Lorem ipsum dolor sit amet, consectetur.</h5> -->
                </div>
                <div class="d-flex justify-content-center">
                  <div class="form-group">
                    <input type="checkbox" name="gift_id[]" id="html-{{ $g_card->id }}" value="{{ $g_card->id }}">
                    <label for="html-{{ $g_card->id }}"></label>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
     


</div>

  </form>
</div>
</div>
	
		<div class="row">
			
			
			
			<div class="col-md-12 mt-1">
				<div class="d-flex justify-content-center m-auto text-center">
				<div class="gift_submit_btn" style="margin-top:10px;">
					<!-- <input type="submit" name="btn" class="no-tnx" value="No Thanks!"> -->
          <a href="{{ url('/payment_transaction/') }}/{{ $order_id }}" class="no-tnx">No Thanks</a>
				</div>

				<div class="gift_submit_btn">
					<input type="submit" name="btn" class="order-now" value="Order Now">
				</div>
			</div>
			</div>
		</div>
	
</div>
</form>
@endsection