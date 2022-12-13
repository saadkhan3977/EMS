@extends('admin.layout.master')

@section('page-title')
  Admin Dashboard
@endsection

@section('main-content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $total_admins }}</h3>

              <p>Total Admins</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="/admin/employees" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3 data-toggle="modal" data-target="#modal-default">{{ $total_present }}<sup style="font-size: 20px"></sup><img src="/assets/user_profile/images/online.png" alt="" width="30"></h3>
              
              <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
          <div class="col-md-10">
              <div class="col-md-5" style="float:left;color:black;"><p class="modal-title"><img src="/assets/user_profile/images/online.png" alt="" width="20"> Online Employee</p></div>
              <div class="col-md-5"  style="float:right;color:black;"><p class="modal-title"><img src="/assets/user_profile/images/online.png" alt="" width="20"> Offline Employee</p></div>
          </div>
          <!--<h4 class="modal-title">Modal Header</h4>-->
        </div>
        <div class="modal-body col-md-10">
            <div class="col-md-5" style="float:left">
                <?php $a=1; ?>
                @foreach($total_presents as $row => $key)
                <p style="color:black">{{$a++}} > {{$key->employee_name}}</p><hr>
                @endforeach
            </div>
            <div class="col-md-5" style="float:right">
                <?php $a=1; ?>
                @foreach($total_absents as $row => $key)
                <p style="color:black">{{$a++}} > {{$key->employee_name}}</p><hr>
                @endforeach
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
              <p>Online Employees</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="/admin/employees" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
        <!-- ./col -->
      <div class="row">
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $total_departments }}</h3>

              <p>Total Departments</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="/admin/departments" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $total_leaves }}</h3>

              {{-- <p>Total Leaves <span class="btn-warning" style="padding: 3px" title="Pending Leaves">{{$pending_leaves}}</span> | <span class="btn-primary" style="padding: 3px" title="Approved Leaves">{{$approve_leaves}}</span> | <span class="btn-danger" style="padding: 3px" title="Reject Leaves">{{$reject_leaves}}</span></p> --}}
              <p>Leaves</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="/admin/leaves" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection