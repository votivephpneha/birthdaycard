@extends('Admin.layout.layout')

@section('title', 'Create Gift')


@section('current_page_css')

@endsection


@section('current_page_js')
<script>
$('#category_id').change(function() {
    var cat_id = $(this).val();
    $.ajax({
        url: "{{route('get.subcatlist')}}",
        type: "POST",
        data: {
            _token: "{{csrf_token()}}",
            categ_id: cat_id
        },
        success: function(response) {
            console.log(response);
            $('#subcategory_id').html(response);
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
                <h3>Create Gift</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                @if(Session::has('failed'))
                <div class="alert alert-danger alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ Session::get('failed')}}</strong>

                </div>
                @endif
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Create Gift</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                            method="POST" action="{{route('create.gift.post')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Title <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="title" name="title" class="form-control col-md-7 col-xs-12">
                                    @if($errors->has('title'))

                                    <span class="text-danger">{{ $errors->first('title')}}</span>

                                    @endif
                                </div>
                            </div>
                            <!-- <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="price" name="price"  class="form-control col-md-7 col-xs-12">
                  @if($errors->has('price'))

                <span class="text-danger">{{ $errors->first('price')}}</span>

                @endif
                </div>
              </div> -->
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Description
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="des" name="description" rows="4" cols="50"
                                        class="form-control col-md-7 col-xs-12">
                                     </textarea>
                                     @if($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description')}}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">Price <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" id="price" name="price"
                                        class="form-control col-md-7 col-xs-12">
                                    @if($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gift
                                    Status</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="gift_status" id="gift_status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @if($errors->has('gift_status'))
                                    <span class="text-danger">{{ $errors->first('gift_status')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gift image
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="gift_image" class="form-control col-md-7 col-xs-12" type="file"
                                        name="gift_image" accept="image/png, image/gif, image/jpeg">
                                    @if($errors->has('gift_image'))
                                    <span class="text-danger">{{ $errors->first('gift_image')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gift gallery images/videos
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="gift_gall_image" class="form-control col-md-7 col-xs-12" type="file"
                                        name="gift_gall_image[]" accept="image/png, image/gif, image/jpeg,video/mp4" multiple>
                                    @if($errors->has('gift_gall_image'))
                                    <span class="text-danger">{{ $errors->first('gift_gall_image')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
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
@endsection