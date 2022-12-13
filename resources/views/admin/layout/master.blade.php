<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('page-title') | Emoloyee Management System</title>
    <meta name="_token" content="{{ csrf_token() }}">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    
    {{-- START FOR MODAL IMAGE --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    {{-- END FOR MODAL IMAGE   --}}
    <link rel="stylesheet" href="/assets/admin/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    {{-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> --}}
    <link rel="stylesheet" href="/assets/admin/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="/assets/admin/dist/css/skins/_all-skins.min.css">

    {{-- FOR DATA TABLE CDN --}}
    {{-- @yield('styles') --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <link href="/assets/magiczoomplus/magiczoomplus.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="notification-demo-style.css" type="text/css">



{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


  <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="/assets/magiczoomplus/magiczoomplus.js" type="text/javascript"></script>
 {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
     <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- OPEN IMAGE ON CLICK --}}
    <style type="text/css">
    .img_section5 figure img{
        filter: blur(2px);
        transition: .3s ease-in-out;
    }
    .img_section5:hover figure img{
        filter: blur(0);
        
    }
</style>

    <style type="text/css">
      /* Style the Image Used to Trigger the Modal */
      #myImg {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
      }

      #myImg:hover {opacity: 0.7;}

      /* The Modal (background) */
      .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
      }

      /* Modal Content (Image) */
      .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
      }

      /* Caption of Modal Image (Image Text) - Same Width as the Image */
      #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
      }

      /* Add Animation - Zoom in the Modal */
      .modal-content, #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
      }

      @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
      }

      /* The Close Button */
      .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
      }

      .close:hover,
      .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
      }
     .inner h3{
      background:transparent;
     }
      /* 100% Image Width on Smaller Screens */
      @media only screen and (max-width: 700px){
        .modal-content {
          width: 100%;
        }
      }
    </style>
    

    {{-- FOR CLOCK TIME --}}
    <script>
    function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
    }
    </script>
    <script>
    $(document).ready(function () {
        $('#noti_Button').click(function () {
            // $('#notifications').fadeToggle('fast', 'linear', function () {
            // });

            $('#noti_Counter').fadeOut('slow');     // HIDE THE COUNTER.
        });
    });
</script>
<style type="text/css">
      .modal-backdrop
      {
        position: relative;
      }
    </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini" onload="startTime()">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="/admin/dashboard" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>E</b>MS</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b> Panel
          </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
            <li class="dropdown notifications-menu" id="noti_Button">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning countt count"></span>
            </a>
            <ul class="dropdown-menu" style="background-color:white">
              <li class="header" style="background-color: #3c8dbc;color:white;">Notification</li>
                  <li style="height: 250px;overflow-y: auto;">
                    <ul class="menu saas">
                    </ul>
                    <ul class="menu saas1">
                    </ul>
                    <ul class="menu saas2">
                    </ul>
                    <ul class="menu saas3">
                    </ul>
                    <ul class="menu saas4">
                    </ul>
                    <ul class="menu saas5">
                    </ul>
                  </li>
            </ul>
          </li>
            {{-- <li><a href="#"></a></li> --}}
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="/uploads/{{Auth::user()->employee_img}}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="/uploads/{{Auth::user()->employee_img}}" class="img-circle" alt="User Image">
                    <p>
                      {{ Auth::user()->name }} - {{ Auth::user()->departments }}
                      <small>Member since {{ Auth::user()->joining_date }}</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  @if(Auth::user()->admin == 1)
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="{{ url('admin/profile') }}" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                    </div>
                  </li>
                  @else
                  <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('user_profile') }}" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </div>
              </li>
                  @endif
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="/uploads/{{Auth::user()->employee_img}}" style="height: 50px;width: 50px;" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->name }}</p>
              <span><i class="fa fa-circle text-success"></i> Online</span>
            </div>
          </div>
          @if(Auth::user()->admin==1)
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li class="treeview">
              <a href="{{ url('admin/task') }}"><i class="fa fa-user-plus"></i> <span>Task</span></a>
            </li>
            @if(Auth::user()->role !='Internal Project Manager')
            @if(Auth::user()->role !='Team Lead')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Employees</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-right pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="{{ url('admin/employees/create') }}"><i class="fa fa-circle-o"></i> Create Employee </a></li>
                <li class=""><a href="{{ url('admin/employees') }}"><i class="fa fa-circle-o"></i> View Employee </a></li>
              </ul>
            </li>
            @endif
            @endif
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-tasks"></i> <span>Attendances</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li class=""><a href="{{url('admin/attendances/create')}}/{{Auth::user()->employee_id}}"><i class="fa fa-circle-o"></i> Create Attendance </a></li>
                  <li class=""><a href="{{url('admin/attendances/my')}}/{{Auth::user()->employee_id}}"><i class="fa fa-circle-o"></i> My Attendance </a></li>
                  @if(Auth::user()->role =='Admin')
                  <li class=""><a href="{{url('admin/attendances')}}"><i class="fa fa-circle-o"></i> Employee's Attendance </a></li>
                  @endif
                  @if(Auth::user()->role =='Project Manager')
                  <li class=""><a href="{{url('admin/attendances')}}"><i class="fa fa-circle-o"></i> Employee's Attendance </a></li>
                  @endif
                  @if(Auth::user()->role =='Team Lead')
                  <li class=""><a href="{{url('admin/attendances')}}"><i class="fa fa-circle-o"></i> Employee's Attendance </a></li>
                  @endif
              </ul>
            </li>
            <!--<li class="treeview">-->
            <!--  <a href="{{ url('admin/attendances') }}">-->
            <!--    <i class="fa fa-tasks"></i> <span>Attendances</span>-->
            <!--    <small class="label pull-right bg-blue" title="Present">{{$total_present}}</small>-->
            <!--  <small class="label pull-right bg-red" title="Absent">{{$total_absent}}</small>-->
            <!--  </a>-->
            <!--</li>-->
            @if(Auth::user()->role !='Internal Project Manager')
            <li class="treeview">
              <a href="#">
                <i class="fa fa-pencil"></i> <span>Departments</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="{{ url('admin/departments/create') }}"><i class="fa fa-circle-o"></i> Create Department </a></li>
                <li class=""><a href="{{ url('admin/departments') }}"><i class="fa fa-circle-o"></i> View Department </a></li>
              </ul>
            </li>
            <li>
              <a href="/admin/mailbox/">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-yellow" title="Total Trash">{{ $totaltrash }}</small>
                  <small class="label pull-right bg-red" title="Total Send ">{{$totalsend}}</small>
                  <small class="label pull-right bg-green" title="Total Inbox">{{{$totalinbox}}}</small>
                </span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-book"></i> <span>Time Schedules</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="{{ url('admin/timeschedules/create') }}"><i class="fa fa-circle-o"></i> Create Time Schedule </a></li>
                <li class=""><a href="{{ url('admin/timeschedules') }}"><i class="fa fa-circle-o"></i> View Time Schedule </a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-film"></i> <span>Shifts</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                <small class="label bg-primary" title="active">{{$shifts}}</small>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="{{ url('admin/shifts/create') }}"><i class="fa fa-circle-o"></i> Create Shift </a></li>
                <li class=""><a href="{{ url('admin/shifts') }}"><i class="fa fa-circle-o"></i> View Shift </a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="{{ url('admin/leaves') }}">
                <i class="fa fa-user-plus"></i> <span>Leaves</span>
                  {{-- <span class="label label-warning countt"></span> --}}
                  <small class="label pull-right bg-yellow" title="Pending Leave">{{$pending_leaves}}</small>
              <small class="label pull-right bg-green" title="Approved Leave">{{$approve_leaves}}</small>
              <small class="label pull-right bg-red" title="Reject Leave">{{$reject_leaves}}</small>
              </a>
              <li class="treeview">
                <a href="#">
                  <i class="fa fa-user-plus"></i> <span>Break Time</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class=""><a href="{{ url('admin/breaktimes/create') }}"><i class="fa fa-circle-o"></i> Create Leave </a></li>
                  <li class=""><a href="{{ url('admin/breaktimes') }}"><i class="fa fa-circle-o"></i> View Leave </a></li>
                </ul>
              </li>
              @elseif(Auth::user()->role =='Internal Project Manager')
              <li>
              <a href="/admin/mailbox/">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-yellow" title="Total Trash">{{ $totaltrash }}</small>
                  <small class="label pull-right bg-red" title="Total Send ">{{$totalsend}}</small>
                  <small class="label pull-right bg-green" title="Total Inbox">{{{$totalinbox}}}</small>
                </span>
              </a>
            </li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-user-plus"></i> <span>Leaves</span>
                  <span class="label label-warning countt"></span>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="{{url('admin/leaves/create')}}/{{Auth::user()->employee_id}}"><i class="fa fa-circle-o"></i> Create Leave </a></li>
                <li class=""><a href="{{url('admin/leaves')}}/{{Auth::user()->employee_id}}"><i class="fa fa-circle-o"></i> View Leave </a></li>
              </ul>
            </li>
              @endif
            </li>
          </ul>
          @else
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="{{ url('user_dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            </li>
            <li class="treeview">
              <a href="{{ url('admin/task') }}"><i class="fa fa-user-plus"></i> <span>Task</span></a>
            </li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-tasks"></i> <span>Attendances</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  <li class=""><a href="{{url('user_attendance/create')}}/{{Auth::user()->employee_id}}"><i class="fa fa-circle-o"></i> Create Attendance </a></li>
                  <li class=""><a href="{{url('user_attendance')}}/{{Auth::user()->employee_id}}"><i class="fa fa-circle-o"></i> View Attendance </a></li>
                  
              </ul>
            </li>
            <li>
              <a href="/mailbox/">
                <i class="fa fa-envelope"></i> <span>Mailbox</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-yellow" title="Total Trash">{{ $totaltrash }}</small>
                  <small class="label pull-right bg-red" title="Total Send ">{{$totalsend}}</small>
                  <small class="label pull-right bg-green" title="Total Inbox">{{{$totalinbox}}}</small>
                </span>
              </a>
            </li>
            <li class="active treeview">
              <a href="#">
                <i class="fa fa-user-plus"></i> <span>Leaves</span>
                  <span class="label label-warning countt"></span>
              </a>
              <ul class="treeview-menu">
                <li class=""><a href="{{url('user_leave/create')}}/{{Auth::user()->employee_id}}"><i class="fa fa-circle-o"></i> Create Leave </a></li>
                <li class=""><a href="{{url('user_leave')}}/{{Auth::user()->employee_id}}"><i class="fa fa-circle-o"></i> View Leave </a></li>
              </ul>
            </li>
          </ul>
          @endif
        </section>
        <!-- /.sidebar -->
      </aside>
      <audio id="audiotag1" src="/assets/notification/inflicted.mp3" preload="auto"></audio>
      <!-- BEGIN MAIN CONTENT HERE -->
      @yield('main-content')
      <!-- END MAIN CONTENT HERE -->
      
    </div>
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
      </div>
      <strong>Copyright &copy; 2020 <a href="https://digitalopment.com">Digitalopment</a>.</strong> All rights
      reserved. <b>V.1</b>
    </footer>
    
  </div>
  <!-- ./wrapper -->
  <script src="/assets/admin/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <script src="/assets/admin/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
  <script src="/assets/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <script src="/assets/admin/plugins/chartjs/Chart.min.js"></script>
  <script src="/assets/admin/dist/js/app.min.js"></script>
  <script src="/assets/admin/dist/js/demo.js"></script>
  <script  src="../../Jquery/prettify.js"></script>
  {{-- FOR IMAGE MAGNIFIER --}}
  <script>
