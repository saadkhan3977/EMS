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
                              @foreach($userss as $user)
                              @if(auth::user()->name != $user->name)
                                <option value="{{$user->id}}" >{{$user->name}}</option>
                                @endif
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
                      <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="description" class="form-control" required></textarea>
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
        </div>
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
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'IN PROGRESS')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'COMPLETE')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li> 
                          @endif
                          </ul>
                        </div>
                      </td>
                      <td>
                        <a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>
                      </td>
                    </tr>
                  @endif
                @endforeach  
              </table>
            </div>
            <br><hr>
            <div class="box-body table-responsive no-padding" style="height: 200px">
              <h2>Employee</h2>
              <h3><b>To Do Task</b></h3>
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
                  @if(Auth::user()->name == $task->assign_by)
                  @if($task->status == 'To Do')
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
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'IN PROGRESS')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'COMPLETE')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li> 
                          @endif
                          </ul>
                        </div>
                    </td>
                    @if(Auth::user()->name == $task->assign_by)
                        <td style="width:150px;">
                            <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="/admin/taskedit/{{$task->id}}">Edit</a></li>
                              <li><a href="/admin/taskdetail/{{$task->id}}">Show</a></li>
                              <!--<li><a href="/admin/taskdelete/{{$task->id}}">Delete</a></li>-->
                            </ul>
                          </div>
                        <!--    <a class="btn btn-success" href="/admin/taskedit/{{$task->id}}">Edit</a>-->
                        <!--<a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>-->
                        </td>
                    @else
                        <td>
                        <a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>
                        </td>
                    @endif
                    </tr>
                    @endif
                  @endif
                @endforeach  
              </table>
            </div>
            <br><hr>
            <div class="box-body table-responsive no-padding" style="height: 200px">
              <h3><b>In Progress Task</b></h3>
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
                  @if(Auth::user()->name == $task->assign_by)
                  @if($task->status == 'IN PROGRESS')
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
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'IN PROGRESS')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'COMPLETE')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li> 
                          @endif
                          </ul>
                        </div>
                      </td>
                      @if(Auth::user()->name == $task->assign_by)
                        <td style="width:150px;">
                            <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="/admin/taskedit/{{$task->id}}">Edit</a></li>
                              <li><a href="/admin/taskdetail/{{$task->id}}">Show</a></li>
                              <!--<li><a href="/admin/taskdelete/{{$task->id}}">Delete</a></li>-->
                            </ul>
                          </div>
                        <!--    <a class="btn btn-success" href="/admin/taskedit/{{$task->id}}">Edit</a>-->
                        <!--<a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>-->
                        </td>
                    @else
                        <td>
                        <a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>
                        </td>
                    @endif
                    </tr>
                    @endif
                  @endif
                @endforeach  
              </table>
            </div>
            <br><hr>
            <div class="box-body table-responsive no-padding" style="height: 200px">
              <h3><b>Complete Task</b></h3>
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
                  @if(Auth::user()->name == $task->assign_by)
                  @if($task->status == 'COMPLETE')
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
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'IN PROGRESS')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'COMPLETE')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li> 
                          @endif
                          </ul>
                        </div>
                      </td>
                      @if(Auth::user()->name == $task->assign_by)
                        <td style="width:150px;">
                            <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="/admin/taskedit/{{$task->id}}">Edit</a></li>
                              <li><a href="/admin/taskdetail/{{$task->id}}">Show</a></li>
                              <!--<li><a href="/admin/taskdelete/{{$task->id}}">Delete</a></li>-->
                            </ul>
                          </div>
                        <!--    <a class="btn btn-success" href="/admin/taskedit/{{$task->id}}">Edit</a>-->
                        <!--<a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>-->
                        </td>
                    @else
                        <td>
                        <a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>
                        </td>
                    @endif
                    </tr>
                    @endif
                  @endif
                @endforeach  
              </table>
            </div>
            <br><hr>
            <div class="box-body table-responsive no-padding" style="height: 200px">
              <h3><b>CLIENT SIDE PENDING Task</b></h3>
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
                  @if(Auth::user()->name == $task->assign_by)
                  @if($task->status == 'CLIENT SIDE PENDING')
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
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'IN PROGRESS')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'COMPLETE')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li> 
                          @endif
                          </ul>
                        </div>
                      </td>
                      @if(Auth::user()->name == $task->assign_by)
                        <td style="width:150px;">
                            <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="/admin/taskedit/{{$task->id}}">Edit</a></li>
                              <li><a href="/admin/taskdetail/{{$task->id}}">Show</a></li>
                              <!--<li><a href="/admin/taskdelete/{{$task->id}}">Delete</a></li>-->
                            </ul>
                          </div>
                        <!--    <a class="btn btn-success" href="/admin/taskedit/{{$task->id}}">Edit</a>-->
                        <!--<a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>-->
                        </td>
                    @else
                        <td>
                        <a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>
                        </td>
                    @endif
                    </tr>
                    @endif
                  @endif
                @endforeach  
              </table>
            </div>
            @else
            <hr>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding" style="max-height:200px;
        overflow-y:auto;">
              <table class="table table-hover">
                <tr>
                  <th width="1">ID</th>
                  <th style="width: 150px">TASK NAME</th>
                  <th style="width: 80px">ASSIGN</th>
                  <th style="width: 100px">DUE DATE</th>
                  <th style="width: 100px">PRIROTITY</th>
                  <th style="width: 200px">Description</th>
                  <th style="width: 70px">STATUS</th>
                  <th width="1">DETAIL</th>
                </tr>
                <?php $id='1'; ?>
                @foreach($tasks as $task)
                @if($task->status =='COMPLETE')
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{$task->task_name}}</td>
                          <td>
                      @foreach($userss as $user)
                        @if($user->name == $task->assign_by)
                            <img src="/uploads/{{$user->employee_img}}" width="25" style="border-radius: 50px;height: 30px" alt="" title="{{$user->name}}">
                          @endif
                          @if($task->employee_id == $user->id)
                          <img src="/uploads/{{$user->employee_img}}" width="25" style="border-radius: 50px;height: 30px " alt="" title="{{$user->name}}">
                        @endif
                      @endforeach 
                        </td>
                      <td>{{$task->due_date}}</td> 
                      <td>{{$task->priority}}</td>  
                      <td>{{$task->description}}</td>  
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
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=admin">IN PROGRESS</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=admin">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=admin">COMPLETE</a></li>
                          @elseif($task->status == 'IN PROGRESS')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=admin">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=admin">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=admin">COMPLETE</a></li>
                          @elseif($task->status == 'COMPLETE')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=admin">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=admin">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=admin">IN PROGRESS</a></li>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=admin">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=admin">COMPLETE</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=admin">IN PROGRESS</a></li> 
                          @endif
                          </ul>
                        </div>
                      </td>
                      @if(Auth::user()->name == $task->assign_by)
                        <td style="width:150px;">
                            <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="/admin/taskedit/{{$task->id}}">Edit</a></li>
                              <li><a href="/admin/taskdetail/{{$task->id}}">Show</a></li>
                              <!--<li><a href="/admin/taskdelete/{{$task->id}}">Delete</a></li>-->
                            </ul>
                          </div>
                        <!--    <a class="btn btn-success" href="/admin/taskedit/{{$task->id}}">Edit</a>-->
                        <!--<a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>-->
                        </td>
                    @else
                        <td>
                        <a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>
                        </td>
                    @endif
                    </tr>
                    @endif
                @endforeach  
              </table>
            </div>
            @endif
            <br><hr>
            <div class="box-body table-responsive no-padding" style="height: 200px">
              <h3><b>CLIENT SIDE PENDING Task</b></h3>
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>TASK NAME</th>
                  <th>ASSIGN</th>
                  <th>DUE DATE</th>
                  <th>PRIROTITY</th>
                  <th>DESCRIPTION</th>
                  <th>STATUS</th>
                  <th width="1">DETAIL</th>
                </tr>
                <?php $id='1'; ?>

                @foreach($tasks as $task)
                  @if($task->status == 'CLIENT SIDE PENDING')
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{$task->task_name}}</td>
                        {{-- {{$task}} --}}
                      <td>
                        @foreach($userss as $user)
                        @if($user->name == $task->assign_by)
                            <img src="/uploads/{{$user->employee_img}}" width="25" style="border-radius: 50px;height: 30px" alt="" title="{{$user->name}}">
                          @endif
                          @if($task->employee_id == $user->id)
                          <img src="/uploads/{{$user->employee_img}}" width="25" style="border-radius: 50px;height: 30px " alt="" title="{{$user->name}}">
                        @endif
                      @endforeach 
                      </td>
                      <td>{{$task->due_date}}</td> 
                      <td>{{$task->priority}}</td>  
                      <td>{{$task->description}}</td>  
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
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'IN PROGRESS')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'COMPLETE')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li> 
                          @endif
                          </ul>
                        </div>
                      </td>
                      @if(Auth::user()->name == $task->assign_by)
                        <td style="width:150px;">
                            <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="/admin/taskedit/{{$task->id}}">Edit</a></li>
                              <li><a href="/admin/taskdetail/{{$task->id}}">Show</a></li>
                              <!--<li><a href="/admin/taskdelete/{{$task->id}}">Delete</a></li>-->
                            </ul>
                          </div>
                        <!--    <a class="btn btn-success" href="/admin/taskedit/{{$task->id}}">Edit</a>-->
                        <!--<a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>-->
                        </td>
                    @else
                        <td>
                        <a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>
                        </td>
                    @endif
                    </tr>
                  @endif
                @endforeach  
              </table>
            </div>
              {{-- CLient SIde Task --}}
            <br><hr>
            <div class="box-body table-responsive no-padding" style="height: 200px">
              <h3><b>In Progress Task</b></h3>
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>TASK NAME</th>
                  <th>ASSIGN</th>
                  <th>DUE DATE</th>
                  <th>PRIROTITY</th>
                  <th>DESCRIPTION</th>
                  <th>STATUS</th>
                  <th width="1">DETAIL</th>
                </tr>
                <?php $id='1'; ?>

                @foreach($tasks as $task)
                  @if($task->status == 'IN PROGRESS')
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{$task->task_name}}</td>
                        {{-- {{$task}} --}}
                      <td>
                        @foreach($userss as $user)
                        @if($task->employee_id == $user->id)
                        <img src="/uploads/{{$user->employee_img}}" width="25" style="border-radius: 50px;height: 30px " alt="" title="{{$user->name}}">
                        @endif
                        @if($user->name == $task->assign_by)
                            <img src="/uploads/{{$user->employee_img}}" width="25" style="border-radius: 50px;height: 30px" alt="" title="{{$user->name}}">
                          @endif
                      @endforeach 
                      </td>
                      <td>{{$task->due_date}}</td> 
                      <td>{{$task->priority}}</td>  
                      <td>{{$task->description}}</td>  
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
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'IN PROGRESS')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'COMPLETE')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li> 
                          @endif
                          </ul>
                        </div>
                      </td>
                      @if(Auth::user()->name == $task->assign_by)
                        <td style="width:150px;">
                            <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="/admin/taskedit/{{$task->id}}">Edit</a></li>
                              <li><a href="/admin/taskdetail/{{$task->id}}">Show</a></li>
                              <!--<li><a href="/admin/taskdelete/{{$task->id}}">Delete</a></li>-->
                            </ul>
                          </div>
                        <!--    <a class="btn btn-success" href="/admin/taskedit/{{$task->id}}">Edit</a>-->
                        <!--<a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>-->
                        </td>
                    @else
                        <td>
                        <a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>
                        </td>
                    @endif
                    </tr>
                  @endif
                @endforeach  
              </table>
            </div>
              {{-- In Progress Task --}}  
            <br><hr>
            <div class="box-body table-responsive no-padding" style="height: 200px">
              <h3><b>To Do Task</b></h3>
              <table id="dataTable" class="table table-bordered" data-show-columns="true">
                <tr>
                  <th>ID</th>
                  <th>TASK NAME</th>
                  <th>ASSIGN</th>
                  <th>DUE DATE</th>
                  <th>PRIROTITY</th>
                  <th>DESCRIPTION</th>
                  <th>STATUS</th>
                  <th width="1">DETAIL</th>
                </tr>
                <?php $id='1'; ?>

                @foreach($tasks as $task)
                  @if($task->status == 'To Do')
                    <tr>
                      <td>{{$id++}}</td>
                      <td>{{$task->task_name}}</td>
                        {{-- {{$task}} --}}
                      <td>
                        @foreach($userss as $user)
                        @if($user->name == $task->assign_by)
                            <img src="/uploads/{{$user->employee_img}}" width="25" style="border-radius: 50px;height: 30px" alt="" title="{{$user->name}}">
                          @endif
                          @if($task->employee_id == $user->id)
                          <img src="/uploads/{{$user->employee_img}}" width="25" style="border-radius: 50px;height: 30px " alt="" title="{{$user->name}}">
                        @endif
                      @endforeach 
                      </td> 
                      <td>{{$task->due_date}}</td> 
                      <td>{{$task->priority}}</td>  
                      <td>{{$task->description}}</td>  
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
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'IN PROGRESS')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                          @elseif($task->status == 'COMPLETE')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=CLIENT SIDE PENDING&id={{$task->id}}&role=user">CLIENT SIDE PENDING</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li>
                          @elseif($task->status == 'CLIENT SIDE PENDING')
                            <li><a class="dropdown-item" href="/admin/task/status?status=To Do&id={{$task->id}}&role=user">To Do</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=COMPLETE&id={{$task->id}}&role=user">COMPLETE</a></li>
                            <li><a class="dropdown-item" href="/admin/task/status?status=IN PROGRESS&id={{$task->id}}&role=user">IN PROGRESS</a></li> 
                          @endif
                          </ul>
                        </div>
                      </td>
                      @if(Auth::user()->name == $task->assign_by)
                        <td style="width:150px;">
                            <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                              <li><a href="/admin/taskedit/{{$task->id}}">Edit</a></li>
                              <li><a href="/admin/taskdetail/{{$task->id}}">Show</a></li>
                              <!--<li><a href="/admin/taskdelete/{{$task->id}}">Delete</a></li>-->
                            </ul>
                          </div>
                        <!--    <a class="btn btn-success" href="/admin/taskedit/{{$task->id}}">Edit</a>-->
                        <!--<a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>-->
                        </td>
                    @else
                        <td>
                        <a class="btn btn-success" href="/admin/taskdetail/{{$task->id}}">Show</a>
                        </td>
                    @endif
                    </tr>
                  @endif
                @endforeach  
              </table>
            </div>
              {{-- CLient SIde Task --}}  
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