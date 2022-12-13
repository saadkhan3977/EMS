@extends('admin.layout.master')

@section('page-title')
Edit Break Time
@endsection

@section('main-content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Edit Time Schedule
    <small>All * field required</small>
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    
    <!-- SELECT2 EXAMPLE -->
    <!-- form start -->
    <form name="formEdit" id="formEdit" method="post" action="/admin/breaktimes/{{ $break_time->id }}" enctype="multipart/form-data">
      {{ csrf_field() }}
      {{ method_field('put') }}
      <div class="box box-primary">
        <!-- /.box-header -->
        <div class="box-body">
          <!-- row start -->
          <div class="row">
            <div class="col-xs-12">
              
              <div class="form-group {{ $errors->has('break_time') ? 'has-error' : null }}">
                <label for="break_time">Break Time <span class="text text-red">*</span></label>
                <input type="text" name="break_time" class="form-control" id="break_time" placeholder="break time" value="{{ $break_time->break_time }}">  
                <span class="text-danger">{{-- {{ $errors->first('departments') }} --}}</span>
              </div>

              
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