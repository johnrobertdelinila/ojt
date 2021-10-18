@extends('layouts.app')

@section('content')
<?php date_default_timezone_set('Asia/Manila'); ?>
<?php $date_now = date( 'g:i:s A', strtotime(date("H:i:s"))); ?>
<div class="row">
    <div class="page-head">
        <h2 class="page-head-title">Task: </h2>
        {!! $classwork->description !!}
    </div>
    <div  class="form-group xs-pt-10 col-sm-12">
        <span style="font-size:18px;font-weight:bold;"><i class="icon icon-left mdi mdi-attachment-alt"></i> Task Attachments:</span>
        <form method="post" action="image/upload/classwork" enctype="multipart/form-data" class="dropzone" id="dropzone" style="margin-top:0px;font-size:18px;">
            <input type="text" name="classwork_id" value="{{$classwork->id}}" readonly hidden>
            @csrf
        </form>   
    </div>
    @if(Auth::user()->utype == 'admin' || Auth::user()->utype == 'rd')
    <div class="col-xs-12" style="font-size:18px;">
        <h3>Turned In:</h3>
        @foreach($classwork->classwork_attachment as $files_list)
            <span>{{ $files_list->user->name }}</span>
            <a href="{{url('classworks/' . $classwork->id . '/' . $files_list->user_id . '/' . $files_list->filename)}}">&nbsp&nbsp&nbsp--{{ $files_list->filename }}</a>
        @endforeach
    </div>
    @endif

    <div class="col-xs-12" style="font-size:18px;">
        <h3>Your Task:</h3>
        @foreach($classwork->classwork_attachment as $files_list)
            @if($user_id == $files_list->user_id)
                <a href="{{url('classworks/' . $classwork->id . '/' . $files_list->user_id . '/' . $files_list->filename)}}">{{ $files_list->filename }}</a> - - - 
                <a href="{{url('classwork_detail/delete_single_file/' . $files_list->filename . '/' . $files_list->classwork_id)}}" style="color:red;">Remove</a><br/>
            @endif
        @endforeach
    </div>
</div>
@if(session('suc'))
{{--  MODAL START  --}}
    <div id="mod-success" tabindex="-1" role="dialog" style="" class="modal fade" data-backdrop="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
          </div>
          <div class="modal-body">
            <div class="text-center">
              <div class="text-success"><span class="modal-main-icon mdi mdi-check"></span></div>
                <h3>{{session('suc')}} - <span style="color:green;font-weight:bold;">{{date( 'g:i A', strtotime(session('time')))}}</span></h3>
              <div class="xs-mt-50">
                <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Close</button>
              </div>
            </div>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>
{{--  MODAL END  --}}
@endif
{{--  <a href="{{url('export')}}">Export</a>  --}}
{{--  INITIALIZE FORM DASHBOARD  --}}
    <script type="text/javascript">
        function frm_submit(){
            if(confirm('Do you want to proceed?')){
                document.getElementsByName("btn_time")[0].style.visibility = "hidden";
                document.getElementsByName("btn_time")[0].style.position = "absolute";
                $('#loading_div').css('text-align','center');
                $('#loading_div').html('<img src="property_inventory_theme/html/assets/img/loading.gif" style="width:100px;"></img>');
                return true;
            }else{
                return false;
            }
        }
    </script>

        <script type="text/javascript">
            $(document).ready(function(){
                App.dashboard();
            });
        </script>

    <script>
        $(document).ready(function(){
            $("#mod-success").modal('show');
        });
        setTimeout(function() {$('#mod-success').modal('hide');}, 3000);
    </script>

    <script type="text/javascript">
        Dropzone.options.dropzone =
            {
                maxFilesize: 500,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                return time+'_'+file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.doc,.docx,.mp4,.pdf",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file) 
                {
                    var name = file.upload.filename;
                    var classwork_id = {!! json_encode($classwork->id) !!};
                    $.ajax({
                        headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                },
                        type: 'POST',
                        url: '{{ url("classwork_detail/image/delete/classwork") }}',
                        data: {filename: name, classwork_id: classwork_id},
                        success: function (data){
                            console.log("File has been successfully removed!!");
                        },
                        error: function(e) {
                            console.log(e);
                        }});
                        var fileRef;
                        return (fileRef = file.previewElement) != null ? 
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },
        
                success: function(file, response) 
                {
                    console.log(response);
                },
                error: function(file, response)
                {
                return false;
                }
            };

        if (prevType != e.type) {   //  reduce double fire issues
            switch (e.type) {
                case "blur":
                    // do work
                    break;
                case "focus":
                    //location.reload();
                    break;
            }
        }

    </script>
    
@endsection