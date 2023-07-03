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
    width: 100%;
    height: 329px;
    object-fit: cover;
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
  
</style>

<div class="container video_page">
  <div class="card-header row">
    <div class="exit_btn col-md-6">
      <a href="#">Back</a>
    </div>
  </div>
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
        <source src="{{ url('public/upload/videos') }}/{{ $db_card_data->video_name }}#t=0.1" type="video/mp4">
        Your browser does not support the video tag.
      </video>
      <figcaption>
  
     <button id="play" aria-label="Play" role="button">►</button>
    <progress id="progress" max="100" value="0">Progress</progress>
    </figcaotion>
</figure>
      
    </div>
    
    <div class="video_btns video_btns_qr">
      <div class="add_video_btn">
        <div class="agree_bx">
          <div class="chk_cond">
          <input id="checkbox" type="checkbox" />
          <label for="checkbox"> I agree to these <a href="{{ url('terms-service') }}">Terms and Conditions</a>.</label>
          <span></span>
          </div>
        </div>
        <span class="upload_error"></span>
        <div class="progress" id="progress_bar" style="display:none;height:50px; line-height: 50px;">

            <div class="progress-bar" id="progress_bar_process" role="progressbar" style="width:0%;">0%</div>

        </div>
        <br>
        <form class="replace_btn" id="attachUpload" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="qr_img_val" value="" class="qr_image">
          <input type="hidden" name="card_id" value="{{ $card_id }}">
          <input type="hidden" name="card_size_id" value="{{ $card_size_id }}">
          <input type="file" name="add_video_file" id="replace_video">
          <input type="hidden" name="cart_id" value="{{ $cart_id }}">
          <label class="label-add-video" for="replace_video">Replace Video <i class='bx bx-sync'></i></label>
          
        </form>
        <!-- <form class="del_video_btn" method="post" action="{{ url('delete_video') }}">
          @csrf
          <input type="hidden" name="card_id" value="{{ $card_id }}">
          <input type="hidden" name="card_size_id" value="{{ $card_size_id }}">
          <input type="hidden" name="cart_id" value="{{ $cart_id }}">
          <button type="submit" name="delete_video_btn">Delete Video<i class='bx bx-trash'></i></button>
          
        </form> -->
         <!-- <div class="customer_select_div">
          <h2>Would you like your card to be handwritten or printed</h2>
          <div class="content">
            <h4>Please Select</h4>
            <div class="btns">
              <div class="text-center mb-4 pb-2">
              <a class="hanrigt" href="{{ url('card_editor') }}/{{$card_id}}/{{$card_size_id}}/Handwritten">Handwritten</a>
            </div>
             <div class="text-center">
              <a class="printer" href="{{ url('card_editor') }}/{{$card_id}}/{{$card_size_id}}/Printed">Printed</a>
            </div>
            </div>
          </div>
        </div>
      </div>   -->
    </div>
    
    <div class="footer-ctn">
      <div>
        <a href="#" class="countinue_btn">Continue</a>
      </div>
    </div>
  </div>
</div>  


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
  document.getElementById("replace_video")
  .onchange = function(event) {
    let file = event.target.files[0];
    var file_time = "<?php echo time(); ?>";
    var filename = file.name;
    var file_extension = filename.split(".");
    console.log("file","{{ url('public/upload/videos') }}/"+file.name);
    var file_size = file.size/ 1024 / 1024;
    let finalURL =  
'https://chart.googleapis.com/chart?cht=qr&chl=' +  
        htmlEncode("{{ url('public/upload/videos') }}/"+file.name) +  
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
        form_data.append('card_id', "{{ $card_id }}");
        form_data.append('card_size_id', "{{ $card_size_id }}");
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
    $(".countinue_btn").click(function(){

      if($("#checkbox").prop('checked') != true){
        $(".agree_bx .chk_cond span").html("<div style='color:red;'>Please check Terms & Conditions checkbox</div>");
    }else{

      $(".countinue_btn").attr("href","{{ url('/show_video_image') }}/{{ $cart_id }}");
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

setInterval(function(){
 var video_current_time = video.currentTime;
 var video_total_time = video.duration;    
 if(video_current_time == video_total_time){
  button.innerHTML = "►";
 }
},500)

$(".exit_btn a").click(function(){
  
    window.history.back();
       
  
});

</script>
@endsection
