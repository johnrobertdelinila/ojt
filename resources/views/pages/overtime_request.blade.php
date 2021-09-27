@extends('layouts.app')

@section('content')
<!--Basic forms-->
        {{--  first column start  --}}
        @if(Auth::user()->utype != 'admin')
        <div class="col-sm-6">
            <div class="panel panel-default panel-border-color panel-border-color-primary" style="border:1px solid gray;border-top:3px solid green;">
            <div class="panel-body table-responsive">
                <div class="panel-heading panel-heading-divider" style="font-weight:bold;">Overtime Request<span class="panel-subtitle">All fields are required.</span></div>
                <div class="panel-body">
                {{--  WHOLE FORM  --}}
                <form method="post" onsubmit="return confirm_overtime();" action="overtime_request_process">
                {{ csrf_field() }}
                        <div class="form-group xs-pt-10 col-sm-12">
                            {{--  DIVIDER OVERTIME START DATE  --}}
                            <div class="input-group" style="margin-bottom:5px;"><span class="input-group-addon">Start Date:</span>
                                <input type="date" name="overtime_start_date" id="ot_start" class="form-control" required autofocus>
                            </div>
                            {{--  DIVIDER OVERTIME END DATE  --}}
                            <div class="input-group" style="margin-bottom:5px;"><span class="input-group-addon">End Date:</span>
                                <input type="date" name="overtime_end_date" id="ot_end" class="form-control" required>
                            </div>
                            {{--  PURPOSE  --}}
                            <div class="input-group" style="margin-bottom:5px;"><span class="input-group-addon">Purpose:</span>
                                <textarea name="overtime_purpose" class="form-control" required></textarea>
                            </div>
                            {{--  DIVIDER BUTTON  --}}
                            <div>
                                <div class="row xs-pt-15">
                                    <div class="col-xs-6 col-xs-offset-3">
                                        <button type="submit" id="submit_btn" class="col-xs-12 btn btn-space btn-success btn-lg"><i class="icon icon-left mdi mdi-floppy"></i> Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
                {{--  WHOLE FORM  --}}
                </div>
            </div>
            </div>
        </div>
        {{--  divider  --}}
        <div class="col-sm-6">
            <div class="panel panel-default panel-border-color panel-border-color-primary" style="border:1px solid gray;border-top:3px solid green;">
            <div class="panel-body table-responsive">
                <div class="panel-heading panel-heading-divider" style="font-weight:bold;">Overtime Request List</div>
                <div class="panel-body">
                {{--  WHOLE FORM  --}}
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Purpose</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($post as $posts)
                                <tr>
                                    <td>{{ date('F d, Y',strtotime($posts->overtime_start_date)) }}</td>
                                    <td>{{ date('F d, Y',strtotime($posts->overtime_end_date)) }}</td>
                                    <td>{{ $posts->overtime_purpose }}</td>
                                    <td>{{ $posts->overtime_status }}</td>
                                    <td>
                                    @if($posts->overtime_status == 'Pending')
                                        <a href="{{ url('overtime_request_delete/'.$posts->id) }}" class="btn btn-danger btn-sm">Cancel Request</a>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="6" class="text-center">{{ $post->links() }}</td>
                                </tr>
                        </tbody>
                    </table>
                {{--  WHOLE FORM  --}}
                </div>
            </div>
            </div>
        </div>
        @endif
        {{--  first column end  --}}
        @if(Auth::user()->utype == 'admin')
        <div class="col-sm-12">
            <div class="panel panel-default panel-border-color panel-border-color-primary" style="border:1px solid gray;border-top:3px solid green;">
            <div class="panel-body table-responsive">
                <div class="panel-heading panel-heading-divider" style="font-weight:bold;">Student Overtime Request List</div>
                <div class="panel-body">
                {{--  WHOLE FORM  --}}
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th style="width:20%;">Student Name</th>
                                <th style="width:10%;">Start Date</th>
                                <th style="width:10%;">End Date</th>
                                <th style="width:40%;">Purpose</th>
                                <th style="width:15%;">Status</th>
                                <th style="width:15%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($post_all as $posts_all)
                                <tr>
                                    <td>{{ $posts_all->name }}</td>
                                    <td>{{ date('F d, Y',strtotime($posts_all->overtime_start_date)) }}</td>
                                    <td>{{ date('F d, Y',strtotime($posts_all->overtime_end_date)) }}</td>
                                    <td>{{ $posts_all->overtime_purpose }}</td>
                                    <td>{{ $posts_all->overtime_status }}</td>
                                    <td>
                                    @if($posts_all->overtime_status == 'Pending')
                                        <a href="{{ url('overtime_request_approve/'.$posts_all->id.'/'.$posts_all->overtime_requestor.'/'.$posts_all->overtime_start_date.'/'.$posts_all->overtime_end_date) }}" class="btn btn-success btn-sm">Approve</a>
                                        <a href="{{ url('overtime_request_decline/'.$posts_all->id) }}" class="btn btn-danger btn-sm">Decline</a>
                                    @else
                                        <a href="{{ url('overtime_request_pending/'.$posts_all->id.'/'.$posts_all->overtime_requestor) }}" class="btn btn-warning btn-sm">Back to Pending</a>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="7" class="text-center">{{ $post->links() }}</td>
                                </tr>
                        </tbody>
                    </table>
                {{--  WHOLE FORM  --}}
                </div>
            </div>
            </div>
        </div>
        @endif
    @if(session('suc'))
        <script>
            alert("<?php echo session('suc'); ?>");
        </script>
    @endif
    <script type="text/javascript">
        function confirm_overtime(){
            if(confirm('Do you want to proceed?') == true){
                var ot1 = document.getElementById('ot_start').value;
                var ot2 = document.getElementById('ot_end').value;
                if(ot1 <= ot2){
                    return true;
                }else{
                    alert('Start Date Must Greater Than End Date!');
                    return false;
                }
            }else{
                return false;
            }
        }
        $(document).ready(function(){
            App.formElements();
        });
    </script>

@endsection