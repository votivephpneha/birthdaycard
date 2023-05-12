<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<link href="{{ url('public/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
<style type="text/css">
	.change_div_content textarea{
		text-align: center;
		
	}
	@if(!empty($db_text_data))
	.change_hide_div-1 textarea{
		font-size:{{ $db_text_data->size }};
		color:{{ $db_text_data->color }}; 
	}
	@endif
	@if(!empty($db_text_data1))
	.change_hide_div-2 textarea{
		font-size:{{ $db_text_data1->size }};
		color:{{ $db_text_data1->color }}; 
	}
	@endif
	@if(!empty($db_text_data2))
	.change_hide_div-3 textarea{
		font-size:{{ $db_text_data2->size }};
		color:{{ $db_text_data2->color }}; 
	}
	@endif
</style>

<div class="card-section-div container">
	@if ($message = Session::get('message'))
      <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ $message }}
    </div>
     @endif
	<div class="card-header">
		<form method="post" action="{{ url('post_card') }}">
			@csrf
			<input type="hidden" name="card_id" value="{{ $cart_id->card_id }}" class="cart_id">
			<input type="hidden" name="card_size_id" value="{{ $cart_id->sizes }}" class="cart_id">
			<input type="hidden" name="cart_id" value="{{ $cart_id->cart_id }}" class="cart_id">
			<input type="hidden" name="text_size_font" value="" class="text_size_font">
			<input type="hidden" name="text_color_font" value="" class="text_color_font">
			<input type="hidden" name="text_font" value="" class="text_font">
			<button type="submit">Add to Basket</button>
		</form>
		
	</div>
	<div class="card-editor-content">
		<div class="card_editor_carousel">
		  
		  
		  <div class="card-block-one">
		  	<div class="add_text_div">
		  		<div class="text-tools text-tools-one" style="display:none;">
		  			<div class="text-sizes size-tool-box" style="display:none;">
		  				<h4>Text Sizes</h4>
		  				<div class="text-size-div row">

		  					<?php 

		  					for($i=12;$i<=20;$i++){
		  						
		  					?>
		  					<div class="col-md-2">
		  						<input type="radio" name="text-size" value="<?php echo $i; ?>" onclick="changeTextSize('1','text-size','{{ $i }}')"><span><?php echo $i; ?></span>
		  					</div>
		  					<?php	
		  						$i++;
		  					}
		  					for($i=25;$i<=65;$i++){
		  						
		  					?>
		  					<div class="col-md-2">
		  						<input type="radio" name="text-size" value="<?php echo $i; ?>" onclick="changeTextSize('1','text-size','{{ $i }}')"><span><?php echo $i; ?></span>
		  					</div>
		  					<?php	
		  						$i = $i+4;
		  					}
		  					?>
		  					
		  				</div>
		  				
		  			</div>
		  			<div class="text-sizes color-tool-box" style="display:none;">
		  				<h4>Text Colour</h4>
		  				<div class="text-color-div row">
		  					@foreach($colors as $color)
		  					    <div class="col-md-12">
			  						<input type="radio" name="text-colour" value="{{ $color->color_name }}" onclick="changeTextSize('1','text-color',this.value)"><div style="width:50px;height:50px;background-color: {{ $color->color_name }}"></div><span style="width:50px;height:50px;">{{ $color->color_name }}</span>
			  					</div>
		  						
		  					@endforeach
		  					
		  				</div>
		  				
		  			</div>
		  			<div class="text-change-tools">
		  				<div class="change-tools size-click">
		  					<div class="text-number">30</div>
		  					<div class="text-font">Size</div>
		  				</div>
		  				<div class="change-tools size">
		  					<div class="text-number">Aa</div>
		  					<div class="text-font">Font</div>
		  				</div>
		  				<div class="change-tools color-click">
		  					<div class="text-number" style="background-color: black;width: 28px; height: 28px;"></div>
		  					<div class="text-font">Color</div>
		  				</div>
		  				<div class="change-tools size">
		  					<div class="text-number">
		  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28" height="28"><path fill-rule="evenodd" clip-rule="evenodd" d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1ZM7 9a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Z" fill="currentColor"></path></svg>
		  					</div>
		  					<div class="text-font">Align</div>
		  				</div>
		  				<div class="change-tools size">
		  					
		  					<form method="post" action="{{ url('post_card') }}">
		  						@csrf
		  						<input type="hidden" name="text_id" value="1">
		  						<input type="hidden" name="cart_id" value="{{ $cart_id->cart_id }}" class="cart_id">
		  						<input type="hidden" name="card_id" value="{{ $cart_id->card_id }}" class="card_id">
								<input type="hidden" name="card_size_id" value="{{ $cart_id->sizes }}" class="cart_id">
		  						<input type="hidden" name="text_one" class="text_one" value="@if(!empty($db_text_data)){{ $db_text_data->Text }}@endif">
		  						<input type="hidden" name="text_size_one" class="text_size_one" value="@if(!empty($db_text_data)){{ $db_text_data->size }}@endif">
		  						<input type="hidden" name="text_color_one" class="text_color_one" value="@if(!empty($db_text_data)){{ $db_text_data->color }}@endif">
		  						<button type="submit" name="btn">
			  						<svg viewBox="0 0 40 40" width="40" height="40"><circle cx="20" cy="20" r="19" fill="#F8F8F9" stroke="#087827" stroke-width="2"></circle><path fill-rule="evenodd" clip-rule="evenodd" d="M27.707 14.293a1 1 0 0 1 0 1.414l-10 10a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414L17 23.586l9.293-9.293a1 1 0 0 1 1.414 0Z" fill="#087827"></path></svg>	
			  						Done
		  					    </button>
		  					</form>
		  					
		  				</div>
		  			</div>
		  		</div>
		  		<div class="text-one-div">
			  		<div class="change_div_content add-text-div change_show_div-1" onclick="changeText(1)" style="@if(!empty($db_text_data)) display:none;@endif">
			  			<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="39.89333333333334" height="39.89333333333334" color="#00204D"><path fill-rule="evenodd" clip-rule="evenodd" d="M4 2a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4zm20 2H4v20h20V4zm-4 3H8v2.286a1 1 0 0 0 2 0V9h3v10h-.5a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2H15V9h3v.286a1 1 0 1 0 2 0V7z" fill="currentColor"></path></svg>
			  			<span>Add Text</span>
			  		</div>
			  		<div class="change_div_content change_text_div change_hide_div-1" style="@if(empty($db_text_data)) display:none;@endif">
			  			<textarea>
			  				@if(!empty($db_text_data))
			  				{{ str_replace(' ', '', $db_text_data->Text) }}
			  				@endif
			  			</textarea>
			  		</div>
		  		</div>
		  		<div class="text-tools text-tools-two" style="display:none;">
		  			<div class="text-sizes size-tool-box" style="display:none;">
		  				<h4>Text Sizes</h4>
		  				<div class="text-size-div row">

		  					<?php 

		  					for($i=12;$i<=20;$i++){
		  						
		  					?>
		  					<div class="col-md-2">
		  						<input type="radio" name="text-size" value="<?php echo $i; ?>" onclick="changeTextSize('2','text-size','{{ $i }}')"><span><?php echo $i; ?></span>
		  					</div>
		  					<?php	
		  						$i++;
		  					}
		  					for($i=25;$i<=65;$i++){
		  						
		  					?>
		  					<div class="col-md-2">
		  						<input type="radio" name="text-size" value="<?php echo $i; ?>" onclick="changeTextSize('2','text-size','{{ $i }}')"><span><?php echo $i; ?></span>
		  					</div>
		  					<?php	
		  						$i = $i+4;
		  					}
		  					?>
		  					
		  				</div>
		  				
		  			</div>
		  			<div class="text-sizes color-tool-box" style="display:none;">
		  				<h4>Text Colour</h4>
		  				<div class="text-color-div row">
		  					@foreach($colors as $color)
		  					    <div class="col-md-12">
			  						<input type="radio" name="text-colour" value="{{ $color->color_name }}" onclick="changeTextSize('2','text-color',this.value)"><div style="width:50px;height:50px;background-color: {{ $color->color_name }}"></div><span style="width:50px;height:50px;">{{ $color->color_name }}</span>
			  					</div>
		  						
		  					@endforeach
		  					
		  				</div>
		  				
		  			</div>
		  			<div class="text-change-tools">
		  				<div class="change-tools size-click">
		  					<div class="text-number">30</div>
		  					<div class="text-font">Size</div>
		  				</div>
		  				<div class="change-tools size">
		  					<div class="text-number">Aa</div>
		  					<div class="text-font">Font</div>
		  				</div>
		  				<div class="change-tools color-click">
		  					<div class="text-number" style="background-color: black;width: 28px; height: 28px;"></div>
		  					<div class="text-font">Color</div>
		  				</div>
		  				<div class="change-tools size">
		  					<div class="text-number">
		  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28" height="28"><path fill-rule="evenodd" clip-rule="evenodd" d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1ZM7 9a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Z" fill="currentColor"></path></svg>
		  					</div>
		  					<div class="text-font">Align</div>
		  				</div>
		  				<div class="change-tools size">
		  					
		  					<form method="post" action="{{ url('post_card') }}">
		  						@csrf
		  						<input type="hidden" name="text_id" value="2">
		  						<input type="hidden" name="cart_id" value="{{ $cart_id->cart_id }}" class="cart_id">
		  						<input type="hidden" name="card_id" value="{{ $cart_id->card_id }}" class="card_id">
								<input type="hidden" name="card_size_id" value="{{ $cart_id->sizes }}" class="cart_id">
		  						<input type="hidden" name="text_two" class="text_two" value="@if(!empty($db_text_data1)){{ $db_text_data1->Text }}@endif">
		  						<input type="hidden" name="text_size_two" class="text_size_two" value="@if(!empty($db_text_data1)){{ $db_text_data1->size }}@endif">
		  						<input type="hidden" name="text_color_two" class="text_color_two" value="@if(!empty($db_text_data1)){{ $db_text_data1->color }}@endif">
		  						<button type="submit" name="btn">
			  						<svg viewBox="0 0 40 40" width="40" height="40"><circle cx="20" cy="20" r="19" fill="#F8F8F9" stroke="#087827" stroke-width="2"></circle><path fill-rule="evenodd" clip-rule="evenodd" d="M27.707 14.293a1 1 0 0 1 0 1.414l-10 10a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414L17 23.586l9.293-9.293a1 1 0 0 1 1.414 0Z" fill="#087827"></path></svg>	
			  						Done
		  					    </button>
		  					</form>
		  					
		  				</div>
		  			</div>
		  		</div>
		  		<div class="text-two-div">
		  			<div class="change_div_content add-text-div change_show_div-2" onclick="changeText(2)" style="@if(!empty($db_text_data1)) display:none;@endif">
			  			<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="39.89333333333334" height="39.89333333333334" color="#00204D"><path fill-rule="evenodd" clip-rule="evenodd" d="M4 2a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4zm20 2H4v20h20V4zm-4 3H8v2.286a1 1 0 0 0 2 0V9h3v10h-.5a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2H15V9h3v.286a1 1 0 1 0 2 0V7z" fill="currentColor"></path></svg>
			  			<span>Add Text</span>
			  		</div>
			  		<div class="change_div_content change_text_div change_hide_div-2" style="@if(empty($db_text_data1))display:none;@endif">
			  			<textarea>
			  				@if(!empty($db_text_data1))
			  				{{ str_replace(' ', '', $db_text_data1->Text) }}
			  				@endif
			  			</textarea>
			  		</div>
		  		</div>
		  		<div class="text-tools text-tools-three" style="display:none;">
		  			<div class="text-sizes size-tool-box" style="display:none;">
		  				<h4>Text Sizes</h4>
		  				<div class="text-size-div row">

		  					<?php 

		  					for($i=12;$i<=20;$i++){
		  						
		  					?>
		  					<div class="col-md-2">
		  						<input type="radio" name="text-size" value="<?php echo $i; ?>" onclick="changeTextSize('3','text-size','{{ $i }}')"><span><?php echo $i; ?></span>
		  					</div>
		  					<?php	
		  						$i++;
		  					}
		  					for($i=25;$i<=65;$i++){
		  						
		  					?>
		  					<div class="col-md-2">
		  						<input type="radio" name="text-size" value="<?php echo $i; ?>" onclick="changeTextSize('3','text-size','{{ $i }}')"><span><?php echo $i; ?></span>
		  					</div>
		  					<?php	
		  						$i = $i+4;
		  					}
		  					?>
		  					
		  				</div>
		  				
		  			</div>
		  			<div class="text-sizes color-tool-box" style="display:none;">
		  				<h4>Text Colour</h4>
		  				<div class="text-color-div row">
		  					@foreach($colors as $color)
		  					    <div class="col-md-12">
			  						<input type="radio" name="text-colour" value="{{ $color->color_name }}" onclick="changeTextSize('3','text-color',this.value)"><div style="width:50px;height:50px;background-color: {{ $color->color_name }}"></div><span style="width:50px;height:50px;">{{ $color->color_name }}</span>
			  					</div>
		  						
		  					@endforeach
		  					
		  				</div>
		  				
		  			</div>
		  			<div class="text-change-tools">
		  				<div class="change-tools size-click">
		  					<div class="text-number">30</div>
		  					<div class="text-font">Size</div>
		  				</div>
		  				<div class="change-tools size">
		  					<div class="text-number">Aa</div>
		  					<div class="text-font">Font</div>
		  				</div>
		  				<div class="change-tools color-click">
		  					<div class="text-number" style="background-color: black;width: 28px; height: 28px;"></div>
		  					<div class="text-font">Color</div>
		  				</div>
		  				<div class="change-tools size">
		  					<div class="text-number">
		  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28" height="28"><path fill-rule="evenodd" clip-rule="evenodd" d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1ZM7 9a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Z" fill="currentColor"></path></svg>
		  					</div>
		  					<div class="text-font">Align</div>
		  				</div>
		  				<div class="change-tools size">
		  					
		  					<form method="post" action="{{ url('post_card') }}">
		  						@csrf
		  						<input type="hidden" name="text_id" value="3">
		  						<input type="hidden" name="cart_id" value="{{ $cart_id->cart_id }}" class="cart_id">
		  						<input type="hidden" name="card_id" value="{{ $cart_id->card_id }}" class="card_id">
								<input type="hidden" name="card_size_id" value="{{ $cart_id->sizes }}" class="cart_id">
		  						<input type="hidden" name="text_three" class="text_three" value="@if(!empty($db_text_data2)){{ $db_text_data2->Text }}@endif">
		  						<input type="hidden" name="text_size_three" class="text_size_three" value="@if(!empty($db_text_data2)){{ $db_text_data->size }}@endif">
		  						<input type="hidden" name="text_color_three" class="text_color_three" value="@if(!empty($db_text_data2)){{ $db_text_data2->color }}@endif">
		  						<button type="submit" name="btn">
			  						<svg viewBox="0 0 40 40" width="40" height="40"><circle cx="20" cy="20" r="19" fill="#F8F8F9" stroke="#087827" stroke-width="2"></circle><path fill-rule="evenodd" clip-rule="evenodd" d="M27.707 14.293a1 1 0 0 1 0 1.414l-10 10a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414L17 23.586l9.293-9.293a1 1 0 0 1 1.414 0Z" fill="#087827"></path></svg>	
			  						Done
		  					    </button>
		  					</form>
		  					
		  				</div>
		  			</div>
		  		</div>
		  		<div class="text-three-div">
		  			<div class="change_div_content add-text-div change_show_div-3" onclick="changeText(3)" style="@if(!empty($db_text_data2))display:none;@endif">
			  			<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="39.89333333333334" height="39.89333333333334" color="#00204D"><path fill-rule="evenodd" clip-rule="evenodd" d="M4 2a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4zm20 2H4v20h20V4zm-4 3H8v2.286a1 1 0 0 0 2 0V9h3v10h-.5a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2H15V9h3v.286a1 1 0 1 0 2 0V7z" fill="currentColor"></path></svg>
			  			<span>Add Text</span>
			  		</div>
			  		<div class="change_div_content change_text_div change_hide_div-3" style="@if(empty($db_text_data2))display:none;@endif">
			  			<textarea>
			  				@if(!empty($db_text_data2))
			  				{{ str_replace(' ', '', $db_text_data2->Text) }}
			  				@endif
			  			</textarea>
			  		</div>
		  		</div>
		  	</div>
		  </div>
		</div>
		
		
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
	// $(".card_editor_carousel").owlCarousel({
	//     items:3,
	    
	//     nav:true,
	//     dots:true
	// });
	var oldVal = "";
	$(".change_hide_div-1 textarea").on("change keyup paste", function() {
	    var currentVal = $(this).val();
	    
	    //action to be performed on textarea changed
	    console.log("textarea_val",currentVal);
	    $(".text_one").val(currentVal);
	});
	$(".change_hide_div-2 textarea").on("change keyup paste", function() {
	    var currentVal = $(this).val();
	    
	    //action to be performed on textarea changed
	    console.log("textarea_val",currentVal);
	    $(".text_two").val(currentVal);
	});
	$(".change_hide_div-3 textarea").on("change keyup paste", function() {
	    var currentVal = $(this).val();
	    
	    //action to be performed on textarea changed
	    console.log("textarea_val",currentVal);
	    $(".text_three").val(currentVal);
	});
	
	
	function changeText(i){

		if(i == 1){

			var currentVal2 = $(".change_hide_div-2 textarea").val();
			var currentVal3 = $(".change_hide_div-3 textarea").val();
			if(currentVal2 != ""){
				$(".change_show_div-2").hide();
				$(".change_hide_div-2").show();
			}else{
				$(".change_show_div-2").show();
				$(".change_hide_div-2").hide();
			}

			if(currentVal3 != ""){
				$(".change_show_div-3").hide();
				$(".change_hide_div-3").show();
			}else{
				$(".change_show_div-3").show();
				$(".change_hide_div-3").hide();
			}
			
			$(".change_show_div-1").hide();
			$(".change_hide_div-1").show();
			$(".text-tools").hide();
			$(".text-tools-one").show();
		}

		if(i == 2){
			var currentVal3 = $(".change_hide_div-3 textarea").val();
			var currentVal1 = $(".change_hide_div-1 textarea").val();
			if(currentVal3 != ""){
				$(".change_show_div-3").hide();
				$(".change_hide_div-3").show();
			}else{
				$(".change_show_div-3").show();
				$(".change_hide_div-3").hide();
			}

			if(currentVal1 != ""){
				$(".change_show_div-1").hide();
				$(".change_hide_div-1").show();
			}else{
				$(".change_show_div-1").show();
				$(".change_hide_div-1").hide();
			}
			//console.log("textarea_val1",currentVal);
			$(".change_show_div-2").hide();
			$(".change_hide_div-2").show();
			$(".text-tools").hide();
			$(".text-tools-two").show();
		}

		if(i == 3){

			var currentVal1 = $(".change_hide_div-1 textarea").val();
			var currentVal2 = $(".change_hide_div-2 textarea").val();
			if(currentVal1 != ""){
				$(".change_show_div-1").hide();
				$(".change_hide_div-1").show();
			}else{
				$(".change_show_div-1").show();
				$(".change_hide_div-1").hide();
			}

			if(currentVal2 != ""){
				$(".change_show_div-2").hide();
				$(".change_hide_div-2").show();
			}else{
				$(".change_show_div-2").show();
				$(".change_hide_div-2").hide();
			}
			
			$(".change_show_div-3").hide();
			$(".change_hide_div-3").show();
			$(".text-tools").hide();
			$(".text-tools-three").show();
		}
		
	}
	$(".text-tools-one .size-click").click(function(){
		$(".text-tools-one .size-tool-box").toggle();
	});
	$(".text-tools-one .color-click").click(function(){
		$(".text-tools-one .color-tool-box").toggle();
	});

	$(".text-tools-two .size-click").click(function(){
		$(".text-tools-two .size-tool-box").toggle();
	});
	$(".text-tools-two .color-click").click(function(){
		$(".text-tools-two .color-tool-box").toggle();
	});

	$(".text-tools-three .size-click").click(function(){
		$(".text-tools-three .size-tool-box").toggle();
	});
	$(".text-tools-three .color-click").click(function(){
		$(".text-tools-three .color-tool-box").toggle();
	});

	function changeTextSize(text_id,text_type,i){
        
		if(text_id == 1){
	        if(text_type == 'text-size'){
	        	$(".change_hide_div-1 textarea").css("font-size",i);
	        	$(".text_size_one").val(i);
	        } 

	        if(text_type == 'text-color'){
	        	$(".change_hide_div-1 textarea").css("color",i);
	        	$(".text_color_one").val(i);
	        }
    	}

    	if(text_id == 2){
	        if(text_type == 'text-size'){
	        	$(".change_hide_div-2 textarea").css("font-size",i);
	        	$(".text_size_two").val(i);
	        } 

	        if(text_type == 'text-color'){

	        	$(".change_hide_div-2 textarea").css("color",i);
				$(".text_color_two").val(i);
	        }
    	}

    	if(text_id == 3){
	        if(text_type == 'text-size'){
	        	$(".change_hide_div-3 textarea").css("font-size",i);
	        	$(".text_size_three").val(i);
	        } 

	        if(text_type == 'text-color'){
	        	$(".change_hide_div-3 textarea").css("color",i);
	        	$(".text_color_three").val(i);
	        }
    	}
		
	}

	$(".change_hide_div-1 textarea").click(function(){
		$(".text-tools").hide();
		$(".text-tools-one").show();
	});

	$(".change_hide_div-2 textarea").click(function(){
		$(".text-tools").hide();
		$(".text-tools-two").show();
	});

	$(".change_hide_div-3 textarea").click(function(){
		$(".text-tools").hide();
		$(".text-tools-three").show();
	});

</script>