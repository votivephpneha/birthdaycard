@extends('Admin.layout.layout')
@section('title', 'Admin')

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
        <h3>Edit Text Font</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
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
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('edit.textfont.post',$messdata->id)}}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description"> Text Font <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="font_name" name="font_name" class="form-control col-md-7 col-xs-12" value="{{$messdata->font_name}}">
                  @if($errors->has('font_name'))

                  <span class="text-danger">{{ $errors->first('font_name')}}</span>

                  @endif
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                  <button type="submit" class="btn btn-dark">Submit</button>
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