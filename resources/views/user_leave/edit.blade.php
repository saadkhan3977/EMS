@extends('layout.master')

@section('page-title')
Edit Leave
@endsection

@section('main-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Edit Leave
    <small>All * field required</small>
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    
    <!-- SELECT2 EXAMPLE -->
    <!-- form start -->
    <form name="formEdit" id="formEdit" method="post" action="/user_leave/{{ $leave->id }}" enctype="multipart/form-data">
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
                <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="employee id" value="{{ $leave->employee_id }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('employee_id') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('employee_id') ? 'has-error' : null }} --}}">
                <label for="name">Name <span class="text text-red">*</span></label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $leave->name }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('employee_id') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('employee_id') ? 'has-error' : null }} --}}">
                <label for="department">Department<span class="text text-red">*</span></label>
                <input type="text" name="department" class="form-control" id="department" placeholder="Department" value="{{ $leave->department }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('employee_id') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('duration_schedule') ? 'has-error' : null }} --}}">
                <label for="leave_type">Leave Type <span class="text text-red">*</span></label>
                <input type="text" name="leave_type" class="form-control" id="leave_type" placeholder="Time In " value="{{ $leave->leave_type }}">
                <span class="text-danger">{{-- {{ $errors->first('leave_type_schedule') }} --}}</span>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group {{-- {{ $errors->has('duration_schedule') ? 'has-error' : null }} --}}">
                <label for="duration">Duration <span class="text text-red">*</span></label>
                <input type="text" name="duration" class="form-control" id="duration" placeholder="Time In " value="{{ $leave->duration }}">
                <span class="text-danger">{{-- {{ $errors->first('duration_schedule') }} --}}</span>
              </div>

              <div class="form-group">
                  <label>Reason</label>
                  <textarea name="reason" id="reason" class="form-control" rows="5" placeholder="Enter ...">{{ $leave->reason }}</textarea>
                </div>
              
              <div class="form-group{{--  {{ $errors->has('document_img') ? 'has-error' : null }} --}}">
                <label for="document_img">Document Image <span class="text text-red">*</span></label>
                <input type="file" name="document_img" class="form-control" id="document_img" placeholder="document_img">
                <span class="text-danger">{{-- {{ $errors->first('document_img') }} --}}</span>
              </div>

              
            </div>
          </div>
          
          <!-- row end -->
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="{{url('user_leave')}}/{{Auth::user()->employee_id}}" class="btn btn-danger">Canel</a>
        </div>
      </div>

    </form>
    <!-- /.box -->
    
    <!-- form end -->
    
  </section>
  @endsection