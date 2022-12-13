@extends('admin.layout.master')
@section('page-title')
Manage Leaves
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Manage Leaves</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <div class="box">
            {{-- <div class="box-header with-border">
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
            <div class="box-body table-responsive">
                @if($leaves)
                <table id="dataTable" class="table table-bordered">
                    <thead style="background-color: #F8F8F8;">
                        <tr>
                            <th width="10%">Employee ID</th>
                            <th width="16%">Employee Name</th>
                            <th width="20%">Department Name</th>
                            <th width="10%">Leave Type</th>
                            <th width="10%">Duration</th>
                            <th width="15%">Document Image</th>
                            <th width="05%">Status</th>
                            <th width="05%">Details</th>
                            <th width="13%">Manage</th>{{-- baad me manage ka section hatana hai  --}}
                            {{-- <th width="05%">View Leave</th> --}}
                        </tr>
                    </thead>
                    @foreach($leaves as $leave)
                    <tr>
                        <td>{{ $leave->employee_id }}</td>
                        <td>{{ $leave->name }}</td>
                        <td>{{ $leave->department }}</td>
                        <td>{{ $leave->leave_type }}</td>
                        <td>{{ $leave->duration }}</td>
                        <td>
                            @if($leave->document_img == 'No document img found')
                            <img src="/assets/admin/dist/img/no-image.png" width="80" class="img-thumbnail">
                            @else
                            <div class="img_section5">
                            <figure><img src="/uploads/{{ $leave->document_img }}" width="100"></figure>
                            </div>
                            @endif
                        </td>
                        <td>
                            <form method="post" action="/admin/leaves/{{$leave->id}}/status">
                                {{ csrf_field() }}
                                {{ method_field('put') }}
                                @if($leave->status == 'APPROVE')
                                <button class="btn btn-info btn-sm"><h5>APPROVE</h5></button>
                                @elseif($leave->status == 'PENDING')
                                <button class="btn btn-warning btn-sm"><h5>PENDING</h5></button>
                                @elseif($leave->status == 'REJECTED')
                                <button class="btn btn-danger btn-sm"><h5>REJECTED</h5></button>
                                @endif
                            </form>
                        </td>
                        <td><a href="/admin/leaves/{{ $leave->id }}/detail" class="btn btn-success btn-flat btn-sm"> <i class="fa fa-edit"></i></a></td>
                        <td>
                            <form method="post" action="/admin/leaves/{{ $leave->id }}">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                {{-- <a href="/admin/leaves/{{ $leave->id }}/edit" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a> --}}
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
                                    Showing {{($attendances->currentpage()-1)*$attendances->perpage()+1}} to {{$attendances->currentpage()*$attendances->perpage()}} of {{$attendances->total()}} entries
                                </span>
                            </div> --}}
                            <div class="col-sm-6 text-right">
                                {{-- {{ $attendances->links() }} --}}
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