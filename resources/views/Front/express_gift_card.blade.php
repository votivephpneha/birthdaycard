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
<div class="checkout_gift container">
	<div class="gift_heading">
		<h2>Select Gift</h2>
	</div>

   <div class="grid-wrapper grid-col-auto">
   	<div class="row">
   		<div class="col-md-3 col-6">
          <label for="radio-card-1" class="radio-card">
            <input type="radio" name="radio-card" id="radio-card-1" checked />
            <div class="card-content-wrapper">
            
              <div class="card-content">
                <img
                  src="https://image.freepik.com/free-vector/group-friends-giving-high-five_23-2148363170.jpg"
                  alt=""
                />
                <h4>Lorem ipsum dolor.</h4>
                <h5>Lorem ipsum dolor sit amet, consectetur.</h5>
              </div>
                <span class="check-icon"></span>
            </div>
          </label>
      </div>
      <div class="col-md-3 col-6">
           <label for="radio-card-2" class="radio-card">
            <input type="radio" name="radio-card" id="radio-card-2" checked />
            <div class="card-content-wrapper">
            
              <div class="card-content">
                <img
                  src="https://image.freepik.com/free-vector/group-friends-giving-high-five_23-2148363170.jpg"
                  alt=""
                />
                <h4>Lorem ipsum dolor.</h4>
                <h5>Lorem ipsum dolor sit amet, consectetur.</h5>
              </div>

                <span class="check-icon"></span>
            </div>
          </label>
      </div>
      <div class="col-md-3 col-6">
           <label for="radio-card-3" class="radio-card">
            <input type="radio" name="radio-card" id="radio-card-3" checked />
            <div class="card-content-wrapper">
            
              <div class="card-content">
                <img
                  src="https://image.freepik.com/free-vector/group-friends-giving-high-five_23-2148363170.jpg"
                  alt=""
                />
                <h4>Lorem ipsum dolor.</h4>
                <h5>Lorem ipsum dolor sit amet, consectetur.</h5>
              </div>
                <span class="check-icon"></span>
            </div>
          </label>
      </div>

          <!-- /.radio-card -->
<div class="col-md-3 col-6">
          <label for="radio-card-4" class="radio-card">
            <input type="radio" name="radio-card" id="radio-card-4" />
            <div class="card-content-wrapper">
           
              <div class="card-content">
                <img
                  src="https://image.freepik.com/free-vector/people-putting-puzzle-pieces-together_52683-28610.jpg"
                  alt=""
                />
                <h4>Lorem ipsum dolor.</h4>
                <h5>Lorem ipsum dolor sit amet, consectetur.</h5>
              </div>
                 <span class="check-icon"></span>
            </div>
          </label>
          <!-- /.radio-card -->
        </div>
    </div>
        <!-- /.grid-wrapper -->
</div>

	<form method="post" action="{{ url('submit_ex_gift_card') }}">
		<input type="hidden" name="order_id" value="{{ $order_id }}">
		@csrf
		<div class="row">
			
			<div class="col-md-10">
				<div class="row">
					@foreach($gift_card as $g_card)
					<div class="col-md-4 gift-bar-rad">
						<img src="{{ url('public/upload/cards') }}/{{ $g_card->card_image }}">

						<div class="buttons">
							<input type="radio" name="gift_id" value="{{ $g_card->id }}">
						</div>

						<label class="gifr-select">
						  <input type="radio" checked="checked" name="radio">
						  <span class="checkmark"> </span>
						</label>


						<div class="gift_information">
							<input type="hidden" name="card_qty" value="1">
							<input type="hidden" name="card_price" value="{{ $g_card->price }}">
							<h4>{{ $g_card->card_title }}</h4>
							<div class="card_price">${{ $g_card->price }}</div>
						</div>
					</div>
				@endforeach
				</div>
			</div>
			
			
			<div class="col-md-12 mt-5">
				<div class="d-flex justify-content-center m-auto text-center">
				<div class="gift_submit_btn">
					<input type="submit" name="btn" class="no-tnx" value="No Thanks!">
				</div>

				<div class="gift_submit_btn">
					<input type="submit" name="btn" class="order-now" value="Order Now">
				</div>
			</div>
			</div>
		</div>
	</form>
</div>

@endsection