@extends('Front.layout.video_page_scripting')
@section('title', 'Video Page')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<style type="text/css">
	body {
  background-image: radial-gradient(circle at top right, #17141d, white);
  display: grid;
  height: 100vh;
  place-items: center;
  width: 100%;
}

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
  h
</style>

<div class="container video_page">
	<div class="video_image_content">
		@if ($message = Session::get('success'))
        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ $message }}
        </div>
         @endif
		<div class="video_qr video-controls hidden" id="video-controls">
<figure>
			 <video width="100%" height="auto" class="video" id="video" preload="metadata" controls>
			  <source src="{{ url('public/upload/videos') }}/{{ $db_card_data->video_name }}" type="video/mp4">
			  Your browser does not support the video tag.
			</video>
			<figcaption>
  
     <button id="play" aria-label="Play" role="button">►</button>
    <progress id="progress" max="100" value="0">Progress</progress>
    </figcaotion>
</figure>
			
		</div>
		
		<div class="video_btns_qr">
			<div class="add_video_btn">
				<form class="replace_btn" id="attachUpload" method="post" action="{{ url('post_video') }}" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="qr_img_val" value="" class="qr_image">
					<input type="hidden" name="card_id" value="{{ $card_id }}">
					<input type="hidden" name="card_size_id" value="{{ $card_size_id }}">
					<input type="file" name="add_video_file" id="replace_video">
					<input type="hidden" name="cart_id" value="{{ $cart_id }}">
					<label class="label-add-video" for="replace_video">Replace Video <i class='bx bx-sync'></i></label>
					<!-- <input type="submit" name="add_video_btn" value="Replace Video"> -->
				</form>
				<form class="del_video_btn" method="post" action="{{ url('delete_video') }}">
					@csrf
					<input type="hidden" name="card_id" value="{{ $card_id }}">
					<input type="hidden" name="card_size_id" value="{{ $card_size_id }}">
					<input type="hidden" name="cart_id" value="{{ $cart_id }}">
					<button type="submit" name="delete_video_btn">Delete Video<i class='bx bx-trash'></i></button>
					<!-- <input type="submit" name="delete_video_btn" value="Delete Video"> -->
				</form>
			</div>	
		</div>
		<div class="agree_bx">
		  <div class="chk_cond">
			<input id="checkbox" type="checkbox" />
			<label for="checkbox"> I agree to these <a href="#">Terms and Conditions</a>.</label>

		  </div>
		</div>
		<div class="footer-ctn">
			<div class="countinue_btn">
				<a href="#">Continue to Card Editor</a>
			</div>
		</div>
	</div>
</div>	


<script src =  
    "https://code.jquery.com/jquery-3.5.1.js">  
</script>
<script type="text/javascript">
	document.getElementById("replace_video")
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
	   $('#attachUpload').trigger('submit');
	}

	function htmlEncode(value) {  
    return $('<div/>').text(value)  
        .html();  
    }  
    $(".countinue_btn").click(function(){
    	if($("#checkbox").prop('checked') != true){
	    	$(".agree_bx .chk_cond").append("<div style='color:red;'>Please check Terms & Conditions checkbox</div>");
		}else{
			$(".countinue_btn a").attr("href","{{ url('/card_editor') }}/{{ $card_id }}/{{ $card_size_id }}");
		}
    });
    
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
</script>
@endsection
