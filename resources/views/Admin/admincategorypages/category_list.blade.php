<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('public/images/newicon.ico')}}" type="image/ico" />

    <title>Card Category List | BirthCards</title>

    @include('Admin.layout.datatable_css')     
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
       <!-- Sidebar -->
      @include('Admin.layout.sidebar')
      <!-- Navbar Header -->
      @include('Admin.layout.header')

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Card category list</small></h3>
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
                      <a href="{{route('create.category')}}" class="btn btn-default" style="background: #2A3F54;color:#FFFFFF"> Add New category</a>
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
                          <!-- <th>Id#</th> -->
                          <th>S.no#</th>
                          <th>Category</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(!$catList->isEmpty())
                        <?php $i =1 ;?>
                        @foreach($catList as $arr)
                        <tr id="row{{ $arr->id }}">
                          <td>{{$i}}</td>
                          <td>{{$arr->name}}</td>
                          <td>
                          <button class="btn btn-dark p-2" >
                          <a href="{{route('edit.category',[$arr->id])}}" class="text-white" style=" color: #FFFFFF;"><i class="fa fa-edit" ></i>Edit</button></a>
                          <button class="btn btn-dark p-2">
                          <a href="{{route('subcategorylist',[$arr->id])}}" class="text-white" style=" color: #FFFFFF;"><i class="fa fa-eye" ></i>View</button></a>
                          <button class="btn  btn-dark p-2" >
                          <a href="javascript:void(0);" onClick="delete_category('{{$arr->id}}')" data-id="{{$arr->id}}" class="text-white delete-cat{{$arr->id}}" style=" color: #FFFFFF;"><i class="fa fa-trash-o"></i> Delete </button></a>
                          </td>
                        </tr>
                        <?php $i++ ;?>
                        @endforeach
                        @endif
                      </tbody>                      
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
        @include('Admin.layout.footer')
        <!-- /footer content -->
      </div>
    </div>

    @include('Admin.layout.datatable_script')

   <script>
  //   $(document).ready(function () {
  //   $('#example').DataTable({
  //     processing: true,
  //     serverSide: true,
  //     "lengthMenu": [
  //         [10, 20, 50, 100, 500],
  //         [10, 20, 50, 100, 500]
  //     ],

  //     pageLength: 10,
  //     "order": [
  //         [0, "desc"],
  //         [0, 'desc']
  //     ],

  //     ajax: '{{route("get.categorylist")}}',
      
  //     "columns": [
  //             {
  //               "data": "id",
  //               name: 'id',
  //               searchable: false,
  //               visible: false
  //             },
  //             {
  //               "data": "srno",
  //               name: 'srno',
  //               searchable: false,
  //               "orderable": false
  //             },
              
  //             {
  //               "data": "category",
  //               "orderable": false
  //             },
  //             // {
  //             //   "data": "subcategory",
  //             //   name: 'subcategory',
  //             //   searchable: false,
  //             //   "orderable": false
  //             // },
              
  //             {
  //               "data": "action",
  //               "orderable": false
  //             }

  //             ],

  //             "rowId": "id",
  //   });
  //  });
  $(document).ready(function() {
    var mytable = $('#example').DataTable({
        'columnDefs': [ {
               'targets': [], // column index (start from 0)
               'orderable': false, // set orderable false for selected columns
         }]
    });
  });

     //  delete category
function delete_category(id) {
toastDelete.fire({}).then(function(e) {
    if (e.value === true) {
        var catid = $('.delete-cat' + id).data('id');
        $.ajax({
            type: 'post',
            url: "{{ route('delete.category.post') }}",
            data: {
                _token: "{{csrf_token()}}",
                'id': catid
            },
            success: function(data) {
              const obj = JSON.parse(data);
                console.log(obj.msg);
                $("#row" + id).remove();
                success_noti(obj.msg);
                // mytable.ajax.reload();
            }
        });
    } else {
        e.dismiss;
    }
}, function(dismiss) {

    return false;

});
};
   </script>
  
  </body>
</html>