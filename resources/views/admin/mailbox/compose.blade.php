@extends('admin.layout.master')

@section('main-content')

<div class="content-wrapper">
  @if (count($errors) > 0)
  <div class="alert alert-danger">
      <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
      <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
      </ul>
  </div>
  @endif

  @if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div> 
  @endif
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
          @if(Auth::user()->admin == '1')
          <a href="{{ url('admin/mailbox') }}" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
          @else
          <a href="{{ url('/mailbox') }}" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
          @endif
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
        </div>
        <!-- /.col -->
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
                  <input type="email" name="to" id="to" class="form-control" placeholder="To:">
      <div id="result"></div>
                </div>


                <script type="text/javascript">
            $(document).ready(function () {
             
                $('#to').on('keyup',function() {
                    var query = $(this).val(); 
                    $.ajax({
                       
                        url:"{{ url('search') }}",
                  
                        type:"GET",
                       
                        data:{'#to':query},
                       
                        success:function (data) {
                          
                            $('#result').html(data);
                        }
                    })
                    // end of ajax call
                });

                
                $(document).on('click', 'li', function(){
                  
                    var value = $(this).text();
                    $('#to').val(value);
                    $('#result').html("");
                });
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
                    <i class="fa fa-paperclip"></i> Attachment
                    <input type="file" name="attachment">
                  </div>
                  <p class="help-block">Max. 32MB</p>
                </div>
                {{-- <div class="input-group hdtuto control-group lst increment" >
                  <input type="file" name="filenames[]" class="myfrm form-control" multiple>
                  <div class="input-group-btn"> 
                    <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
                  </div>
                </div> --}}
                {{-- <div class="clone hide">
                  <div class="hdtuto control-group lst input-group" style="margin-top:10px">
                    <input type="file" name="filenames[]" class="myfrm form-control" multiple="multiple">
                    <div class="input-group-btn"> 
                      <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                  </div>
                </div> --}}
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
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>


{{-- <script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".hdtuto control-group lst").remove();
      });
    });
</script> --}}
{{-- <script type="text/javascript">
var form = document.getElementById('formAdd');
var request = new XMLHttpRequest();

form.addEventListener('submit', function(e){
    e.preventDefault();
    var formdata = new FormData(form);

    request.open('post', '{{ route('mailbox.store') }}');
    request.addEventListener("load", transferComplete);
    request.send(formdata);

});

function transferComplete(data){
  console.log(data.currentTarget.response);
    // response = JSON.parse(data.currentTarget.response);
    // if(response.success){
    //     document.getElementById('message').innerHTML = "Successfully Uploaded Files!";
    // }
}
</script> --}}
@endsection