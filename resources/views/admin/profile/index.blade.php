@extends('admin.layout.master')
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
              <img id="myImg1" class="profile-user-img img-responsive img-circle" style="width: 200px;height: 200px" src="/uploads/{{Auth::user()->employee_img}}" alt="Admin profile picture">
              <div id="myModal1" class="modal">
                <span class="close" style="margin-top:50px; ">&times;</span>

                <!-- Modal Content (The Image) -->
                <img class="modal-content" id="img011" style="width: 100%;" >

                <!-- Modal Caption (Image Text) -->
                <div id="caption1"></div>
              </div>

              <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

              <p class="text-muted text-center">{{Auth::user()->departments}}</p>

              <a href="/admin/employees/{{Auth::user()->id}}/edit" class="btn btn-primary btn-block"><b>Edit Your Profile</b></a>
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
              <li><a href="#documents" data-toggle="tab">Documents</a></li>
            </ul>
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="tab-pane" id="documents">
                <h3 class="jumbotron"><center>Documents Upload</center></h3>
    <form method="post" action="{{url('admin/image/upload/store')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
    <input type="hidden" value="{{Auth::user()->id}}" name="employee_id" id="employee_id">
    @csrf
</form>   
              </div>
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
                  <label for="confirm_password" class="col-sm-2 control-label"> Confirm Password</label>
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
  <script type="text/javascript">
        Dropzone.options.dropzone =
         {
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
               return time+file.name;
            },
            acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf",
            addRemoveLinks: true,
            timeout: 50000,
            removedfile: function(file) 
            {
                var name = file.upload.filename;
                $.ajax({
                    headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                    type: 'POST',
                    url: '{{ url("admin/image/delete") }}',
                    data: {filename: name},
                    success: function (data){
                        console.log("File has been successfully removed!!");
                    },
                    error: function(e) {
                        console.log(e);
                    }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ? 
                    fileRef.parentNode.removeChild(file.previewElement) : void 0;
            },
       
            success: function(file, response) 
            {
                console.log(response);
            },
            error: function(file, response)
            {
               return false;
            }
};
</script>
@endsection