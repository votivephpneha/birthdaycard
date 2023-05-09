<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('public/images/favicon.ico')}}" type="image/ico" />

    <title>Card Sub Category List | BirthCards</title>

    @include('Admin.template.datatable_css')     
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
                <h3>Card sub category list</small></h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Search</button>
                    </span>
                  </div>
                </div>
              </div> -->

            </div>


            <div class="clearfix"></div>

            <div class="row">
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
                      <a href="{{route('create.sub.category', request()->route('subcatid'))}}" class="btn btn-default" style="background: #2A3F54;color:#FFFFFF"> Add New Sub Category</a>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li> -->
                      <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li> -->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content table-responsive">                   
                    <table id="example" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Id#</th>
                          <th>Sno#</th>
                          <th>Sub Category</th>
                          <th>Category</th>
                          <!-- <th>Parent category</th> -->
                          <th>Action</th>
                        </tr>
                      </thead>
                      
                    </table>
                  </div>
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

    @include('Admin.template.datatable_script')

   <script>
    $(document).ready(function () {
    $('#example').DataTable({
      processing: true,
      serverSide: true,
      "lengthMenu": [
          [10, 20, 50, 100, 500],
          [10, 20, 50, 100, 500]
      ],

      pageLength: 10,
      "order": [
          [0, "desc"],
          [0, 'desc']
      ],

      ajax: '{{route("get.subcategorylist")}}',
      
      "columns": [
              {
                "data": "id",
                name: 'id',
                searchable: false,
                visible: false
              },
              {
                "data": "srno",
                name: 'srno',
                searchable: false,
                "orderable": false
              },
              
              {
                "data": "subcategory",
                "orderable": false
              },
              {
                "data": "category",
                name: 'category',
                searchable: false,
                "orderable": false
              },
              
              {
                "data": "action",
                "orderable": false
              }

              ],

              "rowId": "id",
    });
   });

     //  delete category
     function delete_subcategory(id){
      
      if(confirm('Are you sure delete this sub category ?')){
         var subcatid = $('.delete-subcat'+ id).data('id');

            $.ajax({
            type: 'post',
            url: "{{ route('delete.sub.category.post') }}",
            data: {
              _token : "{{csrf_token()}}",
                 'id' : subcatid

            },
            success: function(data) {            
                  location.reload();              
            }
         });
      }
   };
   </script>
  
  </body>
</html>