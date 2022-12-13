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
    <form name="formEdit" id="formEdit" method="post" action="/admin/employees/{{ $employee->id }}" enctype="multipart/form-data">
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
                <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="employee id" value="{{ $employee->employee_id }}">
                <span class="text-danger">{{-- {{ $errors->first('employee_id') }} --}}</span>
              </div>
              <div class="form-group{{--  {{ $errors->has('full_name') ? 'has-error' : null }} --}}">
                <label for="full_name">Full Name <span class="text text-red">*</span></label>
                <input type="text" name="full_name" class="form-control" id="full_name" placeholder="full name" value="{{ $employee->full_name }}">  
                <span class="text-danger">{{-- {{ $errors->first('full_name') }} --}}</span>
              </div>
              
              <div class="form-group {{-- {{ $errors->has('slug') ? 'has-error' : null }} --}}">
                <label for="slug">Slug <span class="text text-red">*</span></label>
                <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" value="{{ $employee->slug }}">
                <span class="text-danger">{{-- {{ $errors->first('slug') }} --}}</span>
              </div>
              
              <div class="form-group {{-- {{ $errors->has('dob') ? 'has-error' : null }} --}}">
                <label for="dob">Date of birth: <span class="text text-red">*</span></label>
                <input type="date" name="dob" class="form-control" id="dob" placeholder="Date of Birth" value="{{ $employee->dob }}">
                <span class="text-danger">{{-- {{ $errors->first('dob') }} --}}</span>
              </div>
              
              <div class="form-group {{-- {{ $errors->has('email') ? 'has-error' : null }} --}}">
                <label for="email">Email <span class="text text-red">*</span></label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ $employee->email }}">
                <span class="text-danger">{{-- {{ $errors->first('email') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('position') ? 'has-error' : null }} --}}">
                <label for="position">Position <span class="text text-red">*</span></label>
                <input type="position" name="position" class="form-control" id="position" placeholder="position" value="{{ $employee->position }}">
                <span class="text-danger">{{-- {{ $errors->first('position') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('joining_date') ? 'has-error' : null }} --}}">
                <label for="joining_date">Joining Date <span class="text text-red">*</span></label>
                <input type="date" name="joining_date" class="form-control" id="joining_date" placeholder="joining date" value="{{ $employee->joining_date }}">
                <span class="text-danger">{{-- {{ $errors->first('joining_date') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('time_in_schedule') ? 'has-error' : null }} --}}">
                <label for="time_in_schedule">Time in Schedule <span class="text text-red">*</span></label>
                <input type="time" name="time_in_schedule" class="form-control" id="time_in_schedule" placeholder="time in schedule" value="{{ $employee->time_in_schedule }}">
                <span class="text-danger">{{-- {{ $errors->first('time_in_schedule') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('time_out_schedule') ? 'has-error' : null }} --}}">
                <label for="time_out_schedule">Time out Schedule <span class="text text-red">*</span></label>
                <input type="time" name="time_out_schedule" class="form-control" id="time_out_schedule" placeholder="time out schedule" value="{{ $employee->time_out_schedule }}">
                <span class="text-danger">{{-- {{ $errors->first('time_out_schedule') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('country') ? 'has-error' : null }} --}}">
                <label for="country">Country <span class="text text-red">*</span></label>
                <input type="country" name="country" class="form-control" id="country" placeholder="country" value="{{ $employee->country }}">
                <span class="text-danger">{{-- {{ $errors->first('country') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('state') ? 'has-error' : null }} --}}">
                <label for="state">State <span class="text text-red">*</span></label>
                <input type="state" name="state" class="form-control" id="state" placeholder="state" value="{{ $employee->state }}">
                <span class="text-danger">{{-- {{ $errors->first('state') }} --}}</span>
              </div>

              <div class="form-group{{--  {{ $errors->has('city') ? 'has-error' : null }} --}}">
                <label for="city">City <span class="text text-red">*</span></label>
                <input type="city" name="city" class="form-control" id="city" placeholder="city" value="{{ $employee->city }}">
                <span class="text-danger">{{-- {{ $errors->first('city') }} --}}</span>
              </div>

              <div class="form-group {{-- {{ $errors->has('country') ? 'has-error' : null }} --}}">
                <label>Country <span class="text text-red">*</span></label>
                <select name="country" id="country" class="form-control select2" style="width: 100%;">
                  <option value="none">-- Select Country --</option>
                  @foreach($countries as $country)
                  <option value="{{ $country->name }}">{{ ($country->name == $employee->country) ? 'selected' : null }}</option>
                  @endforeach
                </select>
              </div>
              
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" value="{{ $employee->phone }}">
              </div>
              
              <div class="form-group">
                <label>Address</label>
                <textarea name="address" id="address" class="form-control" rows="5" placeholder="Enter ...">{{ $employee->address }}</textarea>
              </div>
            </div>
            
            <div class="col-xs-6">
              <div class="form-group">
                <label for="employee_img">Employee Image <span class="text text-red">*</span></label>
                <input type="file" name="employee_img" class="form-control" id="employee_img">
              </div>
              <div class="form-group">
                <label for="salary">Salary</label>
                <input type="text" name="salary" class="form-control" id="salary" placeholder="Salary" value="{{ $employee->salary }}">
              </div>
              <div class="form-group">
                <label for="facebook_id">Facebook ID</label>
                <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook ID" value="{{ $employee->facebook_id }}">
              </div>
              
              <div class="form-group">
                <label for="linkedin_id">LinkedIn ID</label>
                <input type="text" name="linkedin_id" class="form-control" id="linkedin_id" placeholder="LinkedIn ID" value="{{ $employee->linkedin_id }}">
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" class="form-control" id="password" placeholder="Password" value="{{ $employee->password }}">
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