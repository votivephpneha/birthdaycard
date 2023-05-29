@extends('Admin.layout.layout')

@section('title', 'Edit Blog')


@section('current_page_css')

@endsection


@section('current_page_js')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
$(document).ready(function() {
      $('.ckeditor').ckeditor();
});
</script>

@endsection


@section('content')
<!-- page content -->
<div class="right_col" role="main">
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Edit Blog</h3>
    </div>

    <!-- <div class="title_right">
      <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div> -->
  </div>
  <div class="clearfix"></div>
  <div class="row">
  @if(Session::has('failed'))
    <div class="alert alert-danger alert-block">

        <button type="button" class="close" data-dismiss="alert">×</button>

        <strong>{{ Session::get('failed')}}</strong>

    </div>
    @endif
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{route('edit.blog.post',$blogdata->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Blog Title<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="blog_title" name="blog_title"  class="form-control col-md-7 col-xs-12" value="{{$blogdata->blog_title}}">
                @if($errors->has('blog_title'))

              <span class="text-danger">{{ $errors->first('blog_title')}}</span>

              @endif
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Blog Image<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" id="blog_image" name="blog_image"  class="form-control col-md-7 col-xs-12">
               
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Blog Image Preview<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">             
                  @if($blogdata->blog_image == "")
                  <img src="{{ url('public/images/imageicon.png')}}" height="50" width="50">
                  @else
                  <img src="{{ asset('public/upload/blogs').'/'. $blogdata->blog_image}}" height="50" width="50">
                  @endif
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Blog Status</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="blog_status" id="blog_status"  class="form-control">
                    <option value="1"{{ $blogdata->status == '1' ? 'selected' : '' }} >Active</option>
                    <option value="0"{{ $blogdata->status == '0' ? 'selected' : '' }} >Inactive</option>
                  </select>
                  @if($errors->has('blog_status'))
                  <span class="text-danger">{{ $errors->first('blog_status')}}</span>
                  @endif
              </div>
            </div>
            <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Blog description</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="blog_content" name="blog_content" rows="4" cols="50" class="form-control col-md-7 col-xs-12 ckeditor" >
                {{$blogdata->blog_description}}</textarea>
                    @if($errors->has('blog_content'))
                    <span class="text-danger">{{ $errors->first('blog_content')}}</span>
                    @endif
                </div>
              </div>                        
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">        
                <button type="submit" class="btn btn-dark">Submit</button>
                <input type="button"   class="btn btn-dark" value="Go Back" onClick="history.go(-1);"  />
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
<!-- /page content -->
@endsection