@extends('admin.layout.master')

@section('page-title')
  Task Detail
@endsection

@section('main-content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Task
        <small>Control panel</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12 col-xs-12">
          <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Complete Tasks</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
        <div class="col-md-12">
	        <div class="col-md-3"><h4><b>1) Task Name</b> | {{$task->task_name}}</h4></div>
	        <div class="col-md-3"><h4><b>2) Due Date</b> | {{$task->due_date}}</h4></div>
	        <div class="col-md-2"><h4><b>3) Priority</b> | {{$task->priority}}</h4></div>
	        <div class="col-md-4"><h4><b>4) status</b> | 
	        	@if($task->status == 'To Do')
                          <button type="button" class="btn btn-secondary text-uppercase ">To Do</button>
                          @elseif($task->status == 'IN PROGRESS')
                          <button type="button" class="btn btn-primary text-uppercase">IN PROGRESS</button>
                          @elseif($task->status == 'COMPLETE')
                          <button type="button" class="btn btn-success text-uppercase">COMPLETE</button>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                          <button type="button" class="btn btn-warning text-uppercase">CLIENT SIDE PENDING</button>
                          @endif
	        </h4></div>
	        @if(!empty($task->description))
	        <div class="col-md-6"><h4><b>5) Description</b> | {{$task->description}}</h4></div>
	        @endif
	        <br>
	        <br><hr>
	        <label for="">Documents</label>
	        @foreach($tasksDetail as $img => $value)
    	        @if($task->id == $value->task_id)
	                <center><img src="{{substr($value['filename'],1)}}" width="500" alt="" id="{{$value['id']}}" class="click"></center><hr>
                @endif
            @endforeach
            </div>   
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- Painding Task --}}
    

    {{-- To DO Task --}}
    
    {{-- In PRogress Task --}}
    
  </div>
    </section>
    <!-- /.content -->
  </div>
@endsection