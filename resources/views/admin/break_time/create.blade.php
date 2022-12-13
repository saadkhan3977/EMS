@extends('admin.layout.master')

@section('page-title')
Create Time Schedule
@endsection

@section('main-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Create Time Schedule
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
    <form name="formAdd" id="formAdd" method="POST" action="/admin/breaktimes" enctype="multipart/form-data">
      @csrf
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">

          <!-- row start -->
          <div class="row">
            <div class="col-xs-12">
              {{-- <div class="form-group">
                <label>Departments <span class="text text-red">*</span></label>
                <select name="departments" id="departments" class="form-control select2" style="width: 100%;">
                  <option value="none">-- Select departments --</option>
                  @foreach($departments as $department)
                  <option value="{{ $department->departments }}">{{ $department->departments }}</option>
                  @endforeach
                </select>
                <span class="text-danger"></span>
              </div> --}}
                <div class="form-group {{ $errors->has('break_time') ? 'has-error' : null }}">
                  <label for="break_time">Break Time <span class="text text-red">*</span></label>
                  <input type="text" name="break_time" class="form-control" id="break_time" placeholder="Time Schedule">
                  <span class="text-danger">{{-- {{ $errors->first('full_name') }} --}}</span>
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