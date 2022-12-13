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
            <div class="box-body table-responsive">
                @if($attendances)
                <table id="dataTable" class="table table-bordered" data-show-columns="true">
                    <thead style="background-color: #F8F8F8;">
                        <tr>
                            <th width="09%">ID</th>
                            <th width="15%">Employee Name</th>
                            <th width="07%">Shift</th>
                            <th width="14%">Time Schedule</th>
                            <th width="14%">Date</th>
                            <th width="13%">Department Name</th>
                            <th width="05%">Status</th>
                            <th width="10%">Manage</th>
                            <th width="13%">All Attendance</th>
                        </tr><?php $today = date('y-m-d'); ?>
                    </thead><?php $id ='1' ?>
                    @if(Auth::user()->role =='Team Lead')
                    @foreach($attendances as $attendance)
                        @foreach($users as $user)
                            @if($attendance->employee_name == $user->name)
                                @if(Auth::user()->role =='Team Lead')
                                    @if(Auth::user()->departments == $attendance->department_name)
                                        @if($user->role =='Employee')
                                            <!--{{$user->name}}-->
                                            <tr>
                                                <td>{{ $id++ }}</td>
                                                <td>{{ $attendance->employee_name }}</td>
                                                <td>{{ $attendance->shift }}</td>
                                                <td>{{ $attendance->time_schedule }}</td>
                                                <td>{{ $attendance->date }}</td>
                                                <td>{{ $attendance->department_name }}</td>
                                                <td>
                                                    @if($attendance->attendance == 'PRESENT')
                                                    <button class="btn btn-info btn-sm">{{$attendance->attendance}}</button>
                                                    @elseif($attendance->attendance == 'LATE PRESENT')
                                                    <button class="btn btn-warning btn-sm">{{$attendance->attendance}}</button>
                                                    @else
                                                    <button class="btn btn-danger btn-sm">{{$attendance->attendance}}</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form method="post" action="/admin/attendances/{{ $attendance->id }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('delete') }}
                                                        {{-- <a href="/admin/attendances/{{ $attendance->id }}/edit" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a> --}}
                                                        <button type="submit" onclick="return confirm('Are you sure want to delete this?')" class="btn btn-danger btn-flat btn-sm"> <i class="fa fa-trash-o"></i></button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <a href="/admin/attendances/{{ $attendance->employee_id }}/detailemploye" class="btn btn-success btn-flat btn-sm"> <i class="fa fa-book"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endif
                            @endif    
                        @endforeach
                    @endforeach
                    @else
                    @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>{{ $attendance->employee_name }}</td>
                        <td>{{ $attendance->shift }}</td>
                        <td>{{ $attendance->time_schedule }}</td>
                        <td>{{ $attendance->date }}</td>
                        <td>{{ $attendance->department_name }}</td>
                        <td>
                            @if($attendance->attendance == 'PRESENT')
                            <button class="btn btn-info btn-sm">{{$attendance->attendance}}</button>
                            @elseif($attendance->attendance == 'LATE PRESENT')
                            <button class="btn btn-warning btn-sm">{{$attendance->attendance}}</button>
                            @else
                            <button class="btn btn-danger btn-sm">{{$attendance->attendance}}</button>
                            @endif
                        </td>
                        <td>
                            <form method="post" action="/admin/attendances/{{ $attendance->id }}">
                                {{ csrf_field() }}
                                {{ method_field('delete') }}
                                {{-- <a href="/admin/attendances/{{ $attendance->id }}/edit" class="btn btn-info btn-flat btn-sm"> <i class="fa fa-edit"></i></a> --}}
                                <button type="submit" onclick="return confirm('Are you sure want to delete this?')" class="btn btn-danger btn-flat btn-sm"> <i class="fa fa-trash-o"></i></button>
                            </form>
                        </td>
                        <td>
                            <a href="/admin/attendances/{{ $attendance->employee_id }}/detailemploye" class="btn btn-success btn-flat btn-sm"> <i class="fa fa-book"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </table>
            </div>
                <!-- /.box-body -->
            @else
            <div class="alert alert-danger">
                No record found!
            </div>
            @endif
            <!-- /.box-body -->
        </div>
    </section>
    @endsection