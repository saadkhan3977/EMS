@extends('admin.layout.master')
@section('page-title')
Manage Attendance
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>Leave Detail</h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- /.row -->
    <div class="post">
      <!-- /.user-block -->
      <div class="row margin-bottom">
        
        <!-- /.col -->
        <div class="col-sm-6">
          <div class="row">
            <div class="col-sm-6">
              <h3>Employee ID :</h3>
              <h4>{{$leave->employee_id}}</h4>
              <br>
              <h3>Leave Type :</h3>
              <h4>{{$leave->leave_type}}</h4>
              <br>
              <h3>Duration :</h3>
              <h4>{{$leave->duration}}</h4>
              <br>
              <h3>Reason :</h3>
              <h4>{{$leave->reason}}</h4>
              <br>
            </div>
            <!-- /.row -->
          </div>
          <!-- /.col -->
        </div>
        <h3>Document Image: </h3>
        @if($leave->document_img == 'No document img found')
        <img src="/assets/admin/dist/img/no-image.png" style="width:30%;cursor:zoom-in"
        onclick="document.getElementById('modal01').style.display='block'">
        <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
          <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
          <div class="w3-modal-content w3-animate-zoom">
            <img src="/assets/admin/dist/img/no-image.png" style="width:100%">
          </div>
        </div>
        @else
        <img src="/uploads/{{ $leave->document_img }}" style="width:30%;cursor:zoom-in"
        onclick="document.getElementById('modal01').style.display='block'">
        <div id="modal01" class="w3-modal" onclick="this.style.display='none'">
          <span class="w3-button w3-hover-red w3-xlarge w3-display-topright">&times;</span>
          <div class="w3-modal-content w3-animate-zoom img-magnifier-container">
            <img id="myimage" class="img-responsive" src="/uploads/{{ $leave->document_img }}" style="width:100%">
          </div>
        </div>
        {{-- <img id="myimage" class="img-responsive" src="/uploads/{{ $leave->document_img }}" width="70%" height="70%" alt="{{ $leave->document_img }}"> --}}
      </div>
      @endif
      {{-- <div class="col-sm-6 img-magnifier-container">
        <img id="myimage" class="img-responsive" src="/uploads/{{ $leave->document_img }}" width="70%" height="70%" alt="Photo">
      </div> --}}
      
    </section>
    @endsection