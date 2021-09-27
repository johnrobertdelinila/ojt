@extends('layouts.app')

@section('content')
<?php date_default_timezone_set('Asia/Manila'); ?>
<?php $date_now = date( 'g:i:s A', strtotime(date("H:i:s"))); ?>
<div class="row">
<form method="post" action="dtr_process" onsubmit="return frm_submit();">
{{ csrf_field() }}
    <div class="form-group xs-pt-10 col-sm-12" style="margin-bottom:0px;margin-top:0px;">
        <div class="row xs-pt-15">
            <div class="col-md-12 text-center">
                <div class="icon-container" style="background-color:#eeeeee;">
                    <div class="icon" id="indicator1" style="background-color:white;"><span class="mdi mdi-timer" id="tindicator1" style="color:black;"></span></div>
                    <div class="icon" id="indicator2" style="background-color:white;"><span class="mdi mdi-timer" id="tindicator2" style="color:black;"></span></div>
                    <div class="icon" id="indicator3" style="background-color:white;"><span class="mdi mdi-timer" id="tindicator3" style="color:black;"></span></div>
                    <div class="icon" id="indicator4" style="background-color:white;"><span class="mdi mdi-timer" id="tindicator4" style="color:black;"></span></div>
                </div>
            </div>
            @if( (date("Y-m-d") >= date("Y-m-d", strtotime(Auth::user()->ot_start))) && (date("Y-m-d") <= date("Y-m-d", strtotime(Auth::user()->ot_end))) )
            <div class="col-md-12 text-center">
                <div class="icon-container" style="background-color:#eeeeee;padding-top:0px;">
                    <div class="icon" id="indicator5" style="background-color:white;"><span class="mdi mdi-timer" id="tindicator5" style="color:black;"></span></div>
                    <div class="icon" id="indicator6" style="background-color:white;"><span class="mdi mdi-timer" id="tindicator6" style="color:black;"></span></div>
                </div>
            </div>
            @endif
            <div class="col-xs-12" style="font-size:30px;text-align:center;">
                <?php echo date("M d, Y"); ?> | <?php echo date("l"); ?> | <span id="liveclock"></span>
            </div>
        @if( (date("Y-m-d") >= date("Y-m-d", strtotime(Auth::user()->ot_start))) && (date("Y-m-d") <= date("Y-m-d", strtotime(Auth::user()->ot_end))) )
            @include('layouts.overtime_logbook')
        @elseif($holidays_count >= 1)
            {{--  holiday  --}}
        @elseif(true)
            @include('layouts.normal_logbook')
        @else
            {{--  weekend  --}}
        @endif
        </div>
    </div>
</form>
@if($btn_check == 'time4' || $btn_check == 'time6')
<div class="col-xs-12" style="font-size:18px;">
    @foreach($file_list as $files_list)
    <!-- date("l") != 'Saturday' && date("l") != 'Sunday' -->
        <a href="{{url('images/'.$files_list->file_name)}}">{{ $files_list->file_name }}</a> - - - 
        <a href="{{url('delete_single_file/'.$files_list->file_name)}}" style="color:red;">Remove</a><br/>
    @endforeach
</div>
<div  class="form-group xs-pt-10 col-sm-12">
    <span style="font-size:18px;font-weight:bold;"><i class="icon icon-left mdi mdi-attachment-alt"></i> Attachments:</span>
    <form method="post" action="image/upload/store" enctype="multipart/form-data" class="dropzone" id="dropzone" style="margin-top:0px;font-size:18px;">
        <input type="text" name="dtr_id" value="{{$dtr_id}}" readonly hidden>
        @csrf
    </form>   
</div>
@endif
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
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            var session = 'AM'
            if(h > 12){
                var h = h - 12;
                var session = 'PM';
            }else if(h == 12){
                var session = 'PM';
            }else{}
            
            if(h < 6 && session == 'AM' || (h == 6 && m <= 30 && session == 'AM')){
                document.getElementsByName("btn_time")[0].disabled = true; 
                // Balik to 8 pm by default latersss
            }else if(h > 8 && session == 'PM' || (h == 8 && m >= 00 && session == 'PM')){
                if(h == 12){
                    document.getElementsByName("btn_time")[0].disabled = false; 
                }else{
                    documRebent.getElementsByName("btn_time")[0].disabled = true; 
                }
            }else{
                document.getElementsByName("btn_time")[0].disabled = false;
            }

            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('liveclock').innerHTML =
            h + ":" + m + ":" + s + " " + session;
            var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
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
                    $.ajax({
                        headers: {
                                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                },
                        type: 'POST',
                        url: '{{ url("image/delete") }}',
                        data: {filename: name},
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
// $(window).on("blur focus", function(e) {
//     var prevType = $(this).data("prevType");

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

//     $(this).data("prevType", e.type);
// })
    </script>
    @include('layouts.timercolor')
@endsection