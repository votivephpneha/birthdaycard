@extends('Admin.layout.layout')

@section('title', 'Edit Demo Video')


@section('current_page_css')

@endsection


@section('current_page_js')

@endsection


@section('content')
<!-- page content -->
<div class="right_col" role="main">
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Edit Demo Video</h3>
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
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('edit.demo.video.post',$videodata->id)}}" enctype="multipart/form-data">
            @csrf            
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description"> Card Demo Video<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="file" id="video" name="video"  class="form-control col-md-7 col-xs-12" accept="video/mp4">
                @if($errors->has('video'))
              <span class="text-danger">{{ $errors->first('video')}}</span>
              @endif
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description"><span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">             
                  @if($videodata->editor_image == "")
                  <img src="{{ url('public/images/imageicon.png')}}" height="80" width="50">
                  @else
                  <video width="200" height="150" controls>
                <source src="{{ asset('public/upload/editorImages').'/'.$videodata->editor_image }}" type="video/mp4">    
                </video>
                  @endif
              </div>
            </div>           
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="video_status" id="video_status"  class="form-control">
                    <option value="1"{{ $videodata->status == '1' ? 'selected' : '' }}  >Active</option>
                    <option value="0"{{ $videodata->status == '0' ? 'selected' : '' }}  >Inactive</option>
                  </select>
                  @if($errors->has('video_status'))
                  <span class="text-danger">{{ $errors->first('video_status')}}</span>
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