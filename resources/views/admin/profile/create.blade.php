@extends('admin.layout.master')

@section('page-title')
Create Employee
@endsection

@section('main-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Create Employee
    <small>All * field required</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Forms</a></li>
      <li class="active">Advanced Elements</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    
    <!-- SELECT2 EXAMPLE -->
    <!-- form start -->
    <form name="formAdd" id="formAdd" method="POST" action="/admin/employees" enctype="multipart/form-data">
      @csrf
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
          @if (count($errors))
            <div class="alert alert-danger">
              <strong>Ooppss! Something went wrong</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          <!-- row start -->
          <div class="row">
            <div class="col-xs-6">
              <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : null }}">
                <label for="employee_id">Employee ID <span class="text text-red">*</span></label>
                <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="employee id">
                <span class="text-danger">{{ $errors->first('employee_id') }}</span>
              </div>
              <div class="form-group {{ $errors->has('full_name') ? 'has-error' : null }}">
                <label for="full_name">Full Name <span class="text text-red">*</span></label>
                <input type="text" name="full_name" class="form-control" id="full_name" placeholder="full name">
                <span class="text-danger">{{ $errors->first('full_name') }}</span>
              </div>
              
              <div class="form-group {{ $errors->has('slug') ? 'has-error' : null }}">
                <label for="slug">Slug <span class="text text-red">*</span></label>
                <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" >
                <span class="text-danger">{{ $errors->first('slug') }}</span>
              </div>
              
              <div class="form-group">
                <label for="dob">Date of birth: <span class="text text-red">*</span></label>
                <input type="date" name="dob" class="form-control" id="dob" placeholder="Date of Birth">
                <span class="text-danger"></span>
              </div>
              
              <div class="form-group {{ $errors->has('email') ? 'has-error' : null }}">
                <label for="email">Email <span class="text text-red">*</span></label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                <span class="text-danger">{{ $errors->first('email') }}</span>
              </div>

              <div class="form-group {{ $errors->has('position') ? 'has-error' : null }}">
                <label for="position">Position <span class="text text-red">*</span></label>
                <input type="position" name="position" class="form-control" id="position" placeholder="position">
                <span class="text-danger">{{ $errors->first('position') }}</span>
              </div>

              <div class="form-group {{ $errors->has('joining_date') ? 'has-error' : null }}">
                <label for="joining_date">Joining Date <span class="text text-red">*</span></label>
                <input type="date" name="joining_date" class="form-control" id="joining_date" placeholder="joining date">
                <span class="text-danger">{{ $errors->first('joining_date') }}</span>
              </div>

              <div class="form-group {{ $errors->has('time_schedule') ? 'has-error' : null }}">
                <label for="time_schedule">Time in Schedule <span class="text text-red">*</span></label>
                <input type="time" name="time_schedule" class="form-control" id="time_schedule" placeholder="time in schedule">
                <span class="text-danger">{{ $errors->first('time_schedule') }}</span>
              </div>

              <div class="form-group {{ $errors->has('time_out_schedule') ? 'has-error' : null }}">
                <label for="time_out_schedule">Time out Schedule <span class="text text-red">*</span></label>
                <input type="time" name="time_out_schedule" class="form-control" id="time_out_schedule" placeholder="time in schedule">
                <span class="text-danger">{{ $errors->first('time_out_schedule') }}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('country') ? 'has-error' : null }} --}}">
                <label>Country <span class="text text-red">*</span></label>
                <select name="country" id="country" class="form-control select2" style="width: 100%;">
                  <option value="none">-- Select Country --</option>
                  @foreach($countries as $country)
                  <option value="{{ $country->name }}">{{ $country->name }}</option>
                  @endforeach
                </select>
              </div>
              
              <div class="form-group {{ $errors->has('phone') ? 'has-error' : null }}">
                <label for="phone">Phone <span class="text text-red">*</span></label>
                <input type="number" name="phone" class="form-control" id="phone" placeholder="phone">
                <span class="text-danger">{{ $errors->first('phone') }}</span>
              </div>
              
              <div class="form-group">
                <label>Address</label>
                <textarea name="address" id="address" class="form-control" rows="5" placeholder="Enter ..."></textarea>
              </div>
            </div>
            
            <div class="col-xs-6">
              <div class="form-group {{ $errors->has('employee_img') ? 'has-error' : null }}">
                <label for="employee_img">Employee Image <span class="text text-red">*</span></label>
                <input type="file" name="employee_img" class="form-control" id="employee_img" placeholder="employee_img">
                <span class="text-danger">{{ $errors->first('employee_img') }}</span>
              </div>
              <div class="form-group {{ $errors->has('salary') ? 'has-error' : null }}">
                <label for="salary">Salary <span class="text text-red">*</span></label>
                <input type="text" name="salary" class="form-control" id="salary" placeholder="salary">
                <span class="text-danger">{{ $errors->first('salary') }}</span>
              </div>
              <div class="form-group">
                <label for="facebook_id">Facebook ID</label>
                <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook ID">
              </div>
              
              <div class="form-group">
                <label for="linkedin_id">LinkedIn ID</label>
                <input type="text" name="linkedin_id" class="form-control" id="linkedin_id" placeholder="LinkedIn ID">
              </div>

              <div class="form-group {{ $errors->has('password') ? 'has-error' : null }}">
                <label for="password">Password <span class="text text-red">*</span></label>
                <input type="text" name="password" class="form-control" id="password" placeholder="password">
                <span class="text-danger">{{ $errors->first('password') }}</span>
              </div>
              
              
              {{-- <div class="form-group">
                <label>Author Feature</label>
                <select name="author_feature" id="author_feature" class="form-control select2" style="width: 100%;">
                  <option value="no">NO</option>
                  <option value="yes">Yes</option>
                </select>
              </div> --}}
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