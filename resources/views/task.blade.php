@extends('layout.master')

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
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12 col-xs-12">
          @if($role != 'Employee')
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Add Task</button>
            <div class="modal fade" id="modal-default">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    {{-- <h4 class="modal-title">Default Modal</h4> --}}
                  </div>
                  <div class="modal-body">
                    <form  method="post" action="/admin/task" enctype="multipart/form-data">
                      @csrf
                      <!-- text input -->
                      <div class="form-group">
                        <label>Tak Name</label>
                        <input type="text" class="form-control" id="task_name" name="task_name" placeholder="Task Name" required>
                        <input type="hidden" class="form-control" id="assign_by" name="assign_by" value="{{Auth::user()->name}}">
                      </div>
                      <div class="form-group">
                        <label for="">Documents</label>
                        <input type="file" class="form-control" name="photos[]" multiple />
                      </div>
                      <div class="form-group">
                        <label>Select Employee</label>
                        <div class="dropdown">
                          <select id="employee_id" name="employee_id" class="form-control" required>
                            <option>::Select::</option>
                              @foreach($users as $user)
                                <option value="{{$user->id}}" >{{$user->name}}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="">Due Date</label>
                        <input type="date" id="due_date" name="due_date" title="Start Due Date" class="form-control" required>
                        <input type="hidden" id="status" name="status" value="To Do">
                      </div>
                      <div class="form-group">
                        <label for="">Select Priority</label>
                        <div class="dropdown">
                          <select id="priority" name="priority" class="form-control" title="Set Priority" required>
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
                        <input type="date" name="start_date" id="start_date" title="Set Start Date" class="form-control" required>
                      </div>
                    <button type="submit" class="btn btn-primary">Save</button>

                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          @endif  
        </div>
        <div class="col-lg-12 col-xs-12">
          <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <!--<div class="box-header">-->
            <!--  <h3 class="box-title">Tasks</h3>-->

            <!--  <div class="box-tools">-->
            <!--    <div class="input-group input-group-sm hidden-xs" style="width: 150px;">-->
            <!--      <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">-->

            <!--      <div class="input-group-btn">-->
            <!--        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->
            <!-- /.box-header -->
            @if(Auth::user()->role =='Team Lead')
            <div class="box-body table-responsive">
              <h2>Team Lead</h2>
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>TASK NAME</th>
                  <th>ASSIGN</th>
                  <th>DUE DATE</th>
                  <th>PRIROTITY</th>
                  <th>STATUS</th>
                  <th width="1">DETAIL</th>
                </tr>
                <?php $id='1'; ?>

                @foreach($tasks as $task)
                  @if(Auth::user()->id == $task->employee_id)
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{$task->task_name}}</td>
                        {{-- {{$task}} --}}
                      @foreach($userss as $user)
                        @if($user->name == $task->assign_by)

                          <td><img src="/uploads/{{$user->employee_img}}" width="25" style="border-radius: 50px;height: 30px" alt="" title="{{$user->name}}"></td>
                        @endif
                      @endforeach 
                      <td>{{$task->due_date}}</td> 
                      <td>{{$task->priority}}</td>  
                      <td>
                        <div class="dropdown ml-20">
                          @if($task->status == 'To Do')
                          <button type="button" class="btn btn-secondary text-uppercase dropdown-toggle" data-toggle="dropdown">
                          @elseif($task->status == 'IN PROGRESS')
                          <button type="button" class="btn btn-primary text-uppercase dropdown-toggle" data-toggle="dropdown">
                          @elseif($task->status == 'COMPLETE')
                          <button type="button" class="btn btn-success text-uppercase dropdown-toggle" data-toggle="dropdown">
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                          <button type="button" class="btn btn-warning text-uppercase dropdown-toggle" data-toggle="dropdown">
                          @endif
                          @if($task->status == 'To Do')
                            <span class="label label-default">{{$task->status}}</span>
                          @elseif($task->status == 'IN PROGRESS')
                            <span class="label label-primary">{{$task->status}}</span>
                          @elseif($task->status == 'COMPLETE')
                            <span class="label label-success">{{$task->status}}</span>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <span class="label label-warning">{{$task->status}}</span>
                          @endif  
                          </button>
                            <ul class="dropdown-menu">
                          @if($task->status == 'To Do')
                            <li><a class="dropdown-item" href="/task/status?status=IN PROGRESS&id={{$task->employee_id}}">IN PROGRESS</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=CLIENT SIDE PENDING&id={{$task->employee_id}}">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=COMPLETE&id={{$task->employee_id}}">COMPLETE</a></li>
                          @elseif($task->status == 'IN PROGRESS')
                            <li><a class="dropdown-item" href="/task/status?status=To Do&id={{$task->employee_id}}">To Do</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=CLIENT SIDE PENDING&id={{$task->employee_id}}">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=COMPLETE&id={{$task->employee_id}}">COMPLETE</a></li>
                          @elseif($task->status == 'COMPLETE')
                            <li><a class="dropdown-item" href="/task/status?status=To Do&id={{$task->employee_id}}">To Do</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=CLIENT SIDE PENDING&id={{$task->employee_id}}">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=IN PROGRESS&id={{$task->employee_id}}">IN PROGRESS</a></li>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <li><a class="dropdown-item" href="/task/status?status=To Do&id={{$task->employee_id}}">To Do</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=COMPLETE&id={{$task->employee_id}}">COMPLETE</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=IN PROGRESS&id={{$task->employee_id}}">IN PROGRESS</a></li> 
                          @endif
                          </ul>
                        </div>
                      </td>
                      <td>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#message<?php echo $task->id?>">Show</button>
                        <div id="message<?php echo $task->id ?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                              </div>
                              <div class="modal-body">
                                <label for="">Task Name</label>
                                <?php echo $task->task_name?>
                                <hr>
                                <label for="">Description</label>
                                <?php echo $task->description?>
                                <hr>
                                <label for="">Documents</label>
                                <?php //print_r($tasksDetail) ?>
                                @foreach($tasksDetail as $img => $value)
                                @if($task->id == $value->task_id)
                                <?php //print_r($value['filename']) ?>
                                <img src="{{$value->filename}}" alt="">
                                @endif
                                @endforeach
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>
                      </td>
                    </tr>
                  @endif
                @endforeach  
              </table>
            </div>
            @endif
            <hr>
            <div class="box-body table-responsive">
              <h2>Employee</h2>
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>TASK NAME</th>
                  <th>ASSIGN</th>
                  <th>DUE DATE</th>
                  <th>PRIROTITY</th>
                  <th>STATUS</th>
                  <th width="1">DETAIL</th>
                </tr>
                <?php $id='1'; ?>
                @foreach($tasks as $task)
                  @if(Auth::user()->name == $task->assign_by && Auth::user()->admin == '0')
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{$task->task_name}}</td>
                      @foreach($userss as $user)
                        @if($user->name == $task->assign_by)
                          <td><img src="/uploads/{{$user->employee_img}}" width="25" style="border-radius: 50px;height: 30px" alt="" title="{{$user->name}}"></td>
                        @endif
                      @endforeach 
                      <td>{{$task->due_date}}</td> 
                      <td>{{$task->priority}}</td>  
                      <td>
                        <div class="dropdown ml-20">
                          @if($task->status == 'To Do')
                          <button type="button" class="btn btn-secondary text-uppercase dropdown-toggle" data-toggle="dropdown">
                          @elseif($task->status == 'IN PROGRESS')
                          <button type="button" class="btn btn-primary text-uppercase dropdown-toggle" data-toggle="dropdown">
                          @elseif($task->status == 'COMPLETE')
                          <button type="button" class="btn btn-success text-uppercase dropdown-toggle" data-toggle="dropdown">
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                          <button type="button" class="btn btn-warning text-uppercase dropdown-toggle" data-toggle="dropdown">
                          @endif
                          @if($task->status == 'To Do')
                            <span class="label label-default">{{$task->status}}</span>
                          @elseif($task->status == 'IN PROGRESS')
                            <span class="label label-primary">{{$task->status}}</span>
                          @elseif($task->status == 'COMPLETE')
                            <span class="label label-success">{{$task->status}}</span>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <span class="label label-warning">{{$task->status}}</span>
                          @endif  
                          </button>
                            <ul class="dropdown-menu">
                          @if($task->status == 'To Do')
                            <li><a class="dropdown-item" href="/task/status?status=IN PROGRESS&id={{$task->id}}">IN PROGRESS</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=COMPLETE&id={{$task->id}}">COMPLETE</a></li>
                          @elseif($task->status == 'IN PROGRESS')
                            <li><a class="dropdown-item" href="/task/status?status=To Do&id={{$task->id}}">To Do</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=COMPLETE&id={{$task->id}}">COMPLETE</a></li>
                          @elseif($task->status == 'COMPLETE')
                            <li><a class="dropdown-item" href="/task/status?status=To Do&id={{$task->id}}">To Do</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=IN PROGRESS&id={{$task->id}}">IN PROGRESS</a></li>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <li><a class="dropdown-item" href="/task/status?status=To Do&id={{$task->id}}">To Do</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=COMPLETE&id={{$task->id}}">COMPLETE</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=IN PROGRESS&id={{$task->id}}">IN PROGRESS</a></li> 
                          @endif
                          </ul>
                        </div>
                      </td>
                      <td>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#message<?php echo $task->id?>">Show</button>
                        <div id="message<?php echo $task->id ?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                              </div>
                              <div class="modal-body">
                                <label for="">Task Name</label>
                                <?php echo $task->task_name?>
                                <hr>
                                <label for="">Description</label>
                                <?php echo $task->description?>
                                <hr>
                                <label for="">Documents</label>
                                <?php //print_r($tasksDetail) ?>
                                @foreach($tasksDetail as $img => $value)
                                @if($task->id == $value->task_id)
                                <?php //print_r($value['filename']) ?>
                                <img src="{{$value->filename}}" alt="">
                                @endif
                                @endforeach
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>
                      </td>
                    </tr>
                  @endif
                @endforeach
                @if(Auth::user()->role == 'Employee')
                @foreach($tasks as $task)
                  @if(Auth::user()->id == $task->employee_id)
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{$task->task_name}}</td>
                      @foreach($userss as $user)
                        @if($user->name == $task->assign_by)
                          <td><img src="/uploads/{{$user->employee_img}}" width="25" style="border-radius: 50px;height: 30px" alt="" title="{{$user->name}}"></td>
                        @endif
                      @endforeach 
                      <td>{{$task->due_date}}</td> 
                      <td>{{$task->priority}}</td>  
                      <td>
                        <div class="dropdown ml-20">
                          @if($task->status == 'To Do')
                          <button type="button" class="btn btn-secondary text-uppercase dropdown-toggle" data-toggle="dropdown">
                          @elseif($task->status == 'IN PROGRESS')
                          <button type="button" class="btn btn-primary text-uppercase dropdown-toggle" data-toggle="dropdown">
                          @elseif($task->status == 'COMPLETE')
                          <button type="button" class="btn btn-success text-uppercase dropdown-toggle" data-toggle="dropdown">
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                          <button type="button" class="btn btn-warning text-uppercase dropdown-toggle" data-toggle="dropdown">
                          @endif
                          @if($task->status == 'To Do')
                            <span class="label label-default">{{$task->status}}</span>
                          @elseif($task->status == 'IN PROGRESS')
                            <span class="label label-primary">{{$task->status}}</span>
                          @elseif($task->status == 'COMPLETE')
                            <span class="label label-success">{{$task->status}}</span>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <span class="label label-warning">{{$task->status}}</span>
                          @endif  
                          </button>
                            <ul class="dropdown-menu">
                          @if($task->status == 'To Do')
                            <li><a class="dropdown-item" href="/task/status?status=IN PROGRESS&id={{$task->id}}">IN PROGRESS</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=COMPLETE&id={{$task->id}}">COMPLETE</a></li>
                          @elseif($task->status == 'IN PROGRESS')
                            <li><a class="dropdown-item" href="/task/status?status=To Do&id={{$task->id}}">To Do</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=COMPLETE&id={{$task->id}}">COMPLETE</a></li>
                          @elseif($task->status == 'COMPLETE')
                            <li><a class="dropdown-item" href="/task/status?status=To Do&id={{$task->id}}">To Do</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=IN PROGRESS&id={{$task->id}}">IN PROGRESS</a></li>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <li><a class="dropdown-item" href="/task/status?status=To Do&id={{$task->id}}">To Do</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=COMPLETE&id={{$task->id}}">COMPLETE</a></li>
                            <li><a class="dropdown-item" href="/task/status?status=IN PROGRESS&id={{$task->id}}">IN PROGRESS</a></li> 
                          @endif
                          </ul>
                        </div>
                      </td>
                      <td>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#message<?php echo $task->id?>">Show</button>
                        <div id="message<?php echo $task->id ?>" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Modal Header</h4>
                              </div>
                              <div class="modal-body">
                                <label for="">Task Name</label>
                                <?php echo $task->task_name?>
                                <hr>
                                <label for="">Description</label>
                                <?php echo $task->description?>
                                <hr>
                                <label for="">Documents</label>
                                <?php //print_r($tasksDetail) ?>
                                @foreach($tasksDetail as $img => $value)
                                @if($task->id == $value->task_id)
                                <?php //print_r($value['filename']) ?>
                                <img src="{{$value->filename}}" alt="">
                                @endif
                                @endforeach
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>
                      </td>
                    </tr>
                  @endif
                @endforeach  
                  @endif
              </table>
            </div>
          </div>
        </div>
      </div>
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