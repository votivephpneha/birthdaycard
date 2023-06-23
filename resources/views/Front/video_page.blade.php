@extends('Front.layout.video_page_scripting')
@section('title', 'Video Page')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<style>

figure {
  box-shadow: 0 2.8px 2.2px rgba(0, 0, 0, 0.034),
    0 6.7px 5.3px rgba(0, 0, 0, 0.048), 0 12.5px 10px rgba(0, 0, 0, 0.06),
    0 22.3px 17.9px rgba(0, 0, 0, 0.072), 0 41.8px 33.4px rgba(0, 0, 0, 0.086),
    0 100px 80px rgba(0, 0, 0, 0.12);
/*  width: 50%;*/
}

video {
  display: block;
/*  width: 100%;*/
}

figcaption {
  align-items: center;
  background: #eaeaea;
  height: 15px;
  padding: 0.5rem;
}

button {
  border: 0;
  background: #e52e71;
  display: inline;
  color: white;
  order: 1;
  padding: 0.8rem;
  transition: opacity 0.25s ease-out;
/*  width: 100%;*/
}
button:hover {
  cursor: pointer;
  opacity: 0.8;
}

label {
  order: 2;
  text-align: center;
}

/* Fallback stuff */
progress[value] {
  appearance: none;
  border: none;
  border-radius: 3px;
  box-shadow: 0 2px 3px rgba(0, 0, 0, 0.25) inset;
  color: dodgerblue;
  display: inline;
}  
</style>
<div class="container video_page">
	
	<div class="video_image_content">
		<div class="video_qr_image">
			<div class="video_qr video-controls hidden" id="video-controls">
				<figure>
					<video width="100%" height="auto" class="video" id="video" preload="metadata" controls muted playsinline>
						<source src="{{ url('public/upload/editorImages') }}/{{ $db_video_page_data->editor_image }}" type="video/mp4">
						Your browser does not support the video tag.
					</video>
					<figcaption>
				  
					    <button id="play" aria-label="Play" role="button">►</button>
					    <progress id="progress" max="100" value="0">Progress</progress>
				    </figcaotion>
				</figure>
			
			</div>
			
		</div>
		<!-- <div class="video_thumb" style="display:none">
		<div class="befir-vidow">
	    <p>  Video will show here.</p>
	    </div>

			</div> -->
		<div class="video_content">
			<h1>Surprise Them With a Free Video Message!</h1>

			
			<!--<ol type="1">
				<li>You <span class="sc-hMqMXs elyeFD">upload </span>a video</li>
				<li>We print a <span class="sc-hMqMXs elyeFD">QR code inside </span>the card</li>
				<li>They <span class="sc-hMqMXs elyeFD">scan it </span>to play the video message</li>
			</ol>-->
			
			<div class="process-wrap active-step1">
  <div class="process-main">
    <div class="col-3 ">
      <div class="process-step-cont">
        <div class="process-step step-1"></div>
        <span class="process-label">You <span class="sc-hMqMXs elyeFD">upload </span>a video</span>
      </div>
    </div>
    <div class="col-3 ">
      <div class="process-step-cont">
        <div class="process-step step-2"></div>
        <span class="process-label">We print a <span class="sc-hMqMXs elyeFD">QR code inside </span>the card</span>
      </div>
    </div>
    <div class="col-3">
      <div class="process-step-cont">
        <div class="process-step step-3"></div>
        <span class="process-label">They <span class="sc-hMqMXs elyeFD">scan it </span>to play the video message</span>
      </div>
    </div>
  </div>
</div>
			
			<p color="textOne" class="sc-hMqMXs eGmMiT">It's <span class="sc-hMqMXs elyeFD">FREE </span>(our gift to you).</p>
			
			<div class="video_btns">
			<div class="add_video_btn">
				<span class="upload_error"></span>
				@if ($message = Session::get('error'))
		        <div class="alert alert-danger">
		          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		          {{ $message }}
		        </div>
		        @endif
		        <div class="progress" id="progress_bar" style="display:none;height:50px; line-height: 50px;">

		            <div class="progress-bar" id="progress_bar_process" role="progressbar" style="width:0%;">0%</div>

		        </div>
		        <div id="uploaded_image" class="row mt-5"></div>
				<form id="attachUpload" method="post" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="qr_img_val" value="" class="qr_image">
					<input type="hidden" name="card_id" value="{{ $db_card_data->id }}">
					<input type="hidden" name="card_size_id" value="{{ $c_size_id }}">
					<input type="hidden" name="cart_id" value="{{ $cart_id }}">
					<input type="file" name="add_video_file" id='videoUpload'>
					<label class="label-add-video" for="videoUpload">Add Video</label>
					<!-- <input type="button" name="add_video_btn" value="Continue to Card Editor" class="cont_btn"> -->
				</form>
			</div>
			<div class="no_thanks_btn">
				<a href="{{ url('/show_video_image') }}/{{ $cart_id }}">No Thanks</a>
			</div>
		</div>
			
		</div>
		
	</div>
</div>	
<script src =  
    "https://code.jquery.com/jquery-3.5.1.js">  
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script type="text/javascript">
	

	$(".cont_btn").click(function(){
	  	
		var video_source1 = $('#video source').attr("src");
		if(video_source1 != ""){
		  window.location.href = "{{ url('card_editor') }}/{{ $db_card_data->id }}/{{ $c_size_id }}";
		}else{
		  $("#uploaded_image").html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Please upload the video</div>');
		}
    });
	document.getElementById("videoUpload")
	.onchange = function(event) {
	  let file = event.target.files[0];
    var filename = file.name;
	  
    var file_size = file.size/ 1024 / 1024;
    var file_time = "<?php echo time(); ?>";
    var filename = file.name;
    var file_extension = filename.split(".");
	  var file_size = file.size/ 1024 / 1024;
	  let finalURL =  
'https://chart.googleapis.com/chart?cht=qr&chl=' +  
        htmlEncode("{{ url('public/upload/videos') }}/"+file_time+"."+file_extension[1]) +  
        '&chs=160x160&chld=L|0' 
        console.log("finalURL",finalURL);
        $('.qr-code').attr('src', finalURL);  
       $(".qr_image").val(finalURL); 
	   
       	// $('#attachUpload').attr("action","{{ url('post_video') }}");
       	// $('#attachUpload').trigger('submit');
       	var form_data = new FormData();

        form_data.append('add_video_file', file);

        form_data.append('_token', document.getElementsByName('_token')[0].value);
        form_data.append('qr_img_val', finalURL);
        form_data.append('card_id', "{{ $db_card_data->id }}");
        form_data.append('card_size_id', "{{ $c_size_id }}");
        form_data.append('cart_id', "{{ $cart_id }}");
        form_data.append('file_time', file_time);

        progress_bar.style.display = 'block';

        var ajax_request = new XMLHttpRequest();

        ajax_request.open("POST", "{{ url('post_video') }}");
        var percent = 0;
        ajax_request.upload.addEventListener('progress', function(event){

            var percent_completed = Math.round((event.loaded / event.total) * 100);

            progress_bar_process.style.width = percent_completed + '%';

            progress_bar_process.innerHTML = percent_completed + '% completed';

            percent = percent_completed;

        });
       
        console.log($("#progress_bar_process").html()); 

        var video_data = ajax_request.send(form_data);

        

        ajax_request.onload = function() {
          window.location.href = "{{ url('show_video') }}/{{ $cart_id }}";
          
        }
       
	}

	function htmlEncode(value) {  
    return $('<div/>').text(value)  
        .html();  
    }  
</script>
<script type="text/javascript">
	// Select elements here
const video = document.getElementById('video');
const videoControls = document.getElementById('video-controls');

const videoWorks = !!document.createElement('video').canPlayType;
if (videoWorks) {
  video.controls = false;
  videoControls.classList.remove('hidden');
}
</script>
<script>
	
const progress = document.getElementById("progress");

function progressLoop() {
  $(function () {
    $(window).on("scroll resize", function () {
        var top = $(window).scrollTop();
        var heightDiff = $(document).height() - $(window).height();
        var o = top == 0 ? 0 : (top / (heightDiff == 0 ? 1 : heightDiff));
        $(".progress-bar").css({
            "width": (100 * o) + "%"
        });
        $('progress')[0].value = o;
    })  
});
}

button = document.getElementById( "play" );

function playPause() { 
	
  if ( video.paused ) {
    video.play();
    button.innerHTML = "❙❙";
    
  }
  else  {
    video.pause(); 
    button.innerHTML = "►";
  }
}

button.addEventListener( "click", playPause );
video.addEventListener("play", progressLoop);
setInterval(function(){
 var video_current_time = video.currentTime;
 var video_total_time = video.duration;    
 if(video_current_time == video_total_time){
  button.innerHTML = "►";
 }
},500)

</script>
@endsection