@extends('admin.layout.master')

@section('page-title')
Manage Department
@endsection

{{-- @section('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
@endsection --}}

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Manage Department</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <div class="box">
            {{-- <div class="box-header with-border">
                <h3 class="box-title">
                <a href="/admin/departments/create" class="btn btn-default btn-xm" data-toggle="tooltip" title="Create"><i class="fa fa-plus"></i></a>
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
                @if($departments)
                <table id="dataTable" class="table table-bordered">
                    <thead style="background-color: #F8F8F8;">
                        <tr>
                            <th width="4%"><input type="checkbox" name="" id="checkAll"></th>
                            <th width="30%">Department Name</th>
                            <th width="10%">Status</th>
                            <th width="20%">Manage</th>
                        </tr>
                    </thead>
                    @foreach($departments as $department)
                    <tr>
                        <td><input type="checkbox" name="" id="" class="checkSingle"></td>
                        <td>{{ $department->departments }}</td>
                        <td>
                            <form method="post" action="/admin/departments/{{$department->id}}/status">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                @if($department->status == 'ACTIVE')
                                <button class="btn btn-info btn-sm"><i class="fa fa-thumbs-up"></i></button>
                                @else
                                <button class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></button>
                                @endif
                            </form>
                        </td>
                        <td>
                            <form method="post" action="/admin/departments/{{ $department->id }}">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                <a href="/admin/departments/{{ $department->id }}/edit" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
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
                            Showing {{($departments->currentpage()-1)*$departments->perpage()+1}} to {{$departments->currentpage()*$departments->perpage()}} of {{$departments->total()}} entries
                        </span>
                    </div> --}}
                    <div class="col-sm-6 text-right">
                        {{-- {{ $departments->links() }} --}}
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

{{-- @section('javascript')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
    $('#departmentTable').DataTable();
} );
</script>

@endsection --}}