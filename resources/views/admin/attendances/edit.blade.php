@extends('admin.layout.master')

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
    <form name="formEdit" id="formEdit" method="post" action="/admin/employees/{{ $attendance->id }}" enctype="multipart/form-data">
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
                <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="employee id" value="{{ $attendance->employee_id }}">
                <span class="text-danger">{{-- {{ $errors->first('employee_id') }} --}}</span>
              </div>
              <div class="form-group {{-- {{ $errors->has('full_name') ? 'has-error' : null }} --}}">
                <label for="employee_name">Employee Name <span class="text text-red">*</span></label>
                <input type="text" name="employee_name" class="form-control" id="employee_name" placeholder="full name" value="{{ $attendance->employee_name }}">
                <span class="text-danger">{{-- {{ $errors->first('full_name') }} --}}</span>
              </div>
              <div class="form-group {{-- {{ $errors->has('country') ? 'has-error' : null }} --}}">
                <label>Shift <span class="text text-red">*</span></label>
                <select name="shift" id="shift" class="form-control select2" style="width: 100%;">
                  <option value="none">-- Select Shift --</option>
                  @foreach($shifts as $shift)
                  <option value="{{ $shift->shifts }}">{{ $shift->shifts }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group {{-- {{ $errors->has('country') ? 'has-error' : null }} --}}">
                <label>Department <span class="text text-red">*</span></label>
                <select name="department_name" id="department_name" class="form-control select2" style="width: 100%;">
                  <option value="none">-- Select Department --</option>
                  @foreach($departments as $department)
                  <option value="{{ $department->departments }}">{{ $department->departments }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group {{-- {{ $errors->has('country') ? 'has-error' : null }} --}}">
                <label>Time Schedule <span class="text text-red">*</span></label>
                <select name="time_schedule" id="time_schedule" class="form-control select2" style="width: 100%;">
                  <option value="none">-- Select Time Schedule --</option>
                  @foreach($timeSchedules as $timeSchedule)
                  <option value="{{ $timeSchedule->time_schedule }}">{{ $timeSchedule->time_schedule }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group {{-- {{ $errors->has('time_in_schedule') ? 'has-error' : null }} --}}">
                <label for="time_in">Time In <span class="text text-red">*</span></label>
                <input type="time" name="time_in" class="form-control" id="time_in" placeholder="Time In " value="{{ $attendance->time_in }}">
                <span class="text-danger">{{-- {{ $errors->first('time_in_schedule') }} --}}</span>
              </div>
              <div class="form-group {{-- {{ $errors->has('time_out_schedule') ? 'has-error' : null }} --}}">
                <label for="time_out">Time Out <span class="text text-red">*</span></label>
                <input type="time" name="time_out" class="form-control" id="time_out" placeholder="Time Out" value="{{ $attendance->time_out }}">
                <span class="text-danger">{{-- {{ $errors->first('time_out_schedule') }} --}}</span>
              </div>
              
              
            </div>
          </div>
          
          <!-- row end -->
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <button type="reset" class="btn btn-danger">Cancel</button>
        </div>
      </div>

    </form>
    <!-- /.box -->
    
    <!-- form end -->
    
  </section>
  @endsection