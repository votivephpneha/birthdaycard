@extends('Admin.layout.layout')

@section('title', 'Edit Home Content')


@section('current_page_css')

@endsection


@section('current_page_js')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
CKEDITOR.replace('sec_5_con_3', {
    resize_enabled: false,
    height: 150,
    width: 500
});
CKEDITOR.replace('sec_5_con_2', {
    resize_enabled: false,
    height: 150,
    width: 500
});
</script>

@endsection


@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Home Content</h3>
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
            @if(Session::has('success'))
            <div class="alert alert-success alert-block">

                <button type="button" class="close" data-dismiss="alert">×</button>

                <strong>{{ Session::get('success')}}</strong>

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
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                            method="POST" action="{{ route('edit.secpage.page.post',$secdata->id)}}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Page Name:</label>
                                        <input type="text" id="sec_name" name="sec_name"
                                            class="form-control col-md-7 col-xs-12" value="{{$secdata->section_name}}"
                                            required><br>
                                        @if($errors->has('sec_name'))
                                        <span class="text-danger">{{ $errors->first('sec_name')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First Section heading:</label>
                                        <input type="text" id="sec_heading" name="sec_heading"
                                            class="form-control col-md-7 col-xs-12"
                                            value="{{$secdata->section_1_heading}}" required><br>
                                        @if($errors->has('sec_heading'))
                                        <span class="text-danger">{{ $errors->first('sec_heading')}}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First Section Button1 Text:</label>
                                        <input type="text" id="btntext1" name="btntext1"
                                            class="form-control col-md-7 col-xs-12"
                                            value="{{$secdata->section_1_btn_text2}}" required><br>
                                        @if($errors->has('btntext1'))
                                        <span class="text-danger">{{ $errors->first('btntext1')}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First Section Button2 Text:</label>
                                        <input type="text" id="btntext2" name="btntext2"
                                            class="form-control col-md-7 col-xs-12"
                                            value="{{$secdata->section_1_btn_text2}}" required><br>
                                        @if($errors->has('btntext2'))
                                        <span class="text-danger">{{ $errors->first('btntext2')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Section Status:</label>
                                        <select name="sec_status" id="sec_status"
                                            class="form-control col-md-7 col-xs-12">
                                            <option value="1" {{ $secdata->sec_status == 'Active' ? 'selected' : '' }}>
                                                Active</option>
                                            <option value="0" {{ $secdata->sec_status == 'Active' ? 'selected' : '' }}>
                                                Inactive</option>
                                        </select><br>
                                        @if($errors->has('sec_status'))
                                        <span class="text-danger">{{ $errors->first('sec_status')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>First Section Banner image:</label>
                                        <input type="file" id="ban_img" name="ban_img"
                                            class="form-control col-md-7 col-xs-12"> <br>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 demo">
                                    <div class="form-group">
                                        <label>First Section description:</label>
                                        <textarea name="sec_content" class="form-control " rows="4" cols="50"
                                            style="resize: none;" required>{{$secdata->section_1_desc}}</textarea><br>
                                        @if($errors->has('sec_content'))
                                        <span class="text-danger">{{ $errors->first('sec_content')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 demo">
                                    <div class="form-group">
                                        <label>First Banner Image Preview:</label><br>
                                        @if($secdata->section_1_banner_img == "")
                                        <span id="preview-crop-image ">
                                            <img width="80px" height="80px"
                                                src="{{ url('public/images/imageicon.png')}}">
                                        </span>
                                        @else
                                        <span id="preview-crop-image ">
                                            <img width="80px" height="80px"
                                                src="{{ asset('public/upload/home_images').'/'. $secdata->section_1_banner_img}}">
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 demo">
                                    <div class="form-group">
                                        <label>Second Section Image1 :</label><br>
                                        <input type="file" id="fimage" name="fimage"
                                            class="form-control col-md-7 col-xs-12"> <br>
                                        @if($secdata->section_2_image_1 == "")
                                        <span id="preview-crop-image ">
                                            <img width="80px" height="80px"
                                                src="{{ url('public/images/imageicon.png')}}">
                                        </span>
                                        @else
                                        <span id="preview-crop-image ">
                                            <img width="80px" height="80px"
                                                src="{{ asset('public/upload/home_images').'/'. $secdata->section_2_image_1}}">
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 demo">
                                    <div class="form-group">
                                        <label>Second Section Image2 :</label><br>
                                        <input type="file" id="simage" name="simage"
                                            class="form-control col-md-7 col-xs-12"> <br>
                                        @if($secdata->section_2_image_2 == "")
                                        <span id="preview-crop-image ">
                                            <img width="80px" height="80px"
                                                src="{{ url('public/images/imageicon.png')}}">
                                        </span>
                                        @else
                                        <span id="preview-crop-image ">
                                            <img width="80px" height="80px"
                                                src="{{ asset('public/upload/home_images').'/'. $secdata->section_2_image_2}}">
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 demo">
                                    <div class="form-group">
                                        <label>Second Section Image3 :</label><br>
                                        <input type="file" id="timage" name="timage"
                                            class="form-control col-md-7 col-xs-12"> <br>
                                        @if($secdata->section_2_image_3 == "")
                                        <span id="preview-crop-image ">
                                            <img width="80px" height="80px"
                                                src="{{ url('public/images/imageicon.png')}}">
                                        </span>
                                        @else
                                        <span id="preview-crop-image ">
                                            <img width="80px" height="80px"
                                                src="{{ asset('public/upload/home_images').'/'. $secdata->section_2_image_3}}">
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 demo">
                                    <div class="form-group">
                                        <label>Second Section Image4 :</label><br>
                                        <input type="file" id="fouimage" name="fouimage"
                                            class="form-control col-md-7 col-xs-12"> <br>
                                        @if($secdata->section_2_image_4 == "")
                                        <span id="preview-crop-image ">
                                            <img width="80px" height="80px"
                                                src="{{ url('public/images/imageicon.png')}}">
                                        </span>
                                        @else
                                        <span id="preview-crop-image ">
                                            <img width="80px" height="80px"
                                                src="{{ asset('public/upload/home_images').'/'. $secdata->section_2_image_4}}">
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Third Section heading:</label>
                                                <input type="text" id="sec_3_heading" name="sec_3_heading"
                                                    class="form-control col-md-7 col-xs-12"
                                                    value="{{$secdata->section_3_heading}}" required><br>
                                                @if($errors->has('sec_3_heading'))
                                                <span class="text-danger">{{ $errors->first('sec_3_heading')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Third Section Button Text:</label>
                                                <input type="text" id="sec_3_btntext" name="sec_3_btntext"
                                                    class="form-control col-md-7 col-xs-12"
                                                    value="{{$secdata->section_3_btn_text}}" required><br>
                                                @if($errors->has('sec_3_btntext'))
                                                <span class="text-danger">{{ $errors->first('sec_3_btntext')}}</span>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Third Section description:</label>
                                                <textarea name="sec_3_content" class="form-control " rows="4" cols="50"
                                                    style="resize: none;"
                                                    required>{{$secdata->section_3_desc}}</textarea><br>
                                                @if($errors->has('sec_3_content'))
                                                <span class="text-danger">{{ $errors->first('sec_3_content')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Third Section Image :</label><br>
                                                <input type="file" id="sec_3_image" name="sec_3_image"
                                                    class="form-control col-md-7 col-xs-12"> <br>
                                                @if($secdata->section_3_image == "")
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ url('public/images/imageicon.png')}}">
                                                </span>
                                                @else
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('public/upload/home_images').'/'. $secdata->section_3_image}}">
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fourth Section heading 1:</label>
                                                <input type="text" id="sec_4_heading_1" name="sec_4_heading_1"
                                                    class="form-control col-md-7 col-xs-12"
                                                    value="{{$secdata->section_4_heading_1}}" required><br>
                                                @if($errors->has('sec_3_heading'))
                                                <span class="text-danger">{{ $errors->first('sec_3_heading')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fourth Section description 1:</label>
                                                <textarea name="sec_4_con_1" class="form-control " rows="4" cols="50"
                                                    style="resize: none;"
                                                    required>{{$secdata->section_4_desc_1}}</textarea><br>
                                                @if($errors->has('sec_3_content'))
                                                <span class="text-danger">{{ $errors->first('sec_3_content')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fourth Section heading 2:</label>
                                                <input type="text" id="sec_4_heading_2" name="sec_4_heading_2"
                                                    class="form-control col-md-7 col-xs-12"
                                                    value="{{$secdata->section_4_heading_2}}" required><br>
                                                @if($errors->has('sec_3_heading'))
                                                <span class="text-danger">{{ $errors->first('sec_3_heading')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fourth Section description 2:</label>
                                                <textarea name="sec_4_con_2" class="form-control " rows="4" cols="50"
                                                    style="resize: none;"
                                                    required>{{$secdata->section_4_desc_2}}</textarea><br>
                                                @if($errors->has('sec_3_content'))
                                                <span class="text-danger">{{ $errors->first('sec_3_content')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fourth Section heading 3:</label>
                                                <input type="text" id="sec_4_heading_3" name="sec_4_heading_3"
                                                    class="form-control col-md-7 col-xs-12"
                                                    value="{{$secdata->section_4_heading_3}}" required><br>
                                                @if($errors->has('sec_3_heading'))
                                                <span class="text-danger">{{ $errors->first('sec_3_heading')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fourth Section description 3:</label>
                                                <textarea name="sec_4_con_3" class="form-control " rows="4" cols="50"
                                                    style="resize: none;"
                                                    required>{{$secdata->section_4_desc_3}}</textarea><br>
                                                @if($errors->has('sec_3_content'))
                                                <span class="text-danger">{{ $errors->first('sec_3_content')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fourth Section heading 4:</label>
                                                <input type="text" id="sec_4_heading_4" name="sec_4_heading_4"
                                                    class="form-control col-md-7 col-xs-12"
                                                    value="{{$secdata->section_4_heading_4}}" required><br>
                                                @if($errors->has('sec_3_heading'))
                                                <span class="text-danger">{{ $errors->first('sec_3_heading')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fourth Section description 4:</label>
                                                <textarea name="sec_4_con_4" class="form-control " rows="4" cols="50"
                                                    style="resize: none;"
                                                    required>{{$secdata->section_4_desc_4}}</textarea><br>
                                                @if($errors->has('sec_3_content'))
                                                <span class="text-danger">{{ $errors->first('sec_3_content')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fourth Section Image 1 :</label><br>
                                                <input type="file" id="sec_4_image_1" name="sec_4_image_1"
                                                    class="form-control col-md-7 col-xs-12"> <br>
                                                @if($secdata->section_4_image_1 == "")
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ url('public/images/imageicon.png')}}">
                                                </span>
                                                @else
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('public/upload/home_images').'/'. $secdata->section_4_image_1}}">
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fourth Section Image 2 :</label><br>
                                                <input type="file" id="sec_4_image_2" name="sec_4_image_2"
                                                    class="form-control col-md-7 col-xs-12"> <br>
                                                @if($secdata->section_4_image_2 == "")
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ url('public/images/imageicon.png')}}">
                                                </span>
                                                @else
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('public/upload/home_images').'/'. $secdata->section_4_image_2}}">
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fourth Section Image 3 :</label><br>
                                                <input type="file" id="sec_4_image_3" name="sec_4_image_3"
                                                    class="form-control col-md-7 col-xs-12"> <br>
                                                @if($secdata->section_4_image_3 == "")
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ url('public/images/imageicon.png')}}">
                                                </span>
                                                @else
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('public/upload/home_images').'/'. $secdata->section_4_image_3}}">
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fourth Section Image 4 :</label><br>
                                                <input type="file" id="sec_4_image_4" name="sec_4_image_4"
                                                    class="form-control col-md-7 col-xs-12"> <br>
                                                @if($secdata->section_4_image_4 == "")
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ url('public/images/imageicon.png')}}">
                                                </span>
                                                @else
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('public/upload/home_images').'/'. $secdata->section_4_image_4}}">
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fifth Section heading :</label>
                                                <input type="text" id="sec_5_heading" name="sec_5_heading"
                                                    class="form-control col-md-7 col-xs-12"
                                                    value="{{$secdata->section_5_heading}}" required><br>
                                                @if($errors->has('sec_3_content'))
                                                <span class="text-danger">{{ $errors->first('sec_3_content')}}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fifth Section Description 1 :</label>
                                                <textarea name="sec_5_con_1" class="form-control " rows="4" cols="50"
                                                    style="resize: none;"
                                                    required>{{$secdata->section_5_desc_1}}</textarea><br>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fifth Section Image 1 :</label><br>
                                                <input type="file" id="sec_5_image_1" name="sec_5_image_1"
                                                    class="form-control col-md-7 col-xs-12"> <br>
                                                @if($secdata->section_5_image_1 == "")
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ url('public/images/imageicon.png')}}">
                                                </span>
                                                @else
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('public/upload/home_images').'/'. $secdata->section_5_image_1}}">
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Fifth Section Image 2 :</label><br>
                                                <input type="file" id="sec_5_image_2" name="sec_5_image_2"
                                                    class="form-control col-md-7 col-xs-12"> <br>
                                                @if($secdata->section_5_image_2 == "")
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ url('public/images/imageicon.png')}}">
                                                </span>
                                                @else
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('public/upload/home_images').'/'. $secdata->section_5_image_2}}">
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Fifth Section Button Text:</label>
                                                <input type="text" id="sec_5_btntext" name="sec_5_btntext"
                                                    class="form-control col-md-7 col-xs-12"
                                                    value="{{$secdata->section_5_btntext}}" required><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Eighth Section heading 1 :</label>
                                                <input type="text" id="sec_8_heading_1" name="sec_8_heading_1"
                                                    class="form-control col-md-7 col-xs-12"
                                                    value="{{$secdata->section_8_heading_1}}" required><br>

                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Eighth Section heading 2:</label>
                                                <input type="text" id="sec_8_heading_2" name="sec_8_heading_2"
                                                    class="form-control col-md-7 col-xs-12"
                                                    value="{{$secdata->section_8_heading_2}}" required><br>

                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Eighth Section heading 3 :</label>
                                                <input type="text" id="sec_8_heading_3" name="sec_8_heading_3"
                                                    class="form-control col-md-7 col-xs-12"
                                                    value="{{$secdata->section_8_heading_3}}" required><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Eighth Section heading 4 :</label>
                                                <input type="text" id="sec_8_heading_4" name="sec_8_heading_4"
                                                    class="form-control col-md-7 col-xs-12"
                                                    value="{{$secdata->section_8_heading_4}}" required><br>
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Eighth Section Description 1:</label>
                                                <textarea name="sec_8_con_1" class="form-control " rows="4" cols="50"
                                                    style="resize: none;"
                                                    required>{{$secdata->section_8_desc_1}}</textarea><br>

                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Eighth Section Description 2:</label>
                                                <textarea name="sec_8_con_2" class="form-control " rows="4" cols="50"
                                                    style="resize: none;"
                                                    required>{{$secdata->section_8_desc_2}}</textarea><br>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Eighth Section Description 3:</label>
                                                <textarea name="sec_8_con_3" class="form-control " rows="4" cols="50"
                                                    style="resize: none;"
                                                    required>{{$secdata->section_8_desc_3}}</textarea><br>

                                            </div>
                                        </div>

                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Eighth Section Description 4:</label>
                                                <textarea name="sec_8_con_4" class="form-control " rows="4" cols="50"
                                                    style="resize: none;"
                                                    required>{{$secdata->section_8_desc_4}}</textarea><br>

                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Eighth Section Image 1:</label><br>
                                                <input type="file" id="sec_8_image_1" name="sec_8_image_1"
                                                    class="form-control col-md-7 col-xs-12"> <br>
                                                @if($secdata->section_8_image_1 == "")
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ url('public/images/imageicon.png')}}">
                                                </span>
                                                @else
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('public/upload/home_images').'/'. $secdata->section_8_image_1}}">
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Eighth Section Image 2 :</label><br>
                                                <input type="file" id="sec_8_image_2" name="sec_8_image_2"
                                                    class="form-control col-md-7 col-xs-12"> <br>
                                                @if($secdata->section_8_image_2 == "")
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ url('public/images/imageicon.png')}}">
                                                </span>
                                                @else
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('public/upload/home_images').'/'. $secdata->section_8_image_2}}">
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Eighth Section Image 3:</label><br>
                                                <input type="file" id="sec_8_image_3" name="sec_8_image_3"
                                                    class="form-control col-md-7 col-xs-12"> <br>
                                                @if($secdata->section_8_image_3 == "")
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ url('public/images/imageicon.png')}}">
                                                </span>
                                                @else
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('public/upload/home_images').'/'. $secdata->section_8_image_3}}">
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Eighth Section Image 4:</label><br>
                                                <input type="file" id="sec_8_image_4" name="sec_8_image_4"
                                                    class="form-control col-md-7 col-xs-12"> <br>
                                                @if($secdata->section_8_image_4 == "")
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ url('public/images/imageicon.png')}}">
                                                </span>
                                                @else
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('public/upload/home_images').'/'. $secdata->section_8_image_4}}">
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Footer Social Image 1:</label><br>
                                                <input type="file" id="foot_soc_img_1" name="foot_soc_img_1"
                                                    class="form-control col-md-7 col-xs-12"> <br>
                                                @if($secdata->footer_social_image_1 == "")
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ url('public/images/imageicon.png')}}">
                                                </span>
                                                @else
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('public/upload/home_images').'/'. $secdata->footer_social_image_1}}">
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Footer Social Image 2:</label><br>
                                                <input type="file" id="foot_soc_img_2" name="foot_soc_img_2"
                                                    class="form-control col-md-7 col-xs-12"> <br>
                                                @if($secdata->footer_social_image_2 == "")
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ url('public/images/imageicon.png')}}">
                                                </span>
                                                @else
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('public/upload/home_images').'/'. $secdata->footer_social_image_2}}">
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4 demo">
                                            <div class="form-group">
                                                <label>Footer Social Image 3:</label><br>
                                                <input type="file" id="foot_soc_img_3" name="foot_soc_img_3"
                                                    class="form-control col-md-7 col-xs-12"> <br>
                                                @if($secdata->footer_social_image_3 == "")
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ url('public/images/imageicon.png')}}">
                                                </span>
                                                @else
                                                <span id="preview-crop-image ">
                                                    <img width="80px" height="80px"
                                                        src="{{ asset('public/upload/home_images').'/'. $secdata->footer_social_image_3}}">
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <div class="row">
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer Social Image 4:</label><br>
                                                        <input type="file" id="foot_soc_img_4" name="foot_soc_img_4"
                                                            class="form-control col-md-7 col-xs-12"> <br>
                                                        @if($secdata->footer_social_image_4 == "")
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ url('public/images/imageicon.png')}}">
                                                        </span>
                                                        @else
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ asset('public/upload/home_images').'/'. $secdata->footer_social_image_4}}">
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer card Image 1:</label><br>
                                                        <input type="file" id="foot_card_img_1" name="foot_card_img_1"
                                                            class="form-control col-md-7 col-xs-12"> <br>
                                                        @if($secdata->footer_pcard_image_1 == "")
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ url('public/images/imageicon.png')}}">
                                                        </span>
                                                        @else
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ asset('public/upload/home_images').'/'. $secdata->footer_pcard_image_1}}">
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer card Image 2:</label><br>
                                                        <input type="file" id="foot_card_img_2" name="foot_card_img_2"
                                                            class="form-control col-md-7 col-xs-12"> <br>
                                                        @if($secdata->footer_pcard_image_2 == "")
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ url('public/images/imageicon.png')}}">
                                                        </span>
                                                        @else
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ asset('public/upload/home_images').'/'. $secdata->footer_pcard_image_2}}">
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer contact Image 3:</label><br>
                                                        <input type="file" id="foot_soc_img_4" name="foot_card_img_3"
                                                            class="form-control col-md-7 col-xs-12"> <br>
                                                        @if($secdata->footer_pcard_image_3 == "")
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ url('public/images/imageicon.png')}}">
                                                        </span>
                                                        @else
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ asset('public/upload/home_images').'/'. $secdata->footer_pcard_image_3}}">
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer card Image 4:</label><br>
                                                        <input type="file" id="foot_card_img_4" name="foot_card_img_4"
                                                            class="form-control col-md-7 col-xs-12"> <br>
                                                        @if($secdata->footer_pcard_image_4 == "")
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ url('public/images/imageicon.png')}}">
                                                        </span>
                                                        @else
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ asset('public/upload/home_images').'/'. $secdata->footer_pcard_image_4}}">
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer card Image 5:</label><br>
                                                        <input type="file" id="foot_card_img_5" name="foot_card_img_5"
                                                            class="form-control col-md-7 col-xs-12"> <br>
                                                        @if($secdata->footer_pcard_image_5 == "")
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ url('public/images/imageicon.png')}}">
                                                        </span>
                                                        @else
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ asset('public/upload/home_images').'/'. $secdata->footer_pcard_image_5}}">
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer card Image 6:</label><br>
                                                        <input type="file" id="foot_card_img_6" name="foot_card_img_6"
                                                            class="form-control col-md-7 col-xs-12"> <br>
                                                        @if($secdata->footer_pcard_image_6 == "")
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ url('public/images/imageicon.png')}}">
                                                        </span>
                                                        @else
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ asset('public/upload/home_images').'/'. $secdata->footer_pcard_image_6}}">
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer card Image 7:</label><br>
                                                        <input type="file" id="foot_card_img_7" name="foot_card_img_7"
                                                            class="form-control col-md-7 col-xs-12"> <br>
                                                        @if($secdata->footer_pcard_image_7 == "")
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ url('public/images/imageicon.png')}}">
                                                        </span>
                                                        @else
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ asset('public/upload/home_images').'/'. $secdata->footer_pcard_image_7}}">
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer card Image 8:</label><br>
                                                        <input type="file" id="foot_card_img_8" name="foot_card_img_8"
                                                            class="form-control col-md-7 col-xs-12"> <br>
                                                        @if($secdata->footer_pcard_image_8 == "")
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ url('public/images/imageicon.png')}}">
                                                        </span>
                                                        @else
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ asset('public/upload/home_images').'/'. $secdata->footer_pcard_image_8}}">
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer contact Image 1:</label><br>
                                                        <input type="file" id="foot_contact_img_1"
                                                            name="foot_contact_img_1"
                                                            class="form-control col-md-7 col-xs-12"> <br>
                                                        @if($secdata->footer_contimage_1 == "")
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ url('public/images/imageicon.png')}}">
                                                        </span>
                                                        @else
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ asset('public/upload/home_images').'/'. $secdata->footer_contimage_1}}">
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer contact Image 2:</label><br>
                                                        <input type="file" id="foot_contact_img_2"
                                                            name="foot_contact_img_2"
                                                            class="form-control col-md-7 col-xs-12"> <br>
                                                        @if($secdata->footer_contimage_2 == "")
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ url('public/images/imageicon.png')}}">
                                                        </span>
                                                        @else
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ asset('public/upload/home_images').'/'. $secdata->footer_contimage_2}}">
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer contact Image 3:</label><br>
                                                        <input type="file" id="foot_contact_img_3"
                                                            name="foot_contact_img_3"
                                                            class="form-control col-md-7 col-xs-12"> <br>
                                                        @if($secdata->footer_contimage_3 == "")
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ url('public/images/imageicon.png')}}">
                                                        </span>
                                                        @else
                                                        <span id="preview-crop-image ">
                                                            <img width="80px" height="80px"
                                                                src="{{ asset('public/upload/home_images').'/'. $secdata->footer_contimage_3}}">
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer contact Text1:</label>
                                                        <input type="text" id="foot_text1" name="foot_text1"
                                                            class="form-control col-md-7 col-xs-12"
                                                            value="{{$secdata->footer_conttext_1}}" required><br>

                                                    </div>
                                                </div>
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer contact Text 2:</label>
                                                        <input type="text" id="foot_text2" name="foot_text2"
                                                            class="form-control col-md-7 col-xs-12"
                                                            value="{{$secdata->footer_conttext_2}}" required><br>

                                                    </div>
                                                </div>
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Footer contact Text 3:</label>
                                                        <input type="text" id="foot_text3" name="foot_text3"
                                                            class="form-control col-md-7 col-xs-12"
                                                            value="{{$secdata->footer_conttext_3}}" required><br>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Sixth Section heding:</label>
                                                        <input type="text" id="six_sec_head" name="six_sec_head"
                                                            class="form-control col-md-7 col-xs-12"
                                                            value="{{$secdata->section_6_heading}}" required><br>

                                                    </div>
                                                </div>
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Sixth Section Description:</label>
                                                        <!-- <input type="text" id="six_sec_desc" name="six_sec_desc"
                                                            class="form-control col-md-7 col-xs-12"
                                                            value="{{$secdata->footer_conttext_2}}" required><br> -->
                                                        <textarea name="six_sec_desc" class="form-control " rows="4"
                                                            cols="50" style="resize: none;"
                                                            required>{{$secdata->section_6_desc}}</textarea><br>

                                                    </div>
                                                </div>
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Seventh Section heding:</label>
                                                        <input type="text" id="seven_sec_head" name="seven_sec_head"
                                                            class="form-control col-md-7 col-xs-12"
                                                            value="{{$secdata->section_7_heading}}" required><br>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Seventh Section Description:</label>
                                                        <!-- <input type="text" id="seven_sec_desc" name="seven_sec_desc"
                                                            class="form-control col-md-7 col-xs-12"
                                                            value="{{$secdata->footer_conttext_1}}" required><br> -->
                                                        <textarea name="seven_sec_desc" class="form-control " rows="4"
                                                            cols="50" style="resize: none;"
                                                            required>{{$secdata->section_7_desc}}</textarea><br>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Seventh Section Button Text:</label>
                                                        <input type="text" id="seven_btntext" name="seven_btntext"
                                                            class="form-control col-md-7 col-xs-12"
                                                            value="{{$secdata->section_7_btntext}}" required><br>

                                                    </div>
                                                </div>
                                                <div class="col-md-4 demo">
                                                    <div class="form-group">
                                                        <label>Fourth Section Video :</label>
                                                        <input type="file" id="sec_3_video" name="sec_3_video"
                                                            class="form-control col-md-7 col-xs-12" accept="video/mp4,video/mkv, video/x-m4v,video/*"
                                                             maxsize="2048"><br>
                                                             <span id="preview-crop-image " >
                                                                @if(!empty($secdata->section_3_video) && $secdata->section_3_video != null)
                                                             <video width="300" height="240" controls>
                                                             <source src="{{ asset('public/upload/home_video').'/'. $secdata->section_3_video}}" type="video/mp4">
                                                             </video><br>
                                                             <a href="{{route('delete-home-video',$secdata->id)}}"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                             @endif
                                                            </span>
                                                            
                                                                
                                                          
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-dark">Submit</button>
                                                    <input type="button" class="btn btn-dark" value="Go Back"
                                                        onClick="history.go(-1);" />
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