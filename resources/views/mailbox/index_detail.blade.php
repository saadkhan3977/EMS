@extends('layout.master')

@section('main-content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Read Mail
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
          <a href="{{ url('/mailbox/create') }}" class="btn btn-primary btn-block margin-bottom">Compose</a>

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
                <li><a href="{{ url('mailbox') }}"><i class="fa fa-inbox"></i> Inbox
                  <span class="label label-primary pull-right">{{ $totalinbox }}</span></a></li>
                <li><a href="{{ url('mailbox/sent') }}"><i class="fa fa-envelope-o"></i>
                  <span class="label label-success pull-right">{{ $totalsend }}</span> Sent</a></li>
                <li><a href="{{ url('mailbox/trash') }}"><i class="fa fa-trash-o"></i> 
                  <span class="label label-danger pull-right">{{ $totaltrash }}</span>Trash</a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Read Mail</h3>

              <div class="box-tools pull-right">
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="mailbox-controls with-border">
                <div class="btn-group">
                  <button type="button" class="btn btn-default btn-sm delete" data-id="{{$details->id}}" data-toggle="tooltip" data-container="body" title="Delete">
                    <i class="fa fa-trash-o"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Reply">
                    <i class="fa fa-reply"></i></button>
                  <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="Forward">
                    <i class="fa fa-share"></i></button>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print">
                  <i class="fa fa-print"></i></button>
              </div>
              @if(!empty($reply_from))
              <div class="mailbox-read-info">
                <h3><b>Subject:</b> {{ $reply_from->subject }}</h3>
                <p><b>Message:</b> {{$reply_from->message}}</p><hr>
                <h3><b>Reply From:-</b>{{$reply_from->to}}</h3>
              </div>
              @endif

              <div class="mailbox-read-info">
                <h3>{{ $details->subject }}</h3>
                <h5>From: {{ $details->from }}

                  {{-- {{dd($details->subject)}} --}}
                  {{-- <span class="mailbox-read-time pull-right">{{ $details->created_at }}</span></h5> --}}
              </div>
              <!-- /.mailbox-read-info -->
              <!-- /.mailbox-controls -->
              <div class="mailbox-read-message">
                <p>{!! $details->message !!}</p>
              </div>
              <!-- /.mailbox-read-message -->
            </div>
            <!-- /.box-body -->
            {{-- @if(!empty($details->attachment)) --}}
            {{-- <h3>No record found</h3> --}}
            {{-- @else --}}
              <div class="box-footer">
                <ul class="mailbox-attachments clearfix">
                  {{-- @foreach($attachments as $attachment) --}}

                  {{-- {{ dd($attachment) }} --}}
                    <li>
                      <?php $type =  substr($details->attachment,-4);?>
                      @if(!empty($type))
                      @if($type != '.mp4')

                      <img id="myImg1" class="profile-user-img img-responsive" style="width: 200px;height: 200px" src="/uploads/{{ $details->attachment }}">
                      <div id="myModal1" class="modal">
                        <span class="close" style="margin-top:50px; ">&times;</span>

                        <!-- Modal Content (The Image) -->
                        <img class="modal-content" id="img011" style="width: 100%;" >

                        <!-- Modal Caption (Image Text) -->
                        <div id="caption1"></div>
                      </div>
                      @else
                      <video width="320" height="240" controls>
                        <source id="myImg1" src="/uploads/{{ $details->attachment }}" type="video/mp4">
                      </video>
                      @endif
                      @endif
                    </li>
                  {{-- @endforeach --}}
                </ul>
              </div>

            {{-- @endif --}}
            

            <div id="myDIV" style="border: 1px solid gray;border-radius: 10px; display: none;">
              <form name="formAdd" id="formAdd" method="POST" action="{{ url('/mailbox/farward') }}" enctype="multipart/form-data">
          @csrf
          
          <div class="col-md-9">
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="from"> From</label>

                  <input type="email" readonly name="from" id="from" class="form-control" placeholder="From:" value="{{ $details->to }}">
                </div>
                <div class="form-group">
                  <label for="select">Selecet User Email</label><br>
                  <select class="selectpicker select2" name="to[]" id="to" multiple data-live-search="true" style="width: 100%;">
                    @foreach($users as $user)
                      <option value="{{$user->email}}" >{{$user->email}}</option>
                    @endforeach
                  </select>
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                     $('select').selectpicker();
                    });
                </script>
                <div class="form-group">
                  <label for="subject"> Subject</label>
                  <input name="subject" id="subject" class="form-control" value="{{ $details->subject }}">
                </div>
                <div class="form-group">
                      <textarea id="compose-textarea" name="compose-textarea" class="form-control" style="height: 100px">{!! $details->message !!}</textarea>
                </div>
                <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fa fa-paperclip"></i> Attachment
                    <input name="attachment" value="{{ $details->attachment }}">
                      <img id="myImg1" class="profile-user-img img-responsive" style="width: 200px;height: 200px" src="/uploads/{{ $details->attachment }}">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-right">
                  <button type="button" class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                  <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                </div>
                <button type="reset" class="btn btn-default" onclick="farward()"><i class="fa fa-times"></i> Discard</button>
              </div>
            <!-- /. box -->
          </div>
        <!-- /.col -->
        </form>
            </div>
            <div id="myDIV1" style="border: 1px solid gray;border-radius: 10px; display: none;">
                    <form name="formAdd" id="formAdd" method="POST" action="{{ url('/mailbox/reply') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="col-md-9">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="form-group">
                        {{-- <label for="from"> From</label> --}}

                        <input type="hidden" name="from" id="from" class="form-control" placeholder="From:" value="{{ $details->to }}">
                      </div>
                      <div class="form-group">
                        {{-- <label for="to"> To</label> --}}
                        <input type="hidden" name="to[]" id="to" class="form-control" value="{{$details->from}}">
                        <input type="hidden" name="status" id="status" class="form-control" value="reply">
                  <input type="hidden" name="reply_id" id="reply_id" class="form-control" value="{{$details->id}}">
                        
                        {{-- <div id="result"></div> --}}
                      </div>
                      <div class="form-group">
                        <label for="subject"> Subject</label>
                        <input name="subject" id="subject" readonly="" class="form-control" value="{{ $details->subject }}">
                      </div>
                      <div class="form-group">
                            <textarea id="compose-textarea" name="compose-textarea" class="form-control" style="height: 100px"></textarea>
                      </div>
                      <div class="form-group">
                        <div class="btn btn-default btn-file">
                          <i class="fa fa-paperclip"></i> Attachment
                          <input type="file" name="attachment">
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
                      <button type="reset" class="btn btn-default" onclick="reply()"><i class="fa fa-times"></i> Discard</button>
                    </div>
                  <!-- /. box -->
                </div>
              <!-- /.col -->
              </form>
            </div>
              <!-- /.col -->
              </form>
            </div>
            <!-- /.box-footer -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-default" onclick="reply()"><i class="fa fa-reply"></i> Reply</button>
                <button class="btn btn-default" onclick="farward()"><i class="fa fa-share"></i> Forward</button>
              </div>
              {{-- <button type="button" class="btn btn-default delete" data-id="{{$details->id}}"><i class="fa fa-trash-o"></i> Delete</button> --}}
              {{-- <button type="button" class="btn btn-default"><i class="fa fa-print printMe"></i> Print</button> --}}
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<script type="text/javascript">
  $(document).on("click", ".delete" , function() {
    var url = window.location.href;
    // alert(url);
  var delete_id = $(this).data('id');
  var el = this;
  var check = confirm("Are you sure you want to delete this row?");
  if(check == true){

    if(url == 'http://management_system.test/mailbox/'+delete_id+'/index_detail'){
      $.ajax({
        url: '/deletemail/'+delete_id,
        type: 'get',
        success: function(response){
          location.replace("http://management_system.test/mailbox")
        }
      });
    }

    if(url == 'http://management_system.test/mailbox/'+delete_id+'/sent_detail'){
      $.ajax({
        url: '/deletsentemail/'+delete_id,
        type: 'get',
        success: function(response){
          // $(el).closest( "tr" ).remove();
          // alert(response);
          location.replace("http://management_system.test/mailbox")
        }
      });
    }
  }
});

  function farward() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

function reply() {
  var x = document.getElementById("myDIV1");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}

$('.printMe').click(function(){
     $("#outprint").print();
});
</script>
@endsection