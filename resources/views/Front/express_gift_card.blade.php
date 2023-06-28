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
          @if ($message = Session::get('error'))
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ $message }}
        </div>
         @endif
         
          <div class="row">
            @foreach($gift_card as $g_card)
            <div class="col-md-3 col-6">  
              <div class="card-content-wrapper"> 

                <div class="card-content" data-toggle="modal" data-target="#myModal-{{ $g_card->id }}">
                  <img
                    src="{{ url('public/upload/cards') }}/{{ $g_card->card_image }}"
                    alt=""
                  />
                  <div class="gift_price">${{ $g_card->price }}</div>
                  <div class="add_basket_msg-{{ $g_card->id }}"></div>
                  <!-- <h4>Lorem ipsum dolor.</h4>
                  <h5>Lorem ipsum dolor sit amet, consectetur.</h5> -->
                </div>
                <div class="d-flex justify-content-center">
                  <input type="hidden" name="gift_id" class="express_gift_id" value="{{ $g_card->id }}">
                  <label class="image-checkbox image-checkbox-{{ $g_card->id }}" title="England" onclick="addBasket('{{ $g_card->id }}','{{ $g_card->price }}')">
                    <span>Select gift</span>
                    <input type="checkbox" name="gift_id[]" value="{{ $g_card->id }}" id="html-{{ $g_card->id }}"/>
                  </label>
                <!--   <div class="form-group">
                    <input type="checkbox" name="gift_id[]" id="html-{{ $g_card->id }}" value="{{ $g_card->id }}">
                    <label for="html-{{ $g_card->id }}"></label>
                  </div> -->
                </div>
              </div>
            </div>
            <div class="modal fade cardpage_mdl card_modal" id="myModal-{{ $g_card->id }}" role="dialog" style="opacity: 1;background:transparent;">
    <div class="modal-dialog modal-lg card--modal">
    
      <!-- Modal content-->
      <div class="modal-content card-mod-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <?php 
                $gall_images_data = DB::table('card_gallery_images')->get()->where('card_id',$g_card->id);
                
                $cards_data_modal = DB::table('cards')->select('*')->where('id',$g_card->id)->get()->first();
          
              ?>
              <div class="thumb-image">
                <!-- Set up your HTML -->
          <div class="card_carousel owl-carousel">
              @foreach ($gall_images_data as $gallary)    
            <div class="card-thumb-images">
              <?php
                $gallary_images = $gallary->gall_images;
                $file_extension = explode(".",$gallary_images);
                if($file_extension[1] == "jpg" || $file_extension[1] == "jpeg" || $file_extension[1] == "png" || $file_extension[1] == "webp" || $file_extension[1] == "avif" || $file_extension[1] == "gif" || $file_extension[1] == "svg"){
                  ?>
                  <img src="{{ url('/public/upload/gallery_images') }}/{{ $gallary->gall_images }}">
                  <?php
                }else{
                  ?>
                  <video width="320" height="240" controls>
                    <source src="{{ url('/public/upload/gallery_images') }}/{{ $gallary->gall_images }}" type="video/mp4">
                    
                    Your browser does not support the video tag.
                  </video>
                  <?php
                }

              ?>
              
              
            </div>
            @endforeach
          </div>
              </div>
            </div>
            <div class="col-md-6 sele-descri">
              <div class="card-sizes">
                <label>Description</label>

                
                <p>{{ $cards_data_modal->description }}</p>

                <input class="submit_btn submit_btn-{{ $g_card->id }}" type="button" name="btn" value="Select Gift" onclick="addBasket('{{ $g_card->id }}','{{ $g_card->price }}')">
              </div>
            </div>
          </div>
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
				<div class="d-flex justify-content-center align-items-center m-auto text-center">
				<!-- <div class="gift_submit_btn">
					
          <a href="{{ url('/payment_transaction/') }}/{{ $order_id }}" class="no-tnx">No Thanks</a>
				</div> -->

				<div class="gift_submit_btn">
					<input type="submit" name="btn" class="order-now" value="Continue">
				</div>
			</div>
			</div>
		</div>
	
</div>

@endsection