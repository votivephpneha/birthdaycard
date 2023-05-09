<!DOCTYPE html>

<html lang="en">

  <head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{asset('public/images/favicon.ico')}}" type="image/ico" />



    <title>Birthday Cards| </title>



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

                    <li><a href="{{route('chagepassword')}}">Manage Account</a></li>                  

                    <li><a href="{{route('logout')}}"><i class="fa fa-sign-out pull-right"></i>Log out</a></li>

                  </ul>

                </li>



                

              </ul>

            </nav>

          </div>

        </div>

        <!-- /top navigation -->



        <!-- page content -->

        <div class="right_col" role="main">

          <!-- top tiles -->

          <!-- <div class="row tile_count">

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>

              <div class="count">2500</div>

              <span class="count_bottom"><i class="green">4% </i> From last Week</span>

            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

              <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>

              <div class="count">123.50</div>

              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>

            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

              <span class="count_top"><i class="fa fa-user"></i> Total Males</span>

              <div class="count green">2,500</div>

              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>

            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

              <span class="count_top"><i class="fa fa-user"></i> Total Females</span>

              <div class="count">4,567</div>

              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>

            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

              <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>

              <div class="count">2,315</div>

              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>

            </div>

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">

              <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>

              <div class="count">7,325</div>

              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>

            </div>

          </div> -->

          <!-- /top tiles -->



        

          <!-- <br /> -->



         





         

        </div>

        <!-- /page content -->



        <!-- footer content -->

        @include('Admin.template.footer') 

        <!-- /footer content -->

      </div>

    </div>



    @include('Admin.custom_js')

  </body>

</html>

