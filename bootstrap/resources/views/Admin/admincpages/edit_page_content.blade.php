<!DOCTYPE html>

<html lang="en">

  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('public/images/favicon.ico')}}" type="image/ico" />



    <title>Edit Page</title>

    <!-- custom css -->

    @include('Admin.custom_css')

  </head>



  <body class="nav-md">

    <div class="container body">

      <div class="main_container">

        @include('Admin.template.header')



        <!-- top navigation -->

         <div class="top_nav">

          <div class="nav_menu">

            <nav>

              <div class="nav toggle">

                <a id="menu_toggle"><i class="fa fa-bars"></i></a>

              </div>



              <ul class="nav navbar-nav navbar-right">

                <li class="">

                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">

                    <img src="{{asset('public/images/img.jpg')}}" alt="">{{ Session::get('name')}}

                    <span class=" fa fa-angle-down"></span>

                  </a>

                  <ul class="dropdown-menu dropdown-usermenu pull-right">

                    <li><a href="{{ route('chagepassword') }}">Manage Account</a></li>                  

                    <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i>Log out</a></li>

                  </ul>

                </li>

                

              </ul>

            </nav>

          </div>

        </div>

        <!-- /top navigation -->



        <!-- page content -->

        <div class="right_col" role="main">

          <div class="">

            <div class="page-title">

              <div class="title_left">

                <h3>Edit Page</h3>

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

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('edit.page.post',$pagedata->id)}}" enctype="multipart/form-data">

                     @csrf

                     <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Title <span class="required">*</span>

                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <input type="text" id="title" name="title"  class="form-control col-md-7 col-xs-12" value="{{$pagedata->page_title}}">

                          @if($errors->has('title'))



                        <span class="text-danger">{{ $errors->first('title')}}</span>



                        @endif

                        </div>

                      </div>

                      <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug <span class="required">*</span>

                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <input type="text" id="slug" name="slug"  class="form-control col-md-7 col-xs-12" value="{{ str_replace('-', ' ', $pagedata->page_url)}}">

                          @if($errors->has('slug'))



                        <span class="text-danger">{{ $errors->first('slug')}}</span>



                        @endif

                        </div>

                      </div>

                      <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">SubTitle <span class="required">*</span>

                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                          <input type="text" id="sub_title" name="sub_title"  class="form-control col-md-7 col-xs-12" value="{{$pagedata->sub_title}}">

                          @if($errors->has('sub_title'))



                        <span class="text-danger">{{ $errors->first('sub_title')}}</span>



                        @endif

                        </div>

                      </div>

                      <div class="form-group">

                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Description <span class="required">*</span>

                        </label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                        <textarea  name="page_content"  class="form-control" rows="12" cols="50">{{$pagedata->page_content}}</textarea>

                          <!-- <input type="text" id="last-name" name="last_name"  class="form-control col-md-7 col-xs-12"> -->

                          @if($errors->has('page_content'))



                        <span class="text-danger">{{ $errors->first('page_content')}}</span>



                        @endif

                        </div>

                      </div>

                      <div class="form-group">

                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Card Status</label>

                        <div class="col-md-6 col-sm-6 col-xs-12">

                            <select name="page_status" id="page_status"  class="form-control">



                              <option value="1" {{ $pagedata->page_status == 1 ? 'selected' : '' }} >Active</option>



                              <option value="0" {{ $pagedata->page_status == 0 ? 'selected' : '' }} >Inactive</option>



                            </select>

                            @if($errors->has('page_status'))



                            <span class="text-danger">{{ $errors->first('page_status')}}</span>



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



        <!-- footer content -->

        @include('Admin.template.footer')

        <!-- /footer content -->

      </div>

    </div>



    <!-- custom js -->   

    @include('Admin.custom_js')

    <script>

    window.onload = function() {

        CKEDITOR.replace('page_content');

    };

   </script>

  </body>

</html>