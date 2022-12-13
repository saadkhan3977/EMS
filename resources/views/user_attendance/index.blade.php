@extends('layout.master')

@section('page-title')
Manage Attendance
@endsection

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Manage Attendance</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- /.row -->
        <div class="box">
            <div class="box-header with-border table-responsive">
                <h3 class="box-title">
                <?php $date = date('Y-m-d') ?>
                {{-- @if($attendance->date != $date) --}}
                {{-- <a href="{{url('user_attendance/create')}}/{{Auth::user()->employee_id}}" class="btn btn-default btn-xm" data-toggle="tooltip" title="Create"><i class="fa fa-plus"></i></a> --}}
                {{-- @endif --}}
                </h3>
                <div class="box-tools">
                    <form action="" method="get">
                        <div class="input-group input-group-sm" style="width: 250px;">
                            <a class="btn btn-xm">
                                <input type="date" name="s" class="form-control pull-right" placeholder="Date">
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
                @if($attendances)
                <table id="dataTable" class="table table-bordered">
                    <thead style="background-color: #F8F8F8;">
                        <tr>
                            <th width="10%">ID</th>
                            <th width="10%">Employee Name</th>
                            <th width="10%">Shift</th>
                            <th width="17%">Time Schedule</th>
                            <th width="17%">Department Name</th>
                            <th width="10%">Date</th>
                            <th width="10%">Time In</th>
                            <th width="10%">Time Out</th>
                            <th width="05%">Attendance</th>
                        </tr>
                    </thead>
                    <?php $id='1' ?>
                    @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>{{ Auth::user()->name }}</td>
                        <td>{{ $attendance->shift }}</td>
                        <td>{{ $attendance->time_schedule }}</td>
                        <td>{{ $attendance->department_name }}</td>
                        <td>{{ $attendance->date }}</td>
                        <td>{{ $attendance->time_in }}</td>
                        <td>
                            @if($attendance->time_out == NULL)
                            @if(Auth::user()->id == $attendance->employee_id)
                                <a href="/user_attendance/{{ $attendance->id }}/edit" class="btn btn-success btn-flat btn-sm" id="txt"></a>
                            @endif    
                            @else
                                {{ $attendance->time_out }}
                            @endif
                        </td>
                        <td>
                            @if($attendance->attendance == 'ABSENT')
                            <button class="btn btn-danger btn-sm">{{$attendance->attendance}}</button>
                            @elseif($attendance->attendance=='PRESENT')
                            <button class="btn btn-success btn-sm">{{$attendance->attendance}}</button>
                            @elseif($attendance->attendance=='LATE PRESENT')
                            <button class="btn btn-warning btn-sm">{{$attendance->attendance}}</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
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
                        {{ $attendances->links() }}
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
            {{-- </div> --}}
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