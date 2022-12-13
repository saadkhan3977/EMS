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
    <form name="formEdit" id="formEdit" method="post" action="/user_profile/{{ Auth::user()->id }}" enctype="multipart/form-data">
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
                <input type="text" name="employee_id" class="form-control" id="employee_id" placeholder="employee id"  value="{{ Auth::user()->employee_id }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('employee_id') }} --}}</span>
              </div>
              <div class="form-group{{--  {{ $errors->has('name') ? 'has-error' : null }} --}}">
                <label for="name">Full Name <span class="text text-red">*</span></label>
                <input type="text" name="name" class="form-control" id="name" placeholder="full name"  value="{{ Auth::user()->name }}">  
                <span class="text-danger">{{-- {{ $errors->first('name') }} --}}</span>
              </div>
              
              <div class="form-group {{-- {{ $errors->has('slug') ? 'has-error' : null }} --}}">
                <label for="slug">Slug <span class="text text-red">*</span></label>
                <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug"  value="{{ Auth::user()->slug }}">
                <span class="text-danger">{{-- {{ $errors->first('slug') }} --}}</span>
              </div>
              
              <div class="form-group {{-- {{ $errors->has('dob') ? 'has-error' : null }} --}}">
                <label for="dob">Date of birth: <span class="text text-red">*</span></label>
                <input type="date" name="dob" class="form-control" id="dob" placeholder="Date of Birth"  value="{{ Auth::user()->dob }}">
                <span class="text-danger">{{-- {{ $errors->first('dob') }} --}}</span>
              </div>
              
              <div class="form-group {{-- {{ $errors->has('email') ? 'has-error' : null }} --}}">
                <label for="email">Email <span class="text text-red">*</span></label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email"  value="{{ Auth::user()->email }}">
                <span class="text-danger">{{-- {{ $errors->first('email') }} --}}</span>
              </div>

              <div class="form-group">
                <label for="facebook_id">Facebook ID</label>
                <input type="text" name="facebook_id" class="form-control" id="facebook_id" placeholder="Facebook ID"  value="{{ Auth::user()->facebook_id }}">
              </div>
              
              <div class="form-group">
                <label for="linkedin_id">LinkedIn ID</label>
                <input type="text" name="linkedin_id" class="form-control" id="linkedin_id" placeholder="LinkedIn ID"  value="{{ Auth::user()->linkedin_id }}">
              </div>

              <div class="form-group {{-- {{ $errors->has('country') ? 'has-error' : null }} --}}">
                <label>Country <span class="text text-red">*</span></label>
                <select name="country" id="country" class="form-control select2" style="width: 100%;">
                  <option value="{{ Auth::user()->country }}">{{ Auth::user()->country }}</option>
                  @foreach($countries as $country)
                  <option value="{{ $country->name }}">{{$country->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone"  value="{{ Auth::user()->phone }}">
              </div>
              
              <div class="form-group">
                <label>Address</label>
                <textarea name="address" id="address" class="form-control" rows="5" placeholder="Enter ...">{{ Auth::user()->address }}</textarea>
              </div>


              
              
            </div>
            
            <div class="col-xs-6">
              <div class="form-group {{-- {{ $errors->has('joining_date') ? 'has-error' : null }} --}}">
                <label for="joining_date">Joining Date <span class="text text-red">*</span></label>
                <input type="date" name="joining_date" class="form-control" id="joining_date" placeholder="joining date"  value="{{ Auth::user()->joining_date }}" readonly>
                <span class="text-danger">{{-- {{ $errors->first('joining_date') }} --}}</span>
              </div>


              <div class="form-group">
                <label for="time_schedule">Time Schedule</label>
                <input type="text" name="time_schedule" class="form-control" id="time_schedule" placeholder="time_schedule" value="{{ Auth::user()->time_schedule }}" readonly>
              </div>

              <div class="form-group">
                <label for="departments">Department</label>
                <input type="text" name="departments" class="form-control" id="departments" placeholder="departments" value="{{ Auth::user()->departments }}" readonly>
              </div>

              <div class="form-group">
                <label for="shift">Shift</label>
                <input type="text" name="shift" class="form-control" id="shift" placeholder="shift" value="{{ Auth::user()->shift }}" readonly>
              </div>


              <div class="form-group {{-- {{ $errors->has('country') ? 'has-error' : null }} --}}">
                <label>Gender <span class="text text-red">*</span></label>
                <select name="gender" id="gender" class="form-control select2" style="width: 100%;">
                  <option value="{{ Auth::user()->gender }}">{{ Auth::user()->gender }}</option>
                  @if(Auth::user()->gender == 'male')
                  <option value="female">Female</option>
                  @else
                  <option value="male">Male</option>
                  @endif
                </select>
              </div>

              <div class="form-group {{-- {{ $errors->has('country') ? 'has-error' : null }} --}}">
                <label>Marital Status <span class="text text-red">*</span></label>
                <select name="merital" id="merital" class="form-control select2" style="width: 100%;">
                  <option value="{{ Auth::user()->merital }}">{{ Auth::user()->merital }}</option>
                  @if(Auth::user()->merital == 'single')
                  <option value="married">Married</option>
                  @else
                  <option value="single">Single</option>
                  @endif
                </select>
              </div>
              
              <div class="form-group">
                <label for="employee_img">Employee Image <span class="text text-red">*</span></label>
                <input type="file" name="employee_img" class="form-control" id="employee_img"  value="{{ Auth::user()->employee_img }}">
              </div>
              <div class="form-group">
                <label for="salary">Salary</label>
                <input type="text" name="salary" class="form-control" id="salary" placeholder="Salary" value="{{ Auth::user()->salary }}" readonly>
              </div>
              

              <div class="form-group">
                <label for="admin">Admin</label>
                <input type="text" name="admin" class="form-control" id="admin" placeholder="admin" value="{{ (Auth::user()->admin == 1) ? 'YES' : 'NO' }}" readonly>
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input type="text" name="password" class="form-control" id="password" placeholder="Password" value="{{ Auth::user()->password }}" readonly>
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
          <a href="{{url('user_profile')}}" class="btn btn-danger">Canel</a>
        </div>
      </div>

    </form>
    <!-- /.box -->
    
    <!-- form end -->
    
  </section>
  @endsection