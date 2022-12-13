@extends('layout.master')

@section('page-title')
Edit Employee
@endsection

@section('main-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Edit Employee
    <small>All * field required</small>
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    
    <!-- SELECT2 EXAMPLE -->
    <!-- form start -->
    <form name="formEdit" id="formEdit" method="post" action="{{ route('update.attendance', $attendance->id ) }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('put') }}

      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
          <!-- row start -->
          <div class="row">
            <div class="col-xs-6">
              <div class="form-group {{-- {{ $errors->has('employee_id') ? 'has-error' : null }} --}}">
                <label for="employee_id">Employee ID <span class="text text-red">*</span></label>
                <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="employee id" value="{{ $attendance->employee_id }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('employee_id') }} --}}</span>
              </div>
              <div class="form-group {{-- {{ $errors->has('full_name') ? 'has-error' : null }} --}}">
                <label for="employee_name">Employee Name <span class="text text-red">*</span></label>
                <input type="text" name="employee_name" class="form-control" id="employee_name" placeholder="full name" value="{{ $attendance->employee_name }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('full_name') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('full_name') ? 'has-error' : null }} --}}">
                <label for="shift">Employee Shift <span class="text text-red">*</span></label>
                <input type="text" name="shift" class="form-control" id="shift" placeholder="full name" value="{{ $attendance->shift }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('full_name') }} --}}</span>
              </div>
              <div class="form-group {{-- {{ $errors->has('full_name') ? 'has-error' : null }} --}}">
                <label for="department_name">Employee Department <span class="text text-red">*</span></label>
                <input type="text" name="department_name" class="form-control" id="department_name" placeholder="full name" value="{{ $attendance->department_name }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('full_name') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('time_in_schedule') ? 'has-error' : null }} --}}">
                <label for="month">Month <span class="text text-red">*</span></label>
                <input type="text" name="month" class="form-control" id="month" placeholder="Month " value="{{ $attendance->month }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('time_in_schedule') }} --}}</span>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group {{-- {{ $errors->has('full_name') ? 'has-error' : null }} --}}">
                <label for="time_schedule">Employee Time Schedule <span class="text text-red">*</span></label>
                <input type="text" name="time_schedule" class="form-control" id="time_schedule" placeholder="full name" value="{{ $attendance->time_schedule }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('full_name') }} --}}</span>
              </div>


              <div class="form-group {{-- {{ $errors->has('time_in_schedule') ? 'has-error' : null }} --}}">
                <label for="date">Date <span class="text text-red">*</span></label>
                <input type="text" name="date" class="form-control" id="date" placeholder="Date " value="{{ $attendance->date }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('time_in_schedule') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('full_name') ? 'has-error' : null }} --}}">
                <label for="attendance">Employee Attendance <span class="text text-red">*</span></label>
                <input type="text" name="attendance" class="form-control" id="attendance" value="PRESENT" readonly>
                <span class="text-danger">{{-- {{ $errors->first('full_name') }} --}}</span>
              </div>
              
              <div class="form-group {{-- {{ $errors->has('full_name') ? 'has-error' : null }} --}}" >
                <label for="time_in">Time In <span class="text text-red">*</span></label>
                <input type="text" name="time_in" class="form-control" id="time_in" value="{{ $attendance->time_in }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('full_name') }} --}}</span>
              </div>

              <div class="form-group">
                <label for="time_out">Time Out <span class="text text-red">*</span></label>
                {{-- <input id="txt" type="text" class="form-control"> --}}
                  <div id="txt" class="form-control" readonly></div>
              </div>

              
              
            </div>
          </div>
          
          <!-- row end -->
          </div>

        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button  type="submit" class="btn btn-primary">Click here to time out!</button>
          <a href="{{url('user_attendance')}}/{{Auth::user()->employee_id}}" class="btn btn-danger">Canel</a>
        </div>
      </div>

    </form>
    <!-- /.box -->
    
    <!-- form end -->
    
  </section>
  @endsection