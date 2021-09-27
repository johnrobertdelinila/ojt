@if(session('suc'))
    {{session('suc')}}
@endif
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('property_inventory_theme/html/assets/img/ootd.jpg') }}">
    <title>OOTD</title>
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
              <div class="panel-heading" style="margin:0px;">
                  <span class="splash-description" style="font-size:20px;font-family:calibri;"><b>ONE TIME ACTIVATION</b></span>
              </div>
              <div class="panel-body">
                <form method="POST" action="activate_system">
                    {{ csrf_field() }}
                    <div class="login-form">
                        <div class="form-group" style="margin-bottom:0px;">
                            <input type="password" placeholder="Activation Key" name="activation_key" class="form-control" autofocus required>
                        </div>
                        <div class="form-group row login-submit">
                            <div class="col-xs-12">
                                <button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl"><i class="icon icon-left mdi mdi-lock"></i> Activate</button>
                            </div>
                        </div>
                        <span class="splash-description" style="font-size:16px;font-family:calibri;">
                            Keep Your Items Monitored On Time<br/>
                            <?php echo date("F jS Y, l"); ?><br/>
                            Developed by: <a href="https://www.facebook.com/russelowens.miranda">Russel Owens Miranda</a>
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