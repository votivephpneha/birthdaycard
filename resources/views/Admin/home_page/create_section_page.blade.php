@extends('Admin.layout.layout')

@section('title', 'Create Section Page')


@section('current_page_css')

@endsection


@section('current_page_js')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
       CKEDITOR.config.resize_enabled = false;
      
    });

    CKEDITOR.replace('page_content', {
    height: '20vh',
    width: '90vh',
});

$(document).ready(function() {
  
  $('#sec_name').change(function() {
    alert("sdasa");
  var value =  $('#sec_name').val();
  if(value == 'Section 2'){
    $('.demo').hide();
  }  
}); 
});
</script>

@endsection


@section('content')
<!-- page content -->
<div class="right_col" role="main">
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Create Section Page</h3>
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
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('create.sec.page.post')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Section Name:</label>
                    <input type="text" id="sec_name" name="sec_name"
                        class="form-control col-md-7 col-xs-12" value=""><br>
                        @if($errors->has('sec_name'))
                        <span class="text-danger">{{ $errors->first('sec_name')}}</span>
                        @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Section heading:</label>
                    <input type="text" id="sec_heading" name="sec_heading"
                        class="form-control col-md-7 col-xs-12" value=""><br>
                        @if($errors->has('sec_heading'))
                        <span class="text-danger">{{ $errors->first('sec_heading')}}</span>
                        @endif
                </div>
            </div>
           
            <div class="col-md-4">
                <div class="form-group">
                    <label>Section Banner image:</label>
                    <input type="file" id="ban_img" name="ban_img"
                        class="form-control col-md-7 col-xs-12" value=""><br>
                        @if($errors->has('ban_img'))
                        <span class="text-danger">{{ $errors->first('ban_img')}}</span>
                        @endif
                </div>
            </div>
            </div>
            <div class="row">
            
            <div class="col-md-4">
                <div class="form-group">
                    <label>Section Button1 Text:</label>
                    <input type="text" id="btntext1" name="btntext1"
                        class="form-control col-md-7 col-xs-12" value=""><br>
                        @if($errors->has('btntext1'))
                        <span class="text-danger">{{ $errors->first('btntext1')}}</span>
                        @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Section Button2 Text:</label>
                    <input type="text" id="btntext2" name="btntext2"
                        class="form-control col-md-7 col-xs-12" value=""><br>
                        @if($errors->has('btntext2'))
                        <span class="text-danger">{{ $errors->first('btntext2')}}</span>
                        @endif
                </div>
           </div>
                <div class="col-md-4">
                <div class="form-group">
                    <label>Section Status:</label>
                    <select name="sec_status" id="sec_status" class="form-control col-md-7 col-xs-12">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    @if($errors->has('sec_status'))
                    <span class="text-danger">{{ $errors->first('sec_status')}}</span>
                    @endif
                </div>
           
            </div>
            <div class="row">
            <div class="col-md-6 demo">
                <div class="form-group">
                    <label>Section description:</label>
                    <textarea  name="sec_content"  class="form-control ckeditor" ></textarea><br>
                        @if($errors->has('sec_content'))
                        <span class="text-danger">{{ $errors->first('sec_content')}}</span>
                        @endif
                </div>
            </div>
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