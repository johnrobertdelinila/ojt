@extends('layouts.app')

@section('content')
<!--Basic forms-->
    <div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default panel-border-color panel-border-color-primary" style="border:1px solid gray;border-top:3px solid green;">
        <div class="panel-heading panel-heading-divider" style="font-weight:bold;">User Registration<span class="panel-subtitle">All fields are required.</span></div>
        <div class="panel-body">

@if(session('suc'))
    <div role="alert" class="alert alert-success alert-dismissible">
        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-check"></span>{{session('suc')}}</u></b>.
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        {{--  WHOLE FORM  --}}
        <form method="post" action="user_reg">
        {{ csrf_field() }}
                <div class="form-group xs-pt-10 col-sm-12">
                    {{--  DIVIDER EMPLOYEE ID  --}}
                    <div class="input-group" style="margin-bottom:5px;">
                        <span class="input-group-addon">ID Number: </span>
                        <input type="text" name="student_id" value="000000" class="form-control" required>
                    </div>
                    {{--  DIVIDER NAME  --}}
                    <div class="input-group" style="margin-bottom:5px;">
                        <span class="input-group-addon">Name: </span>
                        <input type="text" name="name" class="form-control" autofocus required>
                    </div>
                    {{--  DIVIDER POSITION  --}}
                    <div class="input-group" style="margin-bottom:5px;">
                        <span class="input-group-addon">Deployed Agency: </span>
                        <input type="text" name="position" class="form-control" required>
                    </div>
                    {{--  DIVIDER COURSE  --}}
                    <div class="input-group" style="margin-bottom:5px;">
                        <span class="input-group-addon">Course: </span>
                        <select name="division" class="select2" required>
                                <option value="">- - - Select Course - - -</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="IT">Information Technology</option>
                                <option value="CS">Computer Science</option>
                                <option value="COE">Computer Engineering</option>
                        </select>
                    </div>
                    {{--  DIVIDER SIGNATURE  --}}
                    <label hidden class="label_bold col-md-4 h4">Signature: <span style="color:red;"> *</span></label>
                    <div hidden class="col-md-8" style="margin-bottom:5px;">
                        <input type="text" name="signature" class="form-control">
                    </div>
                    {{--  DIVIDER username  --}}
                    <div class="input-group" style="margin-bottom:5px;">
                        <span class="input-group-addon">Username: </span>
                        <input type="text" name="email" class="form-control"required>
                    </div>
                    {{--  DIVIDER PASSWORD  --}}
                    <div class="input-group" style="margin-bottom:5px;">
                        <span class="input-group-addon">Password: </span>
                        <input type="password" name="password" value="1234567" class="form-control"required>
                    </div>
                    {{--  DIVIDER UTYPE  --}}
                    <div class="input-group" style="margin-bottom:5px;">
                        <span class="input-group-addon">User Type: </span>
                        <select name="utype" class="select2" required>
                                <option value="">- - - Select User Type - - -</option>
                                <option value="user" selected>STUDENT</option>
                                <!-- <option value="sc">SECTION CHIEF</option> -->
                                <!-- <option value="dc">DIVISION CHIEF</option> -->
                                <option value="rd">SUPERVISOR</option>
                                <option value="admin">ADMIN</option>
                        </select>
                    </div>
                    {{--  ASSIGNATORIES  --}}
                    <div class="input-group" style="margin-bottom:5px;">
                        <span class="input-group-addon">Assignatories: </span>
                        <select name="assignatories" class="select2" required>
                                    <option value="">- - - Select Signatories - - -</option>
                                @foreach($post_assignatories as $posts_assignatories)
                                    <option value="{{ $posts_assignatories->id }}">{{ $posts_assignatories->unit_head }}</option>
                                @endforeach
                        </select>
                    </div>
                    {{--  DIVIDER BUTTON  --}}
                    </div>
                        <div class="row xs-pt-15">
                            <div class="col-xs-6 col-xs-offset-3">
                                <button type="submit" id="submit_btn" class="col-xs-12 btn btn-space btn-success btn-lg"><i class="icon icon-left mdi mdi-floppy"></i> Save</button>
                            </div>
                        </div>
                    </div>
        </form>
        {{--  WHOLE FORM  --}}

        </div>
        </div>
    </div>
    </div>
<br>

    <script type="text/javascript">
        $(document).ready(function(){
            App.formElements();
        });
    </script>

@endsection