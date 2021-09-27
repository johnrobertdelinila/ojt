@extends('layouts.app')

@section('content')
<!--Basic forms-->
        {{--  first column start  --}}
        <div class="col-sm-6">
            <div class="panel panel-default panel-border-color panel-border-color-primary" style="border:1px solid gray;border-top:3px solid green;">
            <div class="panel-heading panel-heading-divider" style="font-weight:bold;">Holiday Registration<span class="panel-subtitle">All fields are required.</span></div>
                <div class="panel-body">
                {{--  WHOLE FORM  --}}
                <form method="post" action="holidays_process">
                {{ csrf_field() }}
                        <div class="form-group xs-pt-10 col-sm-12">
                            {{--  DIVIDER HOLIDAY DATE  --}}
                            <div class="input-group" style="margin-bottom:5px;"><span class="input-group-addon">Date:</span>
                                <input type="date" name="holiday_date" class="form-control" required autofocus>
                            </div>
                            {{--  DIVIDER HOLIDAY EVENT  --}}
                            <div class="input-group" style="margin-bottom:5px;"><span class="input-group-addon">Event:</span>
                                <input type="text" name="holiday_event" class="form-control" required>
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
        <div class="col-sm-6">
            <div class="panel panel-default panel-border-color panel-border-color-primary" style="border:1px solid gray;border-top:3px solid green;">
            <div class="panel-heading panel-heading-divider" style="font-weight:bold;">Holidays List</div>
                <div class="panel-body">
                {{--  WHOLE FORM  --}}
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Event</th>
                                <th>Date</th>
                                <th class="actions"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($post as $posts)
                                <tr>
                                    <td>{{ $posts->holiday_event }}</td>
                                    <td>{{ date('F d, Y',strtotime($posts->holiday_date)) }}</td>
                                    <td class="actions"><a href="{{ url('holidays/'.$posts->id) }}" class="icon"><i class="mdi mdi-delete"></i></a></td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="3" class="text-center">{{ $post->links() }}</td>
                                </tr>
                        </tbody>
                    </table>
                {{--  WHOLE FORM  --}}
                </div>
            </div>
        </div>
        {{--  first column end  --}}
        
    @if(session('suc'))
        <script>
            alert("<?php echo session('suc'); ?>");
        </script>
    @endif
    <script type="text/javascript">
        $(document).ready(function(){
            App.formElements();
        });
    </script>

@endsection