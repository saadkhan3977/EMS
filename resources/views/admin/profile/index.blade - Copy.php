@extends('admin.layout.master')
@section('page-title')
User Profile
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Admin Profile
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="/uploads/{{Auth::user()->employee_img}}" alt="User profile picture">
            <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
            <p class="text-muted text-center">{{Auth::user()->departments}}</p>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        <!-- About Me Box -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit your Profile here !</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-default">Edit your Profile</button> --}}
            <a href="/admin/employees/{{Auth::user()->id}}/edit" class="btn btn-success btn-flat btn-sm"> Edit Your Profile</a>

          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#activity" data-toggle="tab">Bio</a></li>
            <li><a href="#settings" data-toggle="tab">Change Password</a></li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              <!-- Post -->
              <div class="post">
                <form class="form-horizontal">
                
                <div class="row">
                  <div class="col-xs-6 text-center">
                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Employee ID</strong>

                      <p class="text-muted">
                        {{Auth::user()->employee_id}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Employee Name</strong>

                      <p class="text-muted">
                        {{Auth::user()->name}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Slug</strong>

                      <p class="text-muted">
                        {{Auth::user()->slug}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Employee E-mail</strong>

                      <p class="text-muted">
                        {{Auth::user()->email}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Date of Birth</strong>

                      <p class="text-muted">
                        {{Auth::user()->dob}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Country</strong>

                      <p class="text-muted">
                        {{Auth::user()->country}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Address</strong>

                      <p class="text-muted">
                        {{Auth::user()->address}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Phone</strong>

                      <p class="text-muted">
                        {{Auth::user()->phone}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Department</strong>

                      <p class="text-muted">
                        {{Auth::user()->departments}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Time Schedule</strong>

                      <p class="text-muted">
                        {{Auth::user()->time_schedule}}
                      </p>

                      <hr>
                    </div>
                  </div>

                  <div class="col-xs-6 text-center">
                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Gender</strong>

                      <p class="text-muted">
                        {{Auth::user()->gender}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Mertial Status</strong>

                      <p class="text-muted">
                        {{Auth::user()->merital}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Shift</strong>

                      <p class="text-muted">
                        {{Auth::user()->shift}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Facebook ID</strong>

                      <p class="text-muted">
                        {{Auth::user()->facebook_id}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Linkedin ID</strong>

                      <p class="text-muted">
                        {{Auth::user()->linkedin_id}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Joining Date</strong>

                      <p class="text-muted">
                        {{Auth::user()->joining_date}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Status</strong>

                      <p class="text-muted">
                        {{Auth::user()->status}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Skills</strong>

                      <p class="text-muted">
                        {{Auth::user()->status}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Education</strong>

                      <p class="text-muted">
                        {{Auth::user()->status}}
                      </p>

                      <hr>
                    </div>

                    <div class="form-group">
                      <strong><i class="fa fa-book margin-r-5 control-label text-center"></i> Document Images</strong>

                      <p class="text-muted">
                        B.S. in Computer Science from the University
                      </p>

                      <hr>
                    </div>
                  </div>
                </div>
                </form>
              </div>
              <!-- /.post -->
            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="settings">
              @if ($alert = Session::get('alert-danger'))
                <div class="alert alert-danger">
                    {{ $alert }}
                </div>
            @endif
              
              <form method="post" action="{{ route('update.password') }}" class="form-horizontal">
                @csrf
                {{-- <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                  <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                  <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                  <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  </div>
                </div>
                <div class="form-group row mb-0">
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                    {{ __('Reset Password') }}
                    </button>
                  </div>
                </div> --}}
              
                <div class="form-group">
                  <label for="old_password" class="col-sm-2 control-label">Old Password</label>
                  <div class="col-sm-10">
                    <input id="old_password" type="old_password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" value="{{ $old_password ?? old('old_password') }}" required autocomplete="old_password" autofocus>
                    @error('old_password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="col-sm-2 control-label">New Password</label>
                  <div class="col-sm-10">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                </div>
                <div class="form-group">
                  <label for="confirm_password" class="col-sm-2 control-label"> confirm_password</label>
                  <div class="col-sm-10">
                    <input id="confirm_password" type="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required autocomplete="new-password">
                    @error('confirm_password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                </div>
                
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Change Password</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">{{Auth::user()->name}}</h4>
      </div>
      <div class="modal-body">
        <form name="formEdit" id="formEdit" method="post" action="/admin/profile/{{Auth::user()->id}}" class="form-horizontal" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('put') }}
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{Auth::user()->name}}">
            </div>
          </div>
          <div class="form-group">
            <label for="departments" class="col-sm-2 control-label">Department</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="departments" id="departments" placeholder="Email" value="{{Auth::user()->departments}}">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" name="email" placeholder="Name" value="{{Auth::user()->email}}">
            </div>
          </div>
          <div class="form-group">
            <label for="address" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="address" id="address" rows="6" placeholder="Enter ...">{{Auth::user()->address}}</textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="employee_img" class="col-sm-2 control-label">Image</label>
            <div class="col-sm-10">
              <input type="file" id="employee_img" name="employee_img">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection