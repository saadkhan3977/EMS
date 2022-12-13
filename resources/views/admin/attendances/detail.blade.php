@extends('admin.layout.master')
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
                            @if(Auth::user()->employee_id == $attendance->employee_id)
                                <a href="/admin/attendances/updatetimeout/{{ $attendance->id }}" class="btn btn-success btn-flat btn-sm" id="txt"></a>

                            @endif
                            @else
                                {{ $attendance->time_out }}
                            @endif
                        </td>
                        <td>
                            @if($attendance->attendance == 'PRESENT')
                            <button class="btn btn-info btn-sm">{{$attendance->attendance}}</button>
                            @elseif($attendance->attendance == 'LATE PRESENT')
                            <button class="btn btn-warning btn-sm">{{$attendance->attendance}}</button>
                            @else
                            <button class="btn btn-danger btn-sm">{{$attendance->attendance}}</button>
                            @endif
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