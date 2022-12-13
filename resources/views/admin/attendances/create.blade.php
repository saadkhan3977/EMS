@extends('admin.layout.master')
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
    <form name="formAdd" id="formAdd" method="POST" action="/admin/attendances" enctype="multipart/form-data">
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
              <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
                <label for="employee_id">Employee ID <span class="text text-red">*</span></label>
                <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="employee id" value="{{ Auth::user()->employee_id }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('employee_id') }} --}}</span>
              </div>
              <div class="form-group {{ $errors->has('employee_name') ? 'has-error' : null }}">
                <label for="employee_name">Employee Name <span class="text text-red">*</span></label>
                <input type="text" name="employee_name" class="form-control" id="employee_name" placeholder="full name" value="{{ Auth::user()->name }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('full_name') }} --}}</span>
              </div>
              <div hidden="" class="form-group {{ $errors->has('shift') ? 'has-error' : null }}">
                <label>Shift <span class="text text-red">*</span></label>
                <input type="text" name="shift" class="form-control" id="shift" placeholder="full name" value="{{ Auth::user()->shift }}" readonly>
              </div>
              <div hidden="" class="form-group {{ $errors->has('department_name') ? 'has-error' : null }}">
                <label>Department <span class="text text-red">*</span></label>
                <input type="text" name="shift" class="form-control" id="shift" placeholder="full name" value="{{ Auth::user()->department_name }}">
              </div>
              <div hidden="" class="form-group {{ $errors->has('time_schedule') ? 'has-error' : null }}">
                <label>Time Schedule <span class="text text-red">*</span></label>
                <input type="text" name="time_schedule" class="form-control" id="time_schedule" placeholder="full name" value="{{ Auth::user()->time_schedule }}" readonly>
              </div>
              <div class="form-group {{ $errors->has('time_in') ? 'has-error' : null }}">
                <label for="time_in">Time In <span class="text text-red">*</span></label>
                <input type="time" name="time_in" class="form-control" id="time_in" placeholder="Time In " value="{{ date('H:i:m') }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('time_in_schedule') }} --}}</span>
              </div>
              <div hidden="" class="form-group {{ $errors->has('time_out') ? 'has-error' : null }}">
                <label for="time_out">Time Out <span class="text text-red">*</span></label>
                <input type="time" name="time_out" class="form-control" id="time_out" placeholder="Time Out">
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