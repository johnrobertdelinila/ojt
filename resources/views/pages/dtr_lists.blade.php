@extends('layouts.app')

@section('content')
<div class="row">
{{--  <div class="col-md-12 panel panel-default panel-border-color panel-border-color-primary">  --}}
{{--  @if(session('suc_released'))
    <script>
        alert('Successfully Released!');
    </script>
@endif
@if(session('suc_cancelled'))
    <script>
        alert('Successfully Cancelled!');
    </script>
@endif  --}}
{{--  FILTER  --}}
<?php date_default_timezone_set('Asia/Manila'); ?>
<div class="col-md-12">
{{--  MAINTENANCE ALERT  --}}
{{--  MAINTENANCE ALERT  --}}
    <div class="panel panel-default panel-table" style="border:1px solid gray;border-top:3px solid #2E4053;">
        <div class="panel-body table-responsive">
            <div class="form-group" style="margin-bottom:0px;">
            <button class="btn btn-default active btn-lg" id="hide_filter_btn" style="margin:10px;font-size:15px;"><li style="font-size:15px;" class="mdi mdi-settings"></li> Filter Options</button>
            {{--  <a class="btn btn-default active btn-lg pull-right" href="{{url('/travel_registration')}}" style="margin:10px;font-size:15px;"><li style="font-size:15px;font-weight:bold;" class="mdi mdi-plus"></li> Register New</a>  --}}
            {{ Form::Open(['url'=>'dtr_lists','method'=>'get']) }}
                <table class="table" id="filter_table">
                    <tr>
                        <td style="width:50%;">
                            <label class="label_bold h4">Student Name</label>
                            <select name="employee_name" class="form-control select2" style="padding:0px 0px 0px 10px;">
                                @isset($employee_name)
                                    @if(Auth::user()->utype == 'admin' || Auth::user()->utype == 'rd' || Auth::user()->utype == 'dc')
                                            <option value="">All Student</option>
                                        @foreach($post_users as $posts_users)
                                            @if($posts_users->name == $employee_name)
                                                <option value="{{$posts_users->name}}" selected>{{$posts_users->name}}</option>
                                            @else
                                                <option value="{{$posts_users->name}}">{{$posts_users->name}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        @foreach($post_users as $posts_users)
                                        @if($posts_users->name == $employee_name)
                                            <option value="{{$posts_users->name}}" selected>{{$posts_users->name}}</option>
                                        @endif
                                        @endforeach
                                    @endif
                                @else
                                    <option value="">All Student</option>
                                    @foreach($post_users as $posts_users)
                                        @if($posts_users->utype == 'admin' || $posts_users->utype == 'rd')
                                        @else
                                            <option value="{{$posts_users->name}}">{{$posts_users->name}}</option>
                                        @endif
                                    @endforeach
                                @endisset
                            </select>
                        </td>
                        <td style="width:20%;">
                            <label class="label_bold h4">Start Date</label>
                            <input type="date" name="start_date" class="form-control" value="@isset($start_date){{$start_date}}@else<?php echo date('Y').'-01-01'; ?>@endisset" style="padding:0px 0px 0px 10px;">
                        </td>
                        <td style="width:20%;">
                            <label class="label_bold h4">End Date</label>
                            <input type="date" name="end_date" class="form-control" value="@isset($end_date){{$end_date}}@else<?php echo date('Y-m-d'); ?>@endisset" style="padding:0px 0px 0px 10px;">
                        </td>
                        <td style="width:10%;">
                            <label class="label_bold h4">Per page</label>
                            <select name="per_page" class="form-control" style="padding:0px 0px 0px 10px;">
                                @isset($per_page)
                                    <option value="{{$per_page}}">@if($per_page > 5000) ALL @else {{$per_page}} @endif</option>
                                @endisset
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="500">500</option>
                                    <option value="9999999">ALL</option>
                            </select>
                        </td>
                        {{--  <td style="width:10%;">
                            <label class="label_bold h4">&nbsp;</label>
                            <button name="filter" value="Filter" style="padding:0px;" class="form-control tbox btn btn-space btn-primary"><i class="icon icon-left mdi mdi-filter-list"></i> Filter</button>
                        </td>  --}}
                    </tr>
                    <tr>
                        <td colspan="6">
                            <p class="xs-mt-10 xs-mb-10 pull-right">
                                {{--  <button class="btn btn-space btn-success btn-lg"><i class="icon icon-left mdi mdi-print"></i> PRINT RECORDS</button>  --}}
                                <button name="filter" value="Filter" class="btn btn-space btn-warning btn-lg"><i class="icon icon-left mdi mdi-filter-list"></i> Filter</button>
                                <button name="print" value="Print" class="btn btn-space btn-success btn-lg"><i class="icon icon-left mdi mdi-print"></i> Print DTR</button>
                                <button name="print" value="Accomplishments" class="btn btn-space btn-info btn-lg"><i class="icon icon-left mdi mdi-print"></i> Print Journals</button>
                            </p>
                        </td>
                    </tr>
                </table>
            {{ Form::Close() }}
            </div>
        </div>
    </div>
</div>
{{--  FILTER  --}}
<div class="col-md-12">
    <div class="panel panel-default panel-table" style="border:1px solid gray;border-top:3px solid #2E4053;">
    <div class="panel-body table-responsive">
        <div class="panel-heading"> 
            <div class="title"><b>List of Journals</b></div>
        </div>
        <table class="table table-hover table-bordered h4" style="border-top:1px solid #D9D9D9;">
        <thead>
            <tr>
                <th style="width:20%;">Name</th>
                <th style="width:10%;">Date</th>
                <th style="width:10%;">AM Time In</th>
                <th style="width:10%;">NN Time Out</th>
                <th style="width:10%;">NN Time In</th>
                <th style="width:10%;">PM Time Out</th>
                <th style="width:20%;">Journal</th>
                <th style="width:10%;">Notification View</th>
                <th style="width:10%;">Action</th>
            </tr>
        </thead>

        <tbody class="no-border-x">
            @foreach($post_dtr as $posts_dtr)
            <tr>
                <td style="vertical-align:top;">{{$posts_dtr->name}}</td>
                <td style="vertical-align:top;">{{$posts_dtr->date}}</td>
                @if($posts_dtr->time1) <td style="vertical-align:top;">{{date( 'g:i A', strtotime($posts_dtr->time1))}}</td> @else <td style="background-color:#FFFCAE;"></td> @endif
                @if($posts_dtr->time2) <td style="vertical-align:top;">{{date( 'g:i A', strtotime($posts_dtr->time2))}}</td> @else <td style="background-color:#FFFCAE;"></td> @endif
                @if($posts_dtr->time3) <td style="vertical-align:top;">{{date( 'g:i A', strtotime($posts_dtr->time3))}}</td> @else <td style="background-color:#FFFCAE;"></td> @endif
                @if($posts_dtr->time4) 
                    <td style="vertical-align:top;">
                        {{date( 'g:i A', strtotime($posts_dtr->time4))}}
                        @if($posts_dtr->time5) 
                            <br/>
                            <b style="font-size:12px;">OT In: {{ $posts_dtr->time5 ? date( 'g:i A', strtotime($posts_dtr->time5)) : '' }}</b><br/>
                            <b style="font-size:12px;">OT Out: {{ $posts_dtr->time6 ? date( 'g:i A', strtotime($posts_dtr->time6)) : '' }}</b>
                        @endif
                    </td> 
                @else <td style="background-color:#FFFCAE;"></td> @endif
                @if($posts_dtr->time4) 
                    <td style="vertical-align:top;">
                        <div class="content hideContent">
                            <?php echo stripslashes(nl2br($posts_dtr->accomplishment)); ?>
                        </div>
                        <div class="show-more">
                            <a href="#">Show more</a>
                        </div>
                        <?php $i = 1; ?>
                        @foreach($post_file as $posts_file)
                            @if($posts_file->dtr_id == $posts_dtr->id)
                                <a href="{{url('images/'.$posts_file->file_name)}}" target="_blank"><i class="icon icon-left mdi mdi-attachment-alt"></i> Attachment <?php echo $i++; ?></a>
                                @if(Auth::user()->utype=='rd' || Auth::user()->utype=='admin')
                                    - - -
                                    <button class="btn btn-space btn-primary btn-sm" data-toggle="modal" data-target="#mod-success" value="{{$posts_file->id}}" onclick="document.getElementsByName('uploads_id')[0].value=this.value;" type="button">
                                        Add Task
                                    </button>
                                @endif
                                <br/>
                                @foreach($post_revisions as $posts_revisions)
                                    @if($posts_revisions->uploads_id == $posts_file->id)
                                        <a href="{{url('images/'.$posts_revisions->file_name)}}" target="_blank" style="margin-left:25px;color:red;"><i class="icon icon-left mdi mdi-format-list-bulleted"></i> Revised Attachment</a>
                                        <br/>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach<br/>
                        @if($posts_dtr->remarks)
                            <span style="color:green;"><span class="mdi mdi-comment-alt-text"></span> Task:</span><br/>
                            <?php echo stripslashes(nl2br($posts_dtr->remarks)); ?>
                            <span style="font-size:12px;">
                            </span>
                        @endif
                        <?php $i = 1; ?>
                    </td>
                @else 
                    <td style="background-color:#FFFCAE;"></td>
                @endif
                <td>{{ $posts_dtr->time1 == null ? "No Time In AM" : ($posts_dtr->time2 == null ? "No Time Out AM" : ($posts_dtr->time3 == null ? "No Time In PM" : ($posts_dtr->time4 == null ? "No Time Out PM" : ("")))) }}</td>
                <td style="vertical-align:top;">
                    <div class="btn-group btn-hspace">
                        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="{{url('/dtr_print/'.$posts_dtr->id)}}" target="_blank">Print</a></li>
                            @if($posts_dtr->time4)
                                @if(Auth::user()->utype == 'admin' || Auth::user()->utype == 'rd')
                                    <li data-toggle="modal" class="hehe" data-target="#mod-success2" onclick='remarks_function("{{ str_replace("'","\'",stripslashes(str_replace("\r\n"," ", $posts_dtr->remarks))) }}","{{ $posts_dtr->id }}");'><a href="###">Add Task</a></li>
                                @endif
                            @endif
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="11" style="text-align:center;">
                @isset($per_page)
                    {{ $post_dtr->appends(['employee_name'=>$employee_name,'start_date'=>$start_date,'end_date'=>$end_date,'per_page'=>$per_page,'filter'=>'Filter'])->links() }}
                @else
                    {{ $post_dtr->links() }}
                @endisset
                </td>
            </tr>
        </tbody>

        </table>
        
    </div>
    </div>
</div>
    {{--  MODAL REVISION  --}}
    <div id="mod-success" tabindex="-1" role="dialog" style="" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
          </div>
          <div class="modal-body">
            <div class="text-center">
                <span style="font-size:18px;font-weight:bold;"><i class="icon icon-left mdi mdi-attachment-alt"></i> Attach Your Classwork</span>
                <form method="post" action="revisions/upload/store" enctype="multipart/form-data" class="dropzone" id="dropzone" style="margin-top:0px;font-size:18px;">
                    <input type="text" name="uploads_id" value="" readonly hidden>
                    @csrf
                </form>   
            </div>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>
    {{--  MODAL REVISION  --}}
    {{--  MODAL REMARKS  --}}
    <div id="mod-success2" tabindex="-1" role="dialog" style="" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
          </div>
          <div class="modal-body">
            <div class="text-center">
                <span style="font-size:18px;font-weight:bold;"><i class="icon icon-left mdi mdi-edit"></i> Task</span>
                <form method="post" action="add_remarks">
                    @csrf
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" name="id" id="remarks_id" readonly hidden>
                            <textarea class="form-control" style="height:200px;" id="remarks_content" name="remarks"></textarea><br/>
                            <button class="btn btn-lg btn-success"><i class="icon icon-left mdi mdi-floppy"></i> Save</button>
                        </div>
                    </div>
                    
                </form>   
            </div>
          </div>
          <div class="modal-footer"></div>
        </div>
      </div>
    </div>
    {{--  MODAL REMARKS  --}}
</div>
<script>
    function remarks_function(val1, val2){
        document.getElementById("remarks_id").value = val2;
        document.getElementById("remarks_content").value = val1;
    }
    $(document).ready(function(){
        $('#filter_table').hide();
        $('#hide_filter_btn').click(function(event){
        $('#filter_table').toggle(150);
        });
    });

</script>
{{--  INITIALIZE FORM ELEMENTS  --}}
<script type="text/javascript">
    $(document).ready(function(){
        App.formElements();

        $(".show-more a").on("click", function() {
            var $this = $(this); 
            var $content = $this.parent().prev("div.content");
            var linkText = $this.text().toUpperCase();    
            
            if(linkText === "SHOW MORE"){
                linkText = "Show less";
                $content.switchClass("hideContent", "showContent", 100);
            } else {
                linkText = "Show more";
                $content.switchClass("showContent", "hideContent", 100);
            };

            $this.text(linkText);
        });

    });
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
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.docx,.mp4,.pdf",
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
                        url: '{{ url("revisions/delete") }}',
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
                    location.reload();
                },
                error: function(file, response)
                {
                return false;
                }
    };
    </script>
    
@endsection