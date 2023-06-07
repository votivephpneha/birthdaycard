@extends('Front.layout.layout')
@section('title', 'Birthdaycards')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<div class="container card_page">
	<div class="card_header">
		<h2>Blog details</h2>
	</div>
	<div class="row">
		<div class="col-md-8 offset-md-2 blog-details">
			<div class="blog_image">
				<img src="{{ url('public/upload/blogs') }}/{{ $blog_detail->blog_thumb_image }}">
			</div>
			<div class="blog_content">
				<h2>{{ $blog_detail->blog_title }}</h2>
				<p class="clen-btm">
					<?php
						$blog_date = date_create($blog_detail->created_at);

						echo date_format($blog_date,"M d, Y");
					?>
				</p>
				{!! $blog_detail->blog_description !!}
			</div>
		</div>
	</div>
</div>	

@endsection
