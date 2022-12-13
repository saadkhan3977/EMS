@extends('layout.master')
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
            <div class="box-header with-border">
                <h3 class="box-title">
                <a href="{{url('user_leave/create')}}/{{Auth::user()->employee_id}}" class="btn btn-default btn-xm" data-toggle="tooltip" title="Create"><i class="fa fa-plus"></i></a>
                </h3>
                <div class="box-tools">
                    <form action="" method="get">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <a class="btn btn-xm">
                                <input type="text" name="s" class="form-control pull-right" placeholder="Search by Leave Type">
                            </a>
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            {{-- <input type="text" name="s" class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                            </div> --}}
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                @if($leaves)
                <table class="table table-bordered">
                    <thead style="background-color: #F8F8F8;">
                        <tr>
                            <th width="2%">ID</th>
                            <th width="10%">Employee ID</th>
                            <th width="10%">Leave Type</th>
                            <th width="30%">Reason</th>
                            <th width="10%">Duration</th>
                            <th width="15%">Document Image</th>
                            <th width="09%">Status</th>
                            <th width="05%">Details</th>
                            <th width="13%">Manage</th>
                        </tr>
                    </thead>
                    <?php $id ='1'; ?>
                    @foreach($leaves as $leave)
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>{{ $leave->employee_id }}</td>
                        <td>{{ $leave->leave_type }}</td>
                        <td>{{ $leave->reason }}</td>
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
                            {{-- <form method="post" action="/admin/leaves/{{$leave->id}}/status">
                                {{ csrf_field() }}
                                {{ method_field('put') }} --}}
                                @if($leave->status == 'APPROVED')
                                <button class="btn btn-info btn-sm"><h5>APPROVED</h5></button>
                                @elseif($leave->status == 'PENDING')
                                <button class="btn btn-warning btn-sm"><h5>PENDING</h5></button>
                                @elseif($leave->status == 'REJECTED')
                                <button class="btn btn-danger btn-sm"><h5>REJECTED</h5></button>
                                @endif
                            {{-- </form> --}}
                        </td>
                        <td><a href="/user_leave/{{ $leave->id }}/detail" class="btn btn-success btn-flat btn-sm"> <i class="fa fa-edit"></i></a></td>
                        <td>
                            <form method="post" action="{{url('user_leave')}}/{{ $leave->id }}">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                        @if(Auth::user()->admin =='1')
                                <a href="/user_leave/{{ $leave->id }}/edit" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a>
                                @endif
                                <button type="submit" onclick="return confirm('Are you sure want to delete this?')" class="btn btn-danger btn-flat btn-sm"> <i class="fa fa-trash-o"></i></button>
                            </form>
                        </td>
                        {{-- <td>
                            <div class="box-body">
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">View</button>
                            </div>
                            <div class="modal fade" id="modal-default">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Ayaz Ahmed Mast</h4>
                                        </div>
                                        <div class="container">
                                            <h1>Leave Detail</h1>
                                            <dl>
                                                <dt>Employee ID</dt>
                                                <dd>{{ $leave->employee_id }}</dd>
                                                <dt>Employee Name</dt>
                                                <dd>{{ $leave->employee->full_name }}</dd>
                                                <dt>Leave Type</dt>
                                                <dd>{{ $leave->leave_type }}</dd>
                                                <dt>Department Name</dt>
                                                <dd>{{ $leave->employee->departments }}</dd>
                                                <dt>Reason</dt>
                                                <dd>{{ $leave->reason }}</dd>
                                                <dt>Duration</dt>
                                                <dd>{{ $leave->duration }}</dd>
                                                <dt>Status</dt>
                                                <dd>@if($leave->status == 'APPROVED')
                                                <button class="btn btn-info btn-sm"><h5>APPROVED</h5></button>
                                                @elseif($leave->status == 'PENDING')
                                                <button class="btn btn-warning btn-sm"><h5>PENDING</h5></button>
                                                @elseif($leave->status == 'REJECTED')
                                                <button class="btn btn-danger btn-sm"><h5>REJECTED</h5></button>
                                                @endif
                                                </dd>
                                                
                                                <dt>Document Image</dt>
                                                <dd>{{ $leave->document_img }}</dd>
                                                <div class="box-body">
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal_img">View Document Image</button>
                                                </div>
                                                <div class="modal fade" id="modal_img">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            @if($leave->document_img == 'No document img found')
                                                            <img src="/assets/admin/dist/img/no-image.png" width="80" class="img-responsive">
                                                            @else
                                                            <img src="/uploads/{{ $leave->document_img }}" width="100" alt="{{ $leave->employee->full_name }}">
                                                            @endif
                                                            
                                                        </div>
                                                    </div>
                                                </dl>
                                            </div>
                                            
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                </td> --}}
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <!-- /.box-body -->
                    {{-- <div class="box-footer clearfix"> --}}
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