@extends('Admin.layout.layout')
@section('title', 'Admin')

@section('current_page_css')
@include('Admin.layout.datatable_css')
@endsection

@section('current_page_js')
@include('Admin.template.datatable_script')

<script>
  $(document).ready(function() {
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

      ajax: '{{route("get.textfontlist")}}',

      "columns": [{
          "data": "id",
          "name": 'id',
          "searchable": false,
          "visible": false
        },
        {
          "data": "srno",
          name: 'srno',
          searchable: false,
          orderable: false
        },

        {
          "data": "font_name",
          orderable: false
        },
        {
          "data": "action",
          orderable: false
        }

      ],

      "rowId": "id",
    });
  });


  //  delete card
  function delete_message(id) {
    if (confirm('Are you sure delete this ?')) {
      var messid = $('.delete-text-mess' + id).data('id');

      $.ajax({
        type: 'post',
        url: "{{ route('delete.textfont.post') }}",
        data: {
          _token: "{{csrf_token()}}",
          'id': messid

        },
        success: function(data) {
          location.reload();
        }
      });
    }
  };
</script>
@endsection

@section('content')
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Text Font List</small></h3>
      </div>

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
              <a href="{{route('create.textfont')}}" class="btn btn-default" style="background: #2A3F54;color:#FFFFFF"> Add message</a>
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content table-responsive">
            <table id="example" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Id#</th>
                  <th>Srno#</th>
                  <th>Text Font</th>
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
<!-- /page content -->
@endsection