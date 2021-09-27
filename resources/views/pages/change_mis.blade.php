@extends('layouts.app')

@section('content')
<!--Basic forms-->
    {{--  first column start  --}}
    @if(!session('granted'))
        <div class="input-group col-md-12" id="mis_password_div" style="margin-bottom:5px;"><span class="input-group-addon">MIS PASSWORD:</span>
            <form method="post" action="change_mis_password" id="form_mis_password">
                @csrf
                <input type="password" name="mis_password" id="mis_password" class="form-control" autofocus>
            </form>
        </div>
    @else
        <div class="col-sm-6" id="doctor_div">
            <div class="panel panel-default panel-border-color panel-border-color-primary" style="border:1px solid gray;border-top:3px solid green;">
            <div class="panel-heading panel-heading-divider" style="font-weight:bold;">Time Doctor<span class="panel-subtitle">All fields are required.</span></div>
                <div class="panel-body">
                {{--  WHOLE FORM  --}}
                <form method="post" action="change_mis_process">
                {{ csrf_field() }}
                        <div class="form-group xs-pt-10 col-sm-12">
                            {{--  DIVIDER HOLIDAY DATE  --}}
                            <div class="input-group" style="margin-bottom:5px;"><span class="input-group-addon">Name:</span>
                                <select name="name" class="form-control select2" required autofocus>
                                    <option value="">Select Name</option>
                                    @foreach($post as $posts)
                                        <option value="{{$posts->name}}">{{$posts->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group" style="margin-bottom:5px;"><span class="input-group-addon">Date:</span>
                                <input type="date" name="date" max='<?php echo date("Y-m-d"); ?>' value='<?php echo date("Y-m-d"); ?>' class="form-control" required>
                            </div>
                            <button type="button" id="autofill" class="col-xs-12 btn btn-space btn-success btn-lg"><i class="icon icon-left mdi mdi-time"></i> Autofill</button>
                            {{--  DIVIDER HOLIDAY TIME  --}}
                            <div class="input-group" style="margin-bottom:5px;"><span class="input-group-addon">Time In (AM):</span>
                                <input type="time" name="time1" id="time1" class="form-control">
                            </div>
                            {{--  DIVIDER HOLIDAY TIME  --}}
                            <div class="input-group" style="margin-bottom:5px;"><span class="input-group-addon">Time Out (NN):</span>
                                <input type="time" name="time2" id="time2" class="form-control">
                            </div>
                            {{--  DIVIDER HOLIDAY TIME  --}}
                            <div class="input-group" style="margin-bottom:5px;"><span class="input-group-addon">Time In (NN):</span>
                                <input type="time" name="time3" id="time3" class="form-control">
                            </div>
                            {{--  DIVIDER HOLIDAY TIME  --}}
                            <div class="input-group" style="margin-bottom:5px;"><span class="input-group-addon">Time Out (PM):</span>
                                <input type="time" name="time4" id="time4" class="form-control">
                            </div>
                            {{--  DIVIDER HOLIDAY EVENT  --}}
                            <div class="input-group" style="margin-bottom:5px;"><span class="input-group-addon">Journal:</span>
                                <textarea name="accomplishment" class="form-control"></textarea>
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
    @endif
    {{--  first column end  --}}
        
    @if(session('suc'))
        <script>
            alert("<?php echo session('suc'); ?>");
        </script>
    @endif
    <script type="text/javascript">
        $(document).ready(function(){
            App.formElements();
            
            $('#autofill').on('click',function(){
                function randomTime(min, max) {
                return Math.floor(Math.random() * (max - min + 1)) + min;
                }
                $('#time1').val('07:'+randomTime(30,59)+':00');
                $('#time2').val('12:'+randomTime(10,29)+':00');
                $('#time3').val('12:'+randomTime(30,59)+':00');
                $('#time4').val('17:'+randomTime(10,29)+':00');
            });
        });
    </script>

@endsection