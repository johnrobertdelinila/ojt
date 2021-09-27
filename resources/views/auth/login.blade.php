<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('property_inventory_theme/html/assets/img/clock.png') }}">
    <title>OJT Monitoring and Daily Journal System</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/material-design-icons/css/material-design-iconic-font.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('property_inventory_theme/html/assets/css/style.css') }}" type="text/css"/>
  </head>
  <body class="be-splash-screen" style="background-color:white;">
  {{--  <body class="be-splash-screen">  --}}
    <div class="be-wrapper be-login">
      <div class="be-content">
        <div class="main-content container-fluid">
          <div class="splash-container" style="box-shadow:0px 0px 50px gray;">
            {{--  LOGIN FORM START  --}}
            <div class="panel panel-default panel-border-color panel-border-color-primary">
              <div class="panel-heading" style="margin:0px;"><img src="{{ asset('property_inventory_theme/html/assets/img/clock.png') }}" alt="logo" width="150px" class="logo-img">
                  <span class="splash-description" style="font-size:19px;font-family:lucida calligraphy;"><b>OJT Monitoring and Daily Journal System</b></span>
              </div>
              <div class="panel-body">
                <form method="POST" action="{{ route('login') }}">
                @csrf
                  <div class="login-form">
                    <div class="form-group">
                      <input id="username" type="text" placeholder="Username" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" autofocus required>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert" style="color:#e60000;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif                                
                                @if (session('deactivated'))
                                    <span class="invalid-feedback" role="alert" style="color:#e60000;">
                                        <strong>{{ session('deactivated') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group">
                      <input id="password" type="password" placeholder="Password"  name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                    </div>
                    {{--  <div class="form-group row login-tools">
                      <div class="col-xs-6 login-remember">
                        <div class="be-checkbox">
                          <input type="checkbox" id="remember">
                          <label for="remember">Remember Me</label>
                        </div>
                      </div>
                      <div class="col-xs-6 login-forgot-password"><a href="#">Forgot Password?</a></div>
                    </div>  --}}
                    <div class="form-group row login-submit">
                      <div class="col-xs-12">
                        <button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">Sign in</button>
                      </div>
                    </div>
                  <span class="splash-description" style="font-size:16px;font-family:calibri;">
                      <?php echo date("F jS Y, l"); ?><br/>
                      Developed By: <a href="###"><b><i>Balbin, Eugenio & Niro</i></b></a>
                  </span>
                  </div>
                </form>
              </div>
            </div>
            {{--  LOGIN FORM START  --}}
          </div>
        </div>
      </div>
    </div>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/js/main.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      });
      
    </script>
  </body>
</html>