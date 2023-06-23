@extends('Admin.layout.layout')

@section('title', 'View Gift Details')


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
                <h3>View Gift Details</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <a href="javascript:history.back()" class="btn btn-default"
                                style="background: #2A3F54;color:#FFFFFF">Go Back</a>
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                            method="POST" action="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Title :</label>
                                        <input type="text" id="title" name="title"
                                            class="form-control col-md-7 col-xs-12" value="{{$viewgiftdata->card_title}}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Price :</label>
                                        <input type="text" id="title" name="title"
                                            class="form-control col-md-7 col-xs-12" value="${{$viewgiftdata->price}}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gift Status :</label><br>
                                        @if($viewgiftdata->status == 'Active')
                                        <button type="button" class="btn btn-success">{{$viewgiftdata->status}}</button>
                                        @else
                                        <button type="button" class="btn btn-danger">{{$viewgiftdata->status}}</button>
                                        @endif
                                    </div>
                                </div>
                                
                                
                    
                            </div>
                            <div class="row">  
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Description :</label>
                                        <textarea id="des" name="description" rows="10" cols="50"
                                         style="  resize: none;" class="form-control col-md-7 col-xs-12" readonly>{{$viewgiftdata->description}}
                                        </textarea>
                                    </div>
                                </div>                              
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gift Image :</label><br>
                                        @if($viewgiftdata->card_image == "")
                                        <img src="{{ url('public/images/imageicon.png')}}" height="50" width="50" >
                                        @else
                                        <img src="{{ asset('public/upload/cards').'/'. $viewgiftdata->card_image}}"
                                            style="height: 50px;width:50px;">
                                        @endif
                                       
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gift Gallery Image/video :</label><br>
                                        <div class="img-uplod-box">
                                        @if((!empty($viewgiftdata->gift_gell)))
                                        @foreach ($viewgiftdata->gift_gell as $dataimg)
                                        <?php 
                                       $file_extension = explode('.',$dataimg->gift_gall_images) ;            
                                        if($file_extension[1] == "jpg" || $file_extension[1] == "jpeg" || $file_extension[1] == "png" || $file_extension[1] == "png" || $file_extension[1] == "webg" || $file_extension[1] == "svg" ) { ?>     
                                           <div class="img-remove">
                                        <img src="{{ asset('public/upload/gift_gall_images').'/'. $dataimg->gift_gall_images}}" 
                                        style="height: 50px;width:50px;">
                                        </div>
                                        <?php }else{?>
                                        <div class="img-remove">
                                        <video width="50" height="50" controls>                                                                                                                                                                                                                                                                                                                                                                                                              
                                        <source src="{{asset('public/upload/gift_gall_images').'/'. $dataimg->gift_gall_images}}" ></video> 
                                        </div>                      
                                        <?php }?> 
                                        @endforeach
                                        @endif
                                        </div>
                                        
                                    </div>
                                </div>                               
                                
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