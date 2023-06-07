@extends('Admin.layout.layout')

@section('title', 'Edit Home First Slider')


@section('current_page_css')
<style>
.ck-editor__editable {
    min-height: 200px;
    min-width: 300px;
}
</style>
@endsection


@section('current_page_js')
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#editor'))
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#editor1'))
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#editor2'))
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#editor3'))
    .catch(error => {
        console.error(error);
    });

ClassicEditor
    .create(document.querySelector('#editor4'))
    .catch(error => {
        console.error(error);
    });
</script>
@endsection

@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Home First Slider</h3>
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
                        <form id="demo-form2" class="form-horizontal form-label-left" method="POST"
                            action="{{ route('edit.home.first.slider.post',$fslidedata->id)}}">
                            @csrf
                            <div class="row">
                                <!-- <div class="col-md-4">
                <div class="form-group">
                    <label>Page Name:</label>
                    <input type="text" id="page_name" name="page_name"
                        class="form-control col-md-7 col-xs-12" value="{{$fslidedata->slider_name}}" required><br>
                        @if($errors->has('page_name'))
                        <span class="text-danger">{{ $errors->first('page_name')}}</span>
                        @endif
                </div>
            </div> -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Slider Description 2:</label>
                                        <textarea id="editor1" name="slide_content_2" class="form-control" rows="10"
                                            cols="80"
                                            class="form-control">{{$fslidedata->slider_first_desc_2}}</textarea><br>
                                        @if($errors->has('slide_content_2'))
                                        <span class="text-danger">{{ $errors->first('slide_content_2')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Slider Status:</label>
                                        <select name="slid_status" id="slid_status"
                                            class="form-control col-md-7 col-xs-12" required>
                                            <option value="1" {{ $fslidedata->slide_status == 1 ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="0" {{ $fslidedata->slide_status == 0 ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select><br>
                                        @if($errors->has('slid_status'))
                                        <span class="text-danger">{{ $errors->first('slid_status')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                <div class="form-group">
                    <label>Slider Heading:</label>
                    <input type="text" id="slider_heading" name="slider_heading"
                        class="form-control col-md-7 col-xs-12" value="{{$fslidedata->slider_first_heading}}" required><br>
                        @if($errors->has('slider_heading'))
                        <span class="text-danger">{{ $errors->first('slider_heading')}}</span>
                        @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Slider Description 1:</label>
                    <textarea  name="slide_content_1"  class="form-control" required>{{$fslidedata->slider_first_desc_1}}</textarea><br>
                        @if($errors->has('slide_content_1'))
                        <span class="text-danger">{{ $errors->first('slide_content_1')}}</span>
                        @endif
                </div>
            </div>
            </div> -->
                            <div class="row">


                                <!-- <div class="col-md-4">
            <div class="form-group">
                    <label>Slider Description 3:</label>
                    <textarea id="editor2" name="slide_content_3"  class="form-control" >{{$fslidedata->slider_first_desc_3}}</textarea><br>
                        @if($errors->has('slide_content_2'))
                        <span class="text-danger">{{ $errors->first('slide_content_2')}}</span>
                        @endif
                </div>
           </div> -->
                                <!-- <div class="col-md-4">
                <div class="form-group">
                    <label>Slider Description 4:</label>
                    <textarea  id="editor3" name="slide_content_4"  class="form-control" >{{$fslidedata->slider_first_desc_4}}</textarea><br>
                        @if($errors->has('slide_content_2'))
                        <span class="text-danger">{{ $errors->first('slide_content_2')}}</span>
                        @endif
                </div> 
          </div>           -->
                            </div>
                            <div class="row">
                                <!-- <div class="col-md-4 demo">
            <div class="form-group">
                    <label>Slider Description 5:</label>
                    <textarea  id="editor4" name="slide_content_5"  class="form-control" >{{$fslidedata->slider_first_desc_5}}</textarea><br>
                        @if($errors->has('slide_content_2'))
                        <span class="text-danger">{{ $errors->first('slide_content_2')}}</span>
                        @endif
                </div> 
            </div> -->

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark">Submit</button>
                                <input type="button" class="btn btn-dark" value="Go Back" onClick="history.go(-1);" />
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