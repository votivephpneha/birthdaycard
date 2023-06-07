@extends('Admin.layout.layout')

@section('title', 'Create Home Second Slider')


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
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#editor1' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#editor2' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#editor3' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#editor4' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection


@section('content')
<!-- page content -->
<div class="right_col" role="main">
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Create Home Second Slider</h3>
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
          <form id="demo-form2" class="form-horizontal form-label-left" method="POST" action="{{ route('edit.home.sec.slider.post',$secslidedata->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <!-- <div class="col-md-4">
                <div class="form-group">
                    <label>Page Name:</label>
                    <input type="text" id="page_name" name="page_name"
                        class="form-control col-md-7 col-xs-12" value="{{$secslidedata->slider_name}}" required><br>
                        @if($errors->has('page_name'))
                        <span class="text-danger">{{ $errors->first('page_name')}}</span>
                        @endif
                </div>
            </div> -->
            <div class="col-md-4">
            <div class="form-group">
              <label>Slider Image :</label><br>
              <input type="file" id="sli_img_1" name="sli_img_1"
                  class="form-control col-md-7 col-xs-12"><br>
                  @if($secslidedata->slider_sec_img_1 == "")
                    <span id="preview-crop-image ">
                        <img width="80px" height="80px"
                            src="{{ url('public/images/imageicon.png')}}">
                    </span>
                    @else
                    <span id="preview-crop-image ">
                        <img width="80px" height="80px"
                            src="{{ asset('public/upload/home_slideimage').'/'.$secslidedata->slider_sec_img_1 }}">
                    </span>
                    @endif        
                @if($errors->has('sli_img_1'))
                 <span class="text-danger">{{ $errors->first('sli_img_1')}}</span>
                @endif
          </div>
            </div>
            <div class="col-md-4">
            <div class="form-group">
                <label>Slider Status:</label>
                <select name="slid_status" id="slid_status" class="form-control col-md-7 col-xs-12" required>
                    <option value="1" {{ $secslidedata->slider_status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $secslidedata->slider_status == 0 ? 'selected' : '' }}>Inactive</option>
                </select><br>
                @if($errors->has('slid_status'))
                <span class="text-danger">{{ $errors->first('slid_status')}}</span>
                @endif
              </div>
              </div>
            <!-- <div class="col-md-4">
                <div class="form-group">
                    <label>Slider Button Text:</label>
                    <input type="text" id="btn_text" name="btn_text"
                        class="form-control col-md-7 col-xs-12" value="{{$secslidedata->slider_sec_btntext}}" required><br>
                        @if($errors->has('btn_text'))
                        <span class="text-danger">{{ $errors->first('btn_text')}}</span>
                        @endif
                </div>
            </div> -->
            <!-- <div class="col-md-4">
                <div class="form-group">
                    <label>Slider Heading:</label>
                    <input type="text" id="slider_heading" name="slider_heading"
                        class="form-control col-md-7 col-xs-12" value="{{$secslidedata->slider_sec_heading}}" required><br>
                        @if($errors->has('slider_heading'))
                        <span class="text-danger">{{ $errors->first('slider_heading')}}</span>
                        @endif
                </div>
            </div> -->
            <!-- <div class="col-md-4">
                <div class="form-group">
                    <label>Slider Description :</label>
                    <textarea  name="slide_content"  class="form-control" required>{{$secslidedata->slider_sec_desc}}</textarea><br>
                   
                    @if($errors->has('slide_content_1'))
                        <span class="text-danger">{{ $errors->first('slide_content_1')}}</span>
                        @endif
                </div>
            </div> -->
            </div>
            <div class="row">
            
            
            
            <!-- <div class="col-md-4">
            <div class="form-group">
              <label>Slider Image 2 :</label><br>
              <input type="file" id="sli_img_2" name="sli_img_2"
                  class="form-control col-md-7 col-xs-12"><br>
                  @if($secslidedata->slider_sec_img_2 == "")
                    <span id="preview-crop-image ">
                        <img width="80px" height="80px"
                            src="{{ url('public/images/imageicon.png')}}">
                    </span>
                    @else
                    <span id="preview-crop-image ">
                        <img width="80px" height="80px"
                            src="{{ asset('public/upload/home_slideimage').'/'.$secslidedata->slider_sec_img_2 }}">
                    </span>
                    @endif 
                @if($errors->has('sli_img_2'))
                 <span class="text-danger">{{ $errors->first('sli_img_2')}}</span>
                @endif              
          </div>
           </div> -->
          <!-- <div class="col-md-4">
          <div class="form-group">
              <label>Slider Image 3 :</label><br>
              <input type="file" id="sli_img_3" name="sli_img_3"
                  class="form-control col-md-7 col-xs-12"><br>
                  @if($secslidedata->slider_sec_img_3 == "")
                    <span id="preview-crop-image ">
                        <img width="80px" height="80px"
                            src="{{ url('public/images/imageicon.png')}}">
                    </span>
                    @else
                    <span id="preview-crop-image ">
                        <img width="80px" height="80px"
                            src="{{ asset('public/upload/home_slideimage').'/'.$secslidedata->slider_sec_img_3 }}">
                    </span>
                    @endif 
                @if($errors->has('sli_img_3'))
                <span class="text-danger">{{ $errors->first('sli_img_3')}}</span>
              @endif              
          </div>
          </div>           -->
            </div>
            <div class="row">
            <!-- <div class="col-md-4 demo">
            <div class="form-group">
              <label>Slider Image 4:</label><br>
              <input type="file" id="sli_img_4" name="sli_img_4"
                  class="form-control col-md-7 col-xs-12"><br>
                  @if($secslidedata->slider_sec_img_4 == "")
                    <span id="preview-crop-image ">
                        <img width="80px" height="80px"
                            src="{{ url('public/images/imageicon.png')}}">
                    </span>
                    @else
                    <span id="preview-crop-image ">
                        <img width="80px" height="80px"
                            src="{{ asset('public/upload/home_slideimage').'/'.$secslidedata->slider_sec_img_4 }}">
                    </span>
                    @endif 
                  @if($errors->has('sli_img_4'))
                 <span class="text-danger">{{ $errors->first('sli_img_4')}}</span>
                @endif              
             </div>
            </div> -->
            
           </div>
           <div class="form-group">                
                    <button type="submit" class="btn btn-dark">Submit</button>
                    <input type="button" class="btn btn-dark" value="Go Back"
                        onClick="history.go(-1);" />     
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