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
        <!-- /.row -->
        <div class="box">
            {{-- <div class="box-header with-border">
                <h3 class="box-title">
                <a href="/admin/attendances/create" class="btn btn-default btn-xm" data-toggle="tooltip" title="Create"><i class="fa fa-plus"></i></a>
                </h3>
                <h3 class="box-title">
                <form action="" method="get">
                    <a class="btn btn-xm">
                        <select name="s" class="form-control select2 left" style="width: 100%;">
                            <option value="none">-- Search by Department --</option>
                            @foreach($departments as $department)
                            <option value="{{ $department->departments }}">{{$department->departments}}</option>
                            @endforeach
                        </select>
                    </a>
                    <a class="btn btn-xm">
                        <select name="s" class="form-control select2 left" style="width: 100%;">
                            <option value="none">-- Search by Shift --</option>
                            @foreach($shifts as $shift)
                            <option value="{{ $shift->shifts }}">{{$shift->shifts}}</option>
                            @endforeach
                        </select>
                    </a>
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </form>
                </h3>
                
                <div class="box-tools">
                    <form action="" method="get">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <a class="btn btn-xm">
                                <input type="text" name="s" class="form-control pull-right" placeholder="Search">
                            </a>
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            <input type="text" name="s" class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}
            <!-- /.box-header -->
            <div class="box-body">
                @if($employees)
                <table id="dataTable" class="table table-bordered">
                    <thead style="background-color: #F8F8F8;">
                        <tr>
                            <th width="05%">Employee ID</th>
                            <th width="15%">Employee Name</th>
                            <th width="15%">Department Name</th>
                            <th width="07%">Employee Email</th>
                            <th width="10%">Employee Image</th>
                            <th width="10%">Status</th>
                            <th width="10%">Details</th>
                            <th width="15%">Manage</th>
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
                            <form method="post" action="/admin/employees/{{ $employee->id }}">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <a href="/admin/employees/{{ $employee->id }}/edit" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
                                <button type="submit" onclick="return confirm('Are you sure want to delete this?')" class="btn btn-danger btn-flat btn-sm"> <i class="fa fa-trash-o"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="row">
                    {{-- <div class="col-sm-6">
                        <span style="display:block;font-size:15px;line-height:34px;margin:20px 0;">
                            Showing {{($employees->currentpage()-1)*$employees->perpage()+1}} to {{$employees->currentpage()*$employees->perpage()}} of {{$employees->total()}} entries
                        </span>
                    </div> --}}
                    <div class="col-sm-6 text-right">
                        {{-- {{ $employees->links() }} --}}
                        <!--ul class="pagination">
                        <li class="paginate_button previous"><a href="#" >Previous</a></li>
                        <li class="paginate_button active"><a href="#" >1</a></li>
                        <li class="paginate_button "><a href="#">2</a></li>
                        <li class="paginate_button "><a href="#" >3</a></li>
                        <li class="paginate_button "><a href="#">4</a></li>
                        <li class="paginate_button "><a href="#">5</a></li>
                        <li class="paginate_button "><a href="#">6</a></li>
                        <li class="paginate_button next"><a href="#" >Next</a></li>
                    </ul>-->
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-danger">
            No record found!
        </div>
        @endif
        <!-- /.box-body -->
    </div>
</section>
@endsection