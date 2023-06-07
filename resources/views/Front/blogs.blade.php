@extends('Front.layout.layout')
@section('title', 'Birthdaycards')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<div class="container card_page card-blog">
	<div class="card_header">
		<h2>Blogs</h2>
	</div>
	<div class="row">
		
		@foreach ($blog_data as $blog)
			<div class="col-md-4">
				<a href="{{ url('blog_detail') }}/{{ $blog->id }}">
				    <div class="card--lists">
						<div class="blog_image">
							<img src="{{ url('/public/upload/blogs') }}/{{ $blog->blog_image }}" >
						</div>
						<div class="blog_content">
							<h3>{{ $blog->blog_title }}</h3>
							<p class="clen-btm">
								<?php
									$blog_date = date_create($blog->created_at);

									echo date_format($blog_date,"M d, Y");
								?>
							</p>
							<p>{!! Str::limit($blog->blog_description,60, '...') !!}</p>
						</div>	
					</div>
				</a>
			</div>
		
		@endforeach
	</div>
</div>	

@endsection
