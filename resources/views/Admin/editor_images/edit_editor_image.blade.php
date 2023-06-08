@extends('Admin.layout.layout')

@section('title', 'Edit Editor image')


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
      <h3>Edit Editor image</h3>
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
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('edit.editor.image.post',$editorimagedata->id)}}" enctype="multipart/form-data">
            @csrf            
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Editor Image<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="file" id="editor_image" name="editor_image"  class="form-control col-md-7 col-xs-12">
                @if($errors->has('editor_image'))
              <span class="text-danger">{{ $errors->first('editor_image')}}</span>
              @endif
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description"><span class="required"></span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">             
                  @if($editorimagedata->editor_image == "")
                  <img src="{{ url('public/images/imageicon.png')}}" height="50" width="50">
                  @else
                  <img src="{{ asset('public/upload/editorImages').'/'. $editorimagedata->editor_image}}" height="50" width="50">
                  @endif
              </div>
            </div>           
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="editor_image_status" id="editor_image_status"  class="form-control">
                    <option value="1"{{ $editorimagedata->status == '1' ? 'selected' : '' }}  >Active</option>
                    <option value="0"{{ $editorimagedata->status == '0' ? 'selected' : '' }}  >Inactive</option>
                  </select>
                  @if($errors->has('editor_image_status'))
                  <span class="text-danger">{{ $errors->first('editor_image_status')}}</span>
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