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
					<input type="hidden" name="card_id" value="{{ $db_card_data->card_id }}">
					<input type="file" name="add_video_file" id="videoUpload">
					<input type="submit" name="add_video_btn" value="Replace Video">
				</form>
				<form method="post" action="{{ url('delete_video') }}">
					@csrf
					<input type="hidden" name="card_id" value="{{ $db_card_data->card_id }}">
					
					<input type="submit" name="delete_video_btn" value="Delete Video">
				</form>
			</div>
			<div class="no_thanks_btn">
				<a href="#">No Thanks</a>
			</div>
		</div>
	</div>
</div>	
<script src =  
    "https://code.jquery.com/jquery-3.5.1.js">  
</script>