$(document).ready(function(){
// updating the view with notifications using ajax
var isAdmin = {{ (Auth::user()->admin) }}
  // if(isAdmin =='1')
  // {
    // alert('hello Admin');
    function load_unseen_notification(view = '')
    {
     $.ajax({
      url:"/admin/fetch",
      method:"POST",
     data:{
        "_token": "{{ csrf_token() }}",
        view:view},
      dataType:"json",
      success:function(data)
      {
        // alert(data.notification);
       $('.saas').html(data.notification);
       if(data.unseen_notification > 0)
       {
        $('.count').html(data.unseen_notification);
            // document.getElementById('audiotag1').play();
       }
      }
     });
    }

var cmplturl = window.location.href;
var hostname = window.location.hostname;
var protocol  = window.location.protocol;
var crntpage = window.location.pathname;
var page = crntpage.substr(6, 10);
// alert(hostname);
// if(cmplturl ==protocol+'//'+hostname+'/admin'+page){
function leave_notification(view = '')
{
 $.ajax({
  url:"/admin/leavefetch",
  method:"POST",
  data:{
    "_token": "{{ csrf_token() }}",
    view:view},
  dataType:"json",
  success:function(data)
  {
   $('.saas').html(data.notification);
   $('.saas1').html(data.notification1);
   $('.saas2').html(data.notification2);
   $('.saas3').html(data.notification3);
   $('.saas4').html(data.notification4);
   $('.saas5').html(data.notification5);
      if(data.unseen_notification > 0)
      {
        $('.count').html(data.unseen_notification);
        var x = document.getElementById('audiotag1');
        x.loop = false;
        x.load();
      }
  }
 });
}
leave_notification();
load_unseen_notification();
// }
// submit form and get new records

// load new notifications
$(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
});
setInterval(function(){
  leave_notification();
  load_unseen_notification();
}, 5000);
});

// updating the view with notifications using ajax
// submit form and get new records

// load new notifications
// $(document).on('click', '.dropdown-toggle', function(){
//   $('.count').html('');
//   leave_notification('yes');
// });
// setInterval(function(){
//   leave_notification();
// }, 5000);
// });

</script>
  <script>
  magnify("myimage", 3);
  </script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
  <script>
  $(function () {
    $('#dataTable').DataTable()
  })
</script>


{{-- OPEN IMAGE ON CLICK --}}
<script type="text/javascript">
  // Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script>
<script type="text/javascript">
  // Get the modal
var modal = document.getElementById("myModal1");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg1");
var modalImg = document.getElementById("img011");
var captionText = document.getElementById("caption1");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script>


</body>
</html>


