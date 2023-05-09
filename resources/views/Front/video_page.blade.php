<div class="container video_page" style="padding-left: 28%;">
	<div class="video_image_content">
		<div class="video_qr_image">
			<img src="{{ url('public/upload/cards') }}/{{ $db_card_data->card_image }}" style="width:200px;">
			<img alt="" src="https://static.web-personalise.prod.moonpig.net/_next/static/images/P2-47a781fcb5be06de21053471503c5bbd.jpg"style="width:200px;">
			<img src="https://static.web-personalise.prod.moonpig.net/_next/static/images/P3Default-1a23a70b0f9cca20268230eb2f6d18a9.jpg" style="width:200px;">
			
		</div>
		<div class="video_content">
			<h1>Surprise Them With a Free Video Message!</h1>
			<ol type="1">
				<li>You <span class="sc-hMqMXs elyeFD">upload </span>a video</li>
				<li>We print a <span class="sc-hMqMXs elyeFD">QR code inside </span>the card</li>
				<li>They <span class="sc-hMqMXs elyeFD">scan it </span>to play the video message</li>
			</ol>
			<p color="textOne" class="sc-hMqMXs eGmMiT">It's <span class="sc-hMqMXs elyeFD">FREE </span>(our gift to you).</p>
		</div>
		<div class="video_btns">
			<div class="add_video_btn">
				<form method="post" action="{{ url('post_video') }}" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="card_id" value="{{ $db_card_data->id }}">
					<input type="file" name="add_video_file">
					<input type="submit" name="add_video_btn" value="Add Video">
				</form>
			</div>
			<div class="no_thanks_btn">
				<a href="#">No Thanks</a>
			</div>
		</div>
	</div>
</div>	

