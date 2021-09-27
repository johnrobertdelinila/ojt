<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ asset('property_inventory_theme/html/assets/img/OOTD.jpg') }}">
    <title>OOTD</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/material-design-icons/css/material-design-iconic-font.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/jqvmap/jqvmap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('property_inventory_theme/html/assets/css/style.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('property_inventory_theme/html/assets/css/mystyle.css') }}" type="text/css"/>
    <script src="{{ asset('property_inventory_theme/html/assets/js/owens.js') }}" type="text/javascript"></script>
  </head>
  <body>
    <div class="be-wrapper be-nosidebar-left" style="padding:0px;">
      <div class="be-content">
        <div class="main-content container-fluid">
        {{--  Inside Start  --}}
              @yield('content')
        {{--  Inside End  --}}
        </div>
      </div>
    </div>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/js/main.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery-flot/jquery.flot.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery-flot/jquery.flot.pie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery-flot/jquery.flot.resize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery-flot/plugins/jquery.flot.orderBars.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery-flot/plugins/curvedLines.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery.sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/countup/countUp.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jqvmap/jquery.vmap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/js/app-dashboard.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      	App.dashboard();
      
      });
    </script>
  </body>
</html>