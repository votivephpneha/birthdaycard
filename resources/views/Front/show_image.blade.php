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
  
</style>

<div class="container video_page">
  <div class="card-header row">
    <div class="exit_btn col-md-6">
      <a href="#">Back</a>
    </div>
    
    
    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ $message }}
        </div>
         @endif
         
  </div>
	<div class="video_image_content">
		@if ($message = Session::get('success'))
        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ $message }}
        </div>
         @endif
		<div class="video_qr video-controls hidden" id="video-controls" controls>
      <img src="{{ url('public/upload/home_images') }}/{{ $db_video_page_data->editor_image }}">
			
		</div>
		
		<div class="video_btns video_btns_qr">
			<div class="add_video_btn">
        
				
         <div class="customer_select_div">
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
      </div>  
			</div>	
		</div>
   
		
		
	</div>
</div>	


<script src =  
    "https://code.jquery.com/jquery-3.5.1.js">  
</script>
<script type="text/javascript">
	
    
    $(".exit_btn a").click(function(){
     
      window.history.back();
           
      
    });
</script>

@endsection
