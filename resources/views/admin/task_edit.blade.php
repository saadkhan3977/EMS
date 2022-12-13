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
        Task
        <small>Control panel</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-12 col-xs-12">
                    <form  method="post" action="/admin/taskupdate/{{$task->id}}" enctype="multipart/form-data">
                      @csrf
                      {{ method_field('put') }}
                      <!-- text input -->
                      <div class="form-group">
                        <label>Tak Name</label>
                        <input type="text" class="form-control" id="task_name" name="task_name" placeholder="Task Name" value="{{$task->task_name}}" required="">
                        <input type="hidden" class="form-control" id="assign_by" name="assign_by" value="{{Auth::user()->name}}">
                      </div>
                      <div class="form-group">
                        <label for="">Documents / {{$task->photos}}</label>
                        <input type="file" class="form-control" value="{{$task->photos}}" name="photos[]" multiple / required="">
                      </div>
                      <div class="form-group">
                        <label>Select Employee</label>
                        <div class="dropdown">
                          <select id="employee_id" name="employee_id" class="form-control" required="">
                              <option>::Select Employee::</option>
                              @foreach($users as $user)
                              <!--@if($task->employee_id == $user->id)-->
                              <!--<option value="{{$task->employee_id}}">{{$user->name}}</option>-->
                              <!--@endif-->
                                <option value="{{$user->id}}" >{{$user->name}}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="">Due Date</label>
                        <input type="date" id="due_date" name="due_date" title="Start Due Date" class="form-control" value="{{$task->due_date}}" required>
                        <input type="hidden" id="status" name="status" value="To Do">
                      </div>
                      <div class="form-group">
                        <label for="">Select Priority</label>
                        <div class="dropdown">
                          <select id="priority" name="priority" class="form-control" title="Set Priority" required="">
                              <option>::Select Priority::</option>
                              <option value="none">None</option>
                              <option value="urgent">Urgent</option>
                              <option value="heigh">Heigh</option>
                              <option value="normal">Normal</option>
                              <option value="low">Low</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="">Start Date</label>
                        <input type="date" name="start_date" id="start_date" title="Set Start Date" value="{{$task->start_date}}" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="description" class="form-control" value="{{$task->description}}" required></textarea>
                      </div>
                    <button type="submit" class="btn btn-primary">Save</button>

                    </form>
                  
      </div>
    </div>
        <!-- ./col -->
      
      <!-- /.row -->
      <script type="text/javascript">
        function myFunction() {
          var x = document.getElementById("myDIV");
          var y = document.getElementById("cancel");
          if (x.style.display === "none") {
            x.style.display = "block";
            y.style.display = "block";
          }
        }
        function myFunctionhide() {
          var x = document.getElementById("myDIV");
          var y = document.getElementById("cancel");
            x.style.display = "none";
            y.style.display = "none";
        }
      </script>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection