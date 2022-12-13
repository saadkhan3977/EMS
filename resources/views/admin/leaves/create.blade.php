@extends('admin.layout.master')

@section('page-title')
Create Leave
@endsection

@section('main-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Create Leave
    <small>All * field required</small>
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    
    <!-- SELECT2 EXAMPLE -->
    <!-- form start -->
    <form name="formAdd" id="formAdd" method="POST" action="{{url('user_leave/store')}}/{{Auth::user()->employee_id}}" enctype="multipart/form-data">
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

              <div class="form-group {{-- {{ $errors->has('duration_schedule') ? 'has-error' : null }} --}}">
                <label for="name">Name <span class="text text-red">*</span></label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ Auth::user()->name }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('leave_type_schedule') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('duration_schedule') ? 'has-error' : null }} --}}">
                <label for="department">Department <span class="text text-red">*</span></label>
                <input type="text" name="department" class="form-control" id="department" placeholder="Department" value="{{ Auth::user()->departments }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('leave_type_schedule') }} --}}</span>
              </div>

              <div class="form-group {{ $errors->has('leave_type') ? 'has-error' : null }}">
                <label for="leave_type">Leave Type <span class="text text-red">*</span></label>
                <input type="text" name="leave_type" class="form-control" id="leave_type" placeholder="Leave Type ">
                <span class="text-danger">{{-- {{ $errors->first('leave_type_schedule') }} --}}</span>
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group {{ $errors->has('duration') ? 'has-error' : null }}">
                <label for="duration">Duration <span class="text text-red">*</span></label>
                <input type="text" name="duration" class="form-control" id="duration" placeholder="Duration ">
                <span class="text-danger">{{-- {{ $errors->first('duration_schedule') }} --}}</span>
              </div>

              <div class="form-group {{ $errors->has('reason') ? 'has-error' : null }}">
                  <label>Reason</label>
                  <textarea name="reason" id="reason" class="form-control" rows="5" placeholder="Enter ..."></textarea>
                </div>
              
              <div class="form-group {{ $errors->has('document_img') ? 'has-error' : null }}">
                <label for="document_img">Document Image <span class="text text-red">*</span></label>
                <input type="file" name="document_img" class="form-control" id="document_img" required="">
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
          <a href="{{url('/admin/leaves')}}/{{Auth::user()->employee_id}}" class="btn btn-danger">Cancel</a>
        </div>
      </div>

    </form>
    <!-- /.box -->
    
    <!-- form end -->
    
  </section>
  @endsection