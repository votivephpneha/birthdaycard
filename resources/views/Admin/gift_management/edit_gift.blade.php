@extends('Admin.layout.layout')

@section('title', 'Edit Gift')


@section('current_page_css')

@endsection


@section('current_page_js')
<script>

</script>

@endsection


@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Gift</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                @if(Session::has('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ Session::get('success')}}</strong>
                </div>
                @endif
                @if(Session::has('failed'))
                <div class="alert alert-danger alert-block">

                    <button type="button" class="close" data-dismiss="alert">×</button>

                    <strong>{{ Session::get('failed')}}</strong>

                </div>
                @endif
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Edit Gift</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                            method="POST" action="{{route('edit.gift.post',$giftdata->id)}}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Title <span
                                        class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="title" name="title" class="form-control col-md-7 col-xs-12"
                                        value="{{$giftdata->card_title}}">
                                    @if($errors->has('title'))

                                    <span class="text-danger">{{ $errors->first('title')}}</span>

                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Description
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea id="des" name="description" rows="4" cols="50"
                                        class="form-control col-md-7 col-xs-12">{{$giftdata->description}}
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
                                    <input type="number" id="price" name="price" class="form-control col-md-7 col-xs-12"
                                        value="{{$giftdata->price}}">
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
                                        <option value="1" {{ $giftdata->status == 'Active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="0" {{ $giftdata->status == 'Inactive' ? 'selected' : '' }}>
                                            Inactive</option>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @if($giftdata->card_image == "")
                                    <img src="{{ url('public/images/imageicon.png')}}" height="50" width="50">
                                    @else
                                    <img src="{{ asset('public/upload/cards').'/'. $giftdata->card_image}}" height="50"
                                        width="50">
                                    @endif

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Gift gallery
                                    images/videos
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="gift_gall_image" class="form-control col-md-7 col-xs-12" type="file"
                                        name="gift_gall_image[]" accept="image/png, image/gif, image/jpeg,video/mp4" multiple>
                                    @if($errors->has('gift_gall_image'))
                                    <span class="text-danger">{{ $errors->first('gift_gall_image')}}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12"><span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">   
                                <div class="img-uplod-box">
                                @if((!empty($giftdata->gift_gell)))
                                    @foreach ($giftdata->gift_gell as $data)
                                <?php 
                                   $file_extension = explode('.',$data->gift_gall_images) ;            
                                    if($file_extension[1] == "jpg" || $file_extension[1] == "jpeg" || $file_extension[1] == "png" || $file_extension[1] == "png" || $file_extension[1] == "webg" || $file_extension[1] == "svg" ) { ?>
                                <div class="img-remove">
                                <img src="{{ asset('public/upload/gift_gall_images').'/'. $data->gift_gall_images}}" width="50" height="50">
                                <a href="{{route('delete-gift-images',$data->id)}}"><i class="fa fa-times up-img" aria-hidden="true"></i></a>
                                </div>
                                <?php }else{?>
                                <div class="img-remove">
                                <video width="50" height="50" controls>
                                                <source src="{{asset('public/upload/gift_gall_images').'/'. $data->gift_gall_images}}">
                                            </video>
                                <a href="{{route('delete-gift-images',$data->id)}}"><i class="fa fa-times up-img" aria-hidden="true"></i></a>
                                </div>
                                <?php }?>
                                @endforeach
                                    @endif
                                </div>     
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