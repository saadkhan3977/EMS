@extends('layout.master')
@section('page-title')
User Profile
@endsection
@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">              
              <img class="profile-user-img img-responsive img-circle" style="width: 200px;height: 200px" src="/uploads/{{Auth::user()->employee_img}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

              <p class="text-muted text-center">{{Auth::user()->departments}}</p>

              <a href="/user_profile/{{Auth::user()->id}}/edit" class="btn btn-primary btn-block"><b>Edit Your Profile</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!--<strong><i class="fa fa-book margin-r-5"></i> About</strong>-->

              <!--<p class="text-muted">-->
              <!--  B.S. in Computer Science from the University of Tennessee at Knoxville-->
              <!--</p>-->

              <!--<hr>-->

              <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>

              <p class="text-muted">{{Auth::user()->address}}</p>

              <!--<hr>-->

              <!--<strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>-->

              <!--<p>-->
              <!--  <span class="label label-danger">UI Design</span>-->
              <!--  <span class="label label-success">Coding</span>-->
              <!--  <span class="label label-info">Javascript</span>-->
              <!--  <span class="label label-warning">PHP</span>-->
              <!--  <span class="label label-primary">Node.js</span>-->
              <!--</p>-->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              {{-- <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li> --}}
              <li><a href="#timeline" data-toggle="tab">Profile Details</a></li>
              <li><a href="#settings" data-toggle="tab">Change Password</a></li>
            </ul>
            <div class="tab-content">
              {{-- <div class="active tab-pane" id="activity">
                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                        <span class="username">
                          <a href="#">Jonathan Burke Jr.</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Shared publicly - 7:30 PM today</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>
                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Sent you a message - 3 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <p>
                    Lorem ipsum represents a long-held tradition for designers,
                    typographers and the like. Some people hate it and argue for
                    its demise, but others ignore the hate as they create awesome
                    tools to help create filler text for everyone from bacon lovers
                    to Charlie Sheen fans.
                  </p>

                  <form class="form-horizontal">
                    <div class="form-group margin-bottom-none">
                      <div class="col-sm-9">
                        <input class="form-control input-sm" placeholder="Response">
                      </div>
                      <div class="col-sm-3">
                        <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Send</button>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.post -->

                <!-- Post -->
                <div class="post">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Adam Jones</a>
                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                        </span>
                    <span class="description">Posted 5 photos - 5 days ago</span>
                  </div>
                  <!-- /.user-block -->
                  <div class="row margin-bottom">
                    <div class="col-sm-6">
                      <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-6">
                          <img class="img-responsive" src="../../dist/img/photo2.png" alt="Photo">
                          <br>
                          <img class="img-responsive" src="../../dist/img/photo3.jpg" alt="Photo">
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                          <img class="img-responsive" src="../../dist/img/photo4.jpg" alt="Photo">
                          <br>
                          <img class="img-responsive" src="../../dist/img/photo1.png" alt="Photo">
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->

                  <ul class="list-inline">
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-share margin-r-5"></i> Share</a></li>
                    <li><a href="#" class="link-black text-sm"><i class="fa fa-thumbs-o-up margin-r-5"></i> Like</a>
                    </li>
                    <li class="pull-right">
                      <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments
                        (5)</a></li>
                  </ul>

                  <input class="form-control input-sm" type="text" placeholder="Type a comment">
                </div>
                <!-- /.post -->
              </div> --}}
              <!-- /.tab-pane -->
              <div class="active tab-pane" id="timeline">
                <!-- The timeline -->
              <style type="text/css">
                ul {
                  col: ;: 2;
                  -webkit-list-style: 2;
                  -moz-list-style: 2;
                }
              </style>
                <ul class="timeline timeline-inverse">
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>ID</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->employee_id}}
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>E-MAIL</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->email}}
                      </div>
                    </div>
                  </li>
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>Salary</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->salary}}
                      </div>
                    </div>
                  </li>
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>Role</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->role}}
                      </div>
                    </div>
                  </li>
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>Admin</strong></h3>
                      <div class="timeline-body">
                        @if(Auth::user()->admin =='1')
                        Yes
                        @else
                        No
                        @endif
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>DATE OF BIRTH</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->dob}}
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>COUNTRY</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->country}}
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>PHONE</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->phone}}
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>DEPARTMENT</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->departments}}
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>TIME SCHEDULE</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->time_schedule}}
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>GENDER</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->gender}}
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>MERITAL STATUS</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->merital}}
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>SHIFT</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->shift}}
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>FACEBOOK ID</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->facebook_id}}
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>LINKEDIN ID</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->linkedin_id}}
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>JOINING DATE</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->joining_date}}
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>STATUS</strong></h3>
                      <div class="timeline-body">
                        {{Auth::user()->status}}
                      </div>
                    </div>
                  </li>
                  <!-- END timeline item -->
                  
                  <!-- timeline item -->
                  {{-- <li>
                    <i class="fa fa-camera bg-blue"></i>

                    <div class="timeline-item">
                      <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>

                      <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                      <div class="timeline-body">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                      </div>
                    </div>
                  </li> --}}
                  <!-- END timeline item -->
                  
                </ul>
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
                    <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" value="{{ $old_password ?? old('old_password') }}" required autocomplete="old_password" autofocus>
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
                  <label for="confirm_password" class="col-sm-2 control-label"> Confirm Password</label>
                  <div class="col-sm-10">
                    <input id="confirm_password" type="password" class="form-control @error('confirm_password') is-invalid @enderror" name="confirm_password" required autocomplete="new-password">
                    @error('confirm_password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                </div>
                
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Change Password</button>
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
@endsection