@extends('admin.layout.master')
@section('page-title')
Manage Attendance
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Employee Details</h1>
  </section>
  <!-- Main content -->
  <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">              
              <img class="profile-user-img img-responsive img-circle" style="width: 200px;height: 200px" src="/uploads/{{$employee['employee_img']}}" alt="User profile picture">

              <h3 class="profile-username text-center">{{$employee['name']}}</h3>

              <p class="text-muted text-center">{{$employee['departments']}}</p>

              <a href="/admin/employees/{{$employee['id']}}/edit" class="btn btn-primary btn-block"><b>Edit Your Profile</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              {{-- <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li> --}}
              <li><a href="#timeline" data-toggle="tab">Profile Details</a></li>
            </ul>
            <div class="tab-content">
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
                        {{$employee['employee_id']}}
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
                        {{$employee['email']}}
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
                        {{$employee['dob']}}
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
                        {{$employee['country']}}
                      </div>
                    </div>
                  </li>
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>Address</strong></h3>
                      <div class="timeline-body">
                        {{ $employee['address'] }}
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
                        {{$employee['phone']}}
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
                        {{$employee['departments']}}
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
                        {{$employee['time_schedule']}}
                      </div>
                    </div>
                  </li>
                  @if(Auth::user()->role =='Admin')
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>Salary</strong></h3>
                      <div class="timeline-body">
                        {{$employee['salary']}}
                      </div>
                    </div>
                  </li>
                  @endif
                  <!-- END timeline item -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-dot-circle-o bg-blue"></i>

                    <div class="timeline-item">
                      <h3 class="timeline-header bg-blue"><strong>GENDER</strong></h3>
                      <div class="timeline-body">
                        {{$employee['gender']}}
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
                        {{$employee['merital']}}
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
                        {{$employee['shift']}}
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
                        {{$employee['facebook_id']}}
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
                        {{$employee['linkedin_id']}}
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
                        {{$employee['joining_date']}}
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
                        {{$employee['status']}}
                      </div>
                    </div>
                  </li>

                </ul>
              </div>
              <!-- /.tab-pane -->
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
</div>
@endsection