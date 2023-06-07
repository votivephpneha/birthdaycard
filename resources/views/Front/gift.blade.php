@extends('Front.layout.layout')
@section('title', 'Birthdaycards')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')

<div class="container card_page">
	<div class="card_header">
		<h2>All Gifts</h2>
	</div>
	<div class="row">
		<?php
			
			$user = Auth::guard("customer")->user();
			
		?>
		@if ($message = Session::get('success'))
        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ $message }}
        </div>
         @endif
         @if ($message = Session::get('error'))
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ $message }}
        </div>
         @endif
		@foreach ($gift_card as $card)
		<div class="col-md-3">
            <div class="product-grid2 mb-5">
                <div class="product-image2">
                    <a href="#">
                        <img src="{{ url('/public/upload/cards') }}/{{ $card->card_image }}">
                      
                    </a>
                    @if($user)
					<?php
					    $user_id = $user->id;
						$favourites_data = DB::table('favourite_cards')->where(['user_id' => $user_id])->where(['card_id' => $card->id])->first();

					?>
					@if($favourites_data)
						<form method="post" action="{{ url('/birthday-favourites') }}">
							@csrf
							<input type="hidden" name="favorite_id" value="1">
							<input type="hidden" name="gift_card" value="gifts">
							<input type="hidden" name="user_id" value="{{ $user_id }}">
							<input type="hidden" name="card_id" value="{{ $card->id }}">
							<button class="favourite" type="submit">
								<span class="fav fav-{{ $card->id }}" onclick="addFav('{{ $user->id }}','{{ $card->id }}')"><i class="fa fa-heart"></i></span>
							</button>
						</form>
					@else
						<form method="post" action="{{ url('/birthday-favourites') }}">
							@csrf
							<input type="hidden" name="favorite_id" value="0">
							<input type="hidden" name="gift_card" value="gifts">
							<input type="hidden" name="user_id" value="{{ $user->id }}">
							<input type="hidden" name="card_id" value="{{ $card->id }}">
							<button class="favourite" type="submit">
								<span class="fav fav-{{ $card->id }}" onclick="addFav('{{ $user->id }}','{{ $card->id }}')"><i class="fa fa-heart-o"></i></span>
							</button>
						</form>	
					@endif
					@else
						<form method="post" action="{{ url('/birthday-favourites') }}">
							@csrf
							<input type="hidden" name="favorite_id" value="0">
							
							<button class="favourite" type="submit">
								<span class="fav"><i class="fa fa-heart-o"></i></span>
							</button>
						</form>	
					@endif
                   	<form method="post">
						@csrf
						<input type="hidden" name="gift_card_id" class="gift_card_id" value="{{ $card->id }}">
						<input type="hidden" name="gift_card_qty" class="gift_card_qty" value="1">
						<input type="hidden" name="gift_card_price" class="gift_card_price" value="{{ $card->price }}">

						<button type="button" onclick="giftSubmit('{{ $card->id }}','1','{{ $card->price }}')" class="add-to-cart" href="">Add to Basket</button>
					</form>
                    
                </div>
               
            </div>

			
		</div>
		
		@endforeach
	</div>
</div>	

@endsection
