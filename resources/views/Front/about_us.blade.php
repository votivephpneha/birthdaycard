@extends('Front.layout.layout')
@section('title', 'Home')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<div class="about-us-page">
<div class="container ">
	
	<div class="row align-items-center">
    <div class="col-md-12 ">
    	<div class="card_page">
    	<div class="about-us-title">
		<h2>{{$aboutdata->page_title}}</h2>
	</div>
		<div class="about-us-content ">
          <div class="content_body" >
          {!! $aboutdata->page_content !!}
          </div>
        </div>
    </div>	
</div>
	</div>
</div>
</div>
@endsection

