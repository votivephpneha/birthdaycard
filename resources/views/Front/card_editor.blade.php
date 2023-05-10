<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
<style type="text/css">
	.change_div_content textarea{
		text-align: center;
		
	}
</style>
<div class="card-section-div">
	<div class="card-header"></div>
	<div class="card-editor-content">
		<div class="card_editor_carousel owl-carousel">
		  <div class="card-block-one">
			<img src="{{ url('public/upload/cards') }}/{{ $db_card_data->card_image }}">
		  </div>
		  <div class="card-block-two">
			<img src="https://static.web-personalise.prod.moonpig.net/_next/static/images/P2-47a781fcb5be06de21053471503c5bbd.jpg">
			<img src="{{ $db_card_size_data->qr_image_link }}">
		  </div>
		  <div class="card-block-three">
		  	<div class="add_text_div">
		  		<div class="text-tools" style="display:none;">
		  			<div class="text-change-tools">
		  				<button class="change-tools size">
		  					<div class="text-number">30</div>
		  					<div class="text-font">Size</div>
		  				</button>
		  				<button class="change-tools size">
		  					<div class="text-number">Aa</div>
		  					<div class="text-font">Font</div>
		  				</button>
		  				<button class="change-tools size">
		  					<div class="text-number" style="background-color: black;width: 28px; height: 28px;"></div>
		  					<div class="text-font">Color</div>
		  				</button>
		  				<button class="change-tools size">
		  					<div class="text-number">
		  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28" height="28"><path fill-rule="evenodd" clip-rule="evenodd" d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1ZM7 9a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Z" fill="currentColor"></path></svg>
		  					</div>
		  					<div class="text-font">Align</div>
		  				</button>
		  				<button class="change-tools size">
		  					<div class="text-number">
		  						<svg viewBox="0 0 40 40" width="40" height="40"><circle cx="20" cy="20" r="19" fill="#F8F8F9" stroke="#087827" stroke-width="2"></circle><path fill-rule="evenodd" clip-rule="evenodd" d="M27.707 14.293a1 1 0 0 1 0 1.414l-10 10a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414L17 23.586l9.293-9.293a1 1 0 0 1 1.414 0Z" fill="#087827"></path></svg>
		  					</div>
		  					<div class="text-font">Done</div>
		  				</button>
		  			</div>
		  		</div>
		  		<div class="change_div_content change_show_div" onclick="changeText()">
		  			<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="39.89333333333334" height="39.89333333333334" color="#00204D"><path fill-rule="evenodd" clip-rule="evenodd" d="M4 2a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4zm20 2H4v20h20V4zm-4 3H8v2.286a1 1 0 0 0 2 0V9h3v10h-.5a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2H15V9h3v.286a1 1 0 1 0 2 0V7z" fill="currentColor"></path></svg>
		  			<span>Add Text</span>
		  		</div>
		  		<div class="change_div_content change_hide_div" style="display:none;">
		  			<textarea></textarea>
		  		</div>
		  	</div>
		  </div>
		</div>
		
		
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script type="text/javascript">
	$(".card_editor_carousel").owlCarousel({
	    items:3,
	    
	    nav:true,
	    dots:true
	});
	function changeText(){
		$(".change_show_div").hide();
		$(".change_hide_div").show();
		$(".text-tools").show();
	}
</script>