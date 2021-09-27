@extends('layouts.app')

@section('content')
<!--Basic forms-->
<form method="POST" action="{{ route('register') }}">
    @csrf
    <div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default panel-border-color panel-border-color-primary" style="border:1px solid gray;border-top:3px solid green;">
        <div class="panel-heading panel-heading-divider" style="font-weight:bold;">User Registration<span class="panel-subtitle">All fields are required.</span></div>
        <div class="panel-body">
            <div class="form-group">
                <label style="font-weight:bold;">Name</label>
                <input id="name" type="text" class="form-control tbox{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group">
                <label style="font-weight:bold;">Gender</label>
                <select class="form-control" name="gender" required>
                    <option value="">- - - Select - - -</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label style="font-weight:bold;">Username</label>
                <input id="email" type="text" class="form-control tbox{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group">
                <label style="font-weight:bold;">Password</label>
                <input id="password" type="password" class="form-control tbox{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group">
                <label style="font-weight:bold;">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control tbox" name="password_confirmation" required>
            </div>
            <div class="row xs-pt-15">
                <div class="col-xs-6"><button type="submit" class="btn btn-space btn-primary">Register</button></div>
            </div>
        </div>
        </div>
    </div>
    </div>
</form><br>
@endsection