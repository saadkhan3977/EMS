@extends('admin.layout.master')
@section('page-title')
Manage Employee
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Manage Employee</h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <!-- /.box -->
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            @if($employees)
            <table id="dataTable" class="table table-bordered table-striped">
              <thead style="background-color: #F8F8F8;">
                <tr>
                  <th>Employee ID</th>
                  <th>Employee Name</th>
                  <th>Department Name</th>
                  <th>Employee Email</th>
                  <th>Employee Image</th>
                  <th>Status</th>
                  <th>Details</th>
                  <th>Manage</th>
                </tr>
              </thead>
              @foreach($employees as $employee)
              <tr>
                <td>{{ $employee->employee_id }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->departments }}</td>
                <td>{{ $employee->email }}</td>
                <td class="text-center">
                  @if($employee->employee_img == 'No image found')
                  <img src="/assets/admin/dist/img/no-image.png" width="80" class="img-thumbnail">
                  @else
                  <img src="/uploads/{{ $employee->employee_img }}" width="100" alt="{{ $employee->full_name }}">
                  @endif
                </td>
                <td>
                  <form method="post" action="/admin/employees/{{$employee->id}}/status">
                    {{ csrf_field() }}
                    {{ method_field('put') }}
                    @if($employee->status == 'ACTIVE')
                    <button class="btn btn-info btn-sm">ACTIVE</button>
                    @else
                    <button class="btn btn-danger btn-sm">DEACTIVE</button>
                    @endif
                  </form>
                </td>
                <td>
                  <a href="/admin/employees/{{ $employee->id }}/detail" class="btn btn-success btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
                </td>
                <td>
                  <!--<form method="post" action="/admin/employees/{{ $employee->id }}">-->
                  <!--  {{ csrf_field() }}-->
                  <!--  {{ method_field('delete') }}-->
                  <!--  <a href="/admin/employees/{{ $employee->id }}/edit" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>-->
                  <!--  <button type="submit" onclick="return confirm('Are you sure want to delete this?')" class="btn btn-danger btn-flat btn-sm"> <i class="fa fa-trash-o"></i></button>-->
                  <!--</form>-->
                  <a href="/admin/employees/{{ $employee->id }}/edit" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
                </td>
              </tr>
              @endforeach
              
            </table>
            @else
        <div class="alert alert-danger">
            No record found!
        </div>
        @endif
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
@endsection