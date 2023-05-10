<div class="container video_page" style="padding-left: 28%;">
	<div class="video_image_content">
		<div class="video_qr">
			<video width="320" height="240" controls>
			  <source src="{{ url('public/upload/videos') }}/{{ $db_card_data->video }}" type="video/mp4">
			  
			  Your browser does not support the video tag.
			</video>
			
		</div>
		
		<div class="video_btns_qr">
			<div class="add_video_btn">
				<form method="post" action="{{ url('post_video') }}" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="qr_img_val" value="" class="qr_image">
					<input type="hidden" name="card_id" value="{{ $db_card_data->card_id }}">
					<input type="hidden" name="card_size_id" value="{{ $card_size_id }}">
					<input type="file" name="add_video_file" id="videoUpload">
					<input type="submit" name="add_video_btn" value="Replace Video">
				</form>
				<form method="post" action="{{ url('delete_video') }}">
					@csrf
					<input type="hidden" name="card_id" value="{{ $db_card_data->card_id }}">
					<input type="hidden" name="card_size_id" value="{{ $card_size_id }}">
					<input type="submit" name="delete_video_btn" value="Delete Video">
				</form>
			</div>
			<div class="countinue_btn">
				<a href="{{ url('/card_editor') }}/{{ $db_card_data->card_id }}/{{ $card_size_id }}">Continue</a>
			</div>
		</div>
	</div>
</div>	
<script src =  
    "https://code.jquery.com/jquery-3.5.1.js">  
</script>
<script type="text/javascript">
	document.getElementById("videoUpload")
	.onchange = function(event) {
	  let file = event.target.files[0];

	  console.log("file","{{ url('public/upload/videos') }}/"+file.name);
	  
	  let finalURL =  
'https://chart.googleapis.com/chart?cht=qr&chl=' +  
        htmlEncode("{{ url('public/upload/videos') }}/"+file.name) +  
        '&chs=160x160&chld=L|0' 
        console.log("finalURL",finalURL);
        $('.qr-code').attr('src', finalURL);  
       $(".qr_image").val(finalURL); 
	  
	}

	function htmlEncode(value) {  
    return $('<div/>').text(value)  
        .html();  
    }  
</script>

