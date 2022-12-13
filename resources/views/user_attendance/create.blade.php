@extends('layout.master')

@section('page-title')
Create Attendance
@endsection

@section('main-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Create Attendance
    <small>All * field required</small>
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    
    <!-- SELECT2 EXAMPLE -->
    <!-- form start -->
    <form name="formAdd" id="formAdd" method="POST" action="{{url('user_attendance/store')}}/{{Auth::user()->employee_id}}" enctype="multipart/form-data">
      @csrf
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
          {{-- @if (count($errors))
            <div class="alert alert-danger">
              <strong>Ooppss! Something went wrong</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif --}}
          <!-- row start -->
          <div class="row">
            <div class="col-xs-6">
              <div class="form-group {{-- {{ $errors->has('employee_id') ? 'has-error' : null }} --}}">
                <label for="employee_id">Employee ID <span class="text text-red">*</span></label>
                <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="employee id" value="{{ Auth::user()->employee_id }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('employee_id') }} --}}</span>
              </div>
              <div class="form-group {{-- {{ $errors->has('full_name') ? 'has-error' : null }} --}}">
                <label for="employee_name">Employee Name <span class="text text-red">*</span></label>
                <input type="text" name="employee_name" class="form-control" id="employee_name" placeholder="full name" value="{{ Auth::user()->name }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('full_name') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('full_name') ? 'has-error' : null }} --}}">
                <label for="shift">Employee Shift <span class="text text-red">*</span></label>
                <input type="text" name="shift" class="form-control" id="shift" placeholder="full name" value="{{ Auth::user()->shift }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('full_name') }} --}}</span>
              </div>
              <div class="form-group {{-- {{ $errors->has('full_name') ? 'has-error' : null }} --}}">
                <label for="department_name">Employee Department <span class="text text-red">*</span></label>
                <input type="text" name="department_name" class="form-control" id="department_name" placeholder="full name" value="{{ Auth::user()->departments }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('full_name') }} --}}</span>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group {{-- {{ $errors->has('full_name') ? 'has-error' : null }} --}}">
                <label for="time_schedule">Employee Time Schedule <span class="text text-red">*</span></label>
                <input type="text" name="time_schedule" class="form-control" id="time_schedule" placeholder="full name" value="{{ Auth::user()->time_schedule }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('full_name') }} --}}</span>
              </div>

              {{-- <div class="form-group">
                <label for="day">Day <span class="text text-red">*</span></label>
                <input type="text" name="day" class="form-control" id="day" placeholder="full name" value="{{ Auth::user()->day }}" >
                <span class="text-danger"></span>
              </div> --}}

              {{-- <div class="form-group {{ $errors->has('month') ? 'has-error' : null }}">
                <label>Month</label>
                <select type="text" name="month" id="month" class="form-control select2 left" style="width: 100%;">
                    <option value="none">-- select month --</option>
                    <option value="january">january</option>
                    <option value="fabruary">fabruary</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="Octuber">Octuber</option>
                    <option value="Novomber">Novomber</option>
                    <option value="December">December</option>
                </select>
              </div> --}}

              <div class="form-group {{ $errors->has('date') ? 'has-error' : null }}">
                <label for="date">Date <span class="text text-red">*</span></label>
                <input type="text" name="date" class="form-control" id="date" readonly value="<?php echo date('Y-m-d') ?>" placeholder="Date ">
                <span class="text-danger">{{-- {{ $errors->first('time_in_schedule') }} --}}</span>
              </div>

              {{-- <div class="form-group">
                <label>Attendance</label>
                <select name="attendance" id="attendance" class="form-control select2" style="width: 100%;">
                  <option value="PRESENT">PRESENT</option>
                  <option value="ABSENT">ABSENT</option>
                </select>
              </div> --}}
              
              
            </div>
          </div>
          
          <!-- row end -->
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Create Attendance</button>
          <a href="{{url('user_attendance')}}/{{Auth::user()->employee_id}}" class="btn btn-danger">Canel</a>
        </div>
      </div>

    </form>
    <!-- /.box -->
    
    <!-- form end -->
    
  </section>
  @endsection