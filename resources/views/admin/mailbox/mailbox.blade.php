@extends('admin.layout.master')

@section('main-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Mailbox
        <small>13 new messages</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Mailbox</li>
      </ol>
    </section>
    


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="{{ url('/admin/mailbox/create') }}" class="btn btn-primary btn-block margin-bottom">Compose</a>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>

              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="{{ url('admin/mailbox') }}"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right">{{ $totalinbox }}</span></a></li>
                <li><a href="{{ url('admin/mailbox/sent') }}"><i class="fa fa-envelope-o"></i>
                  <span class="label label-success pull-right">{{ $totalsend }}</span> Sent</a></li>
                <li><a href="{{ url('admin/mailbox/trash') }}"><i class="fa fa-trash-o"></i> 
                  <span class="label label-danger pull-right">{{ $totaltrash }}</span>Trash</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
        <?php $url = url()->current()  ?>
        @if($url == url('/admin/mailbox'))
          <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <input type="checkbox" id="master" class="btn btn-default btn-sm checkbox-toggle">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm delete_all" data-url="{{ url('trashtrue') }}"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
              </div>
              <div class="table-responsive mailbox-messages">
                <table id="dtMaterialDesignExample" class="table table-striped" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th class="th-sm"></th>
                      <th class="th-sm">From</th>
                      <th class="th-sm">Subject/Message</th>
                      <th class="th-sm">Attechment</th>
                      <th class="th-sm">Date</th>
                      {{-- <th>Action</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($mails as $mail)
                    @if($mail->mail_view =='0')
                    <tr style="background-color:#ccc ;color: white ">
                    @else
                    <tr>
                    @endif
                      <td><input type="checkbox" class="sub_chk" data-id="{{$mail->id}}"></td>
                      <td>
                        @if($mail->mail_view =='0')
                        <span style="color: red"><b>New</b> </span>
                        @endif
                        <a href="/admin/mailbox/{{ $mail->id }}/index_detail">{{ $mail->user->name }}</a>
                      </td>
                      <td><b>{{ $mail->subject }}</b> - {{ strip_tags(Illuminate\Support\Str::limit($mail->message, $limit = 40, $end = '...')) }}</td>
                      @if(! $mail->attachment == 'No Attachment Found')
                      <td><i class="fa fa-paperclip"></i></td>
                      @else
                      <td><img src="/uploads/{{$mail->attachment}}" width="50" alt=""></td>
                      @endif
                      <td>{{ $mail->created_at }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        @elseif($url == url('/admin/mailbox/trash'))
          <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Inbox</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
              <?php $true = json_decode($trashes); ?>
              @if($true != NULL)

            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <input type="checkbox" id="master" class="btn btn-default btn-sm checkbox-toggle">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm delete_all" data-url="{{ url('trashfalse') }}">Untrash</button>
                  <button type="button" class="btn btn-default btn-sm delete_all" data-url="{{ url('delete_trash_all') }}"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                  <table class="table table-hover table-striped">
                    <thead>
                    <tr>
                      <th class="th-sm">
                      </th>
                      </th>
                      <th class="th-sm">Subject/Message
                      </th>
                      <th class="th-sm">Status
                      {{-- <th class="th-sm">Attechment --}}
                      </th>
                      <th class="th-sm">Date
                      </th>
                      {{-- <th>Action</th> --}}
                    </tr>
                  </thead>
                    <tbody>
                      @if($trashes)
                      <hr>
                      
                      @foreach($trashes as $trash)
                      <tr>
                        <td><input type="checkbox" class="sub_chk" data-id="{{$trash->id}}"></td>
                        {{-- <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td> --}}
                        {{-- <td class="mailbox-name untrash"><a href="{{ url('trashfalse') }}">{{ $trash['trash'] }}</a></td> --}}
                        <td class="mailbox-subject"><b>{{ $trash['subject'] }}</b> - {{ strip_tags(Illuminate\Support\Str::limit($trash['message'], $limit = 100, $end = '...')) }}
                        <td><button type="button" class="btn btn-default btn-sm delete_all" data-url="{{ url('trashfalse') }}">{{ $trash['trash'] }}</button></td>
                        </td>
                        {{-- @if($trash['attachment'] == true)
                          <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                        @endif --}}
                        <td class="mailbox-date">{{ date('d-m-Y', strtotime($trash['created_at'])) }}</td>
                      </tr>
                      @endforeach
                      @endif
                      </tbody>
                  </table>
              </div>
                  @else
                      <div class="alert alert-danger">Inbox Trash Empty</div>
                      @endif
                </div>
        </div>
        @elseif($url == url('/admin/mailbox/sent'))
          <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Sent</h3>

              <div class="box-tools pull-right">
                <div class="has-feedback">
                  <input type="text" class="form-control input-sm" placeholder="Search Mail">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <input type="checkbox" id="master" class="btn btn-default btn-sm checkbox-toggle">

                {{-- <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button> --}}
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm delete_all" data-url="{{ url('senttrashtrue') }}"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
              <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                  <tbody>
                    <?php 
//            $last_row = DB::table('mailbox')->where('from',Auth::user()->email)->latest()->get();
                     // $mailid = $last_row->id;
    //                  echo "<pre>";
  //                    print_r($last_row);
//            $last_row1 = DB::table('mail_send')->where('mail_id',$mailid)->get();
                    ?>
                    @foreach($sents as $sent)
                    <tr>
                      <td><input type="checkbox" class="sub_chk" data-id="{{$sent->id}}"></td>
                      {{-- <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td> --}}
                      <td class="mailbox-name"><a href="/admin/mailbox/{{ $sent->id }}/sent_detail">To: {{ $sent->to }}</a></td>
                      <td class="mailbox-subject"><b>{{ $sent->subject }}</b> - {{ strip_tags(Illuminate\Support\Str::limit($sent->message, $limit = 40, $end = '...')) }}
                      </td>
                      @if(! $sent->attachment == 'No Attachment Found')
                        <td class="mailbox-attachment"><i class="fa fa-paperclip"></i></td>
                      @endif
                      <td class="mailbox-date">{{ $sent->created_at }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer no-padding">
              <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                <div class="pull-right">
                  1-50/200
                  <div class="btn-group">
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                    <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                  </div>
                  <!-- /.btn-group -->
                </div>
                <!-- /.pull-right -->
              </div>
            </div>
          </div>
          <!-- /. box -->
        </div>

        @elseif($url == url('/admin/mailbox/create'))
        <form name="formAdd" id="formAdd" method="POST" action="{{ route('mailbox.store') }}" enctype="multipart/form-data">
          @csrf
          
          <div class="col-md-9">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Compose New Message</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="select">Selecet User Email</label><br>
                  <select class="selectpicker select2" name="to[]" id="to" multiple data-live-search="true" style="width: 100%;">
                    @foreach($users as $user)
                    @if($user->name != Auth::user()->name)
                      <option value="{{$user->email}}" >{{$user->email}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                     $('select').selectpicker();
                    });
                </script>
                <div class="form-group">
                  <input name="subject" id="subject" class="form-control" placeholder="Subject:">
                </div>
                <div class="form-group">
                      <textarea id="compose-textarea" name="compose-textarea" class="form-control" style="height: 300px"></textarea>
                </div>
                <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <input type="file" name="attachment">
                    <i class="fa fa-paperclip"></i> Attachment
                  </div>
                  <p class="help-block">Max. 32MB</p>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-right">
                  <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
              </div>
              <!-- /.box-footer -->
            </div>
            <!-- /. box -->
          </div>
        <!-- /.col -->
        </form>

        @endif
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <script type="text/javascript">
    $(document).ready(function () {


        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))
         {
            $(".sub_chk").prop('checked', true);
         } else {
            $(".sub_chk").prop('checked',false);
         }
        });


        $('.delete_all').on('click', function(e) {


            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });


            if(allVals.length <=0)
            {
                alert("Please select row.");
            }  else {


                var check = confirm("Are you sure you want to delete this row?");
                if(check == true){


                    var join_selected_values = allVals.join(",");


                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }
            }
        });


        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });


        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();


            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                    alert(data.responseText);
                      
                        // $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });


            return false;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {


        $('#master1').on('click', function(e) {
         if($(this).is(':checked',true))
         {
            $(".sub_chk1").prop('checked', true);
         } else {
            $(".sub_chk1").prop('checked',false);
         }
        });


        $('.delete_all1').on('click', function(e) {


            var allVals = [];
            $(".sub_chk1:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });


            if(allVals.length <=0)
            {
                alert("Please select row.");
            }  else {


                var check = confirm("Are you sure you want to delete this row?");
                if(check == true){


                    var join_selected_values = allVals.join(",");


                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk1:checked").each(function() {
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });


                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                }
            }
        });


        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });


        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();


            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                    alert(data.responseText);
                      
                        // $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });


            return false;
        });
    });
</script>


<script type="text/javascript">
$(document).ready(function () {
  $('#dtMaterialDesignExample').DataTable();
  $('#dtMaterialDesignExample_wrapper').find('label').each(function () {
    $(this).parent().append($(this).children());
  });
  $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('input').each(function () {
    const $this = $(this);
    $this.attr("placeholder", "Search");
    $this.removeClass('form-control-sm');
  });
  $('#dtMaterialDesignExample_wrapper .dataTables_length').addClass('d-flex flex-row');
  $('#dtMaterialDesignExample_wrapper .dataTables_filter').addClass('md-form');
  $('#dtMaterialDesignExample_wrapper select').removeClass(
  'custom-select custom-select-sm form-control form-control-sm');
  $('#dtMaterialDesignExample_wrapper select').addClass('mdb-select');
  $('#dtMaterialDesignExample_wrapper .mdb-select').materialSelect();
  $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('label').remove();
});
</script>
@endsection