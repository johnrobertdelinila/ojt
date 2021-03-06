@isset($check_maintenance)
    @if($check_maintenance > 0)
        @php
            header("Location: " . URL::to('/under_maintenance'), true, 302);
            exit();
        @endphp
    @endif
@endisset

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="_token" content="{{csrf_token()}}" />
    <link rel="shortcut icon" href="{{ asset('property_inventory_theme/html/assets/img/lorma.png') }}">
    <title>OJT Monitoring and Daily Journal System</title>
    
    {{--  <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/material-design-icons/css/material-design-iconic-font.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/jqvmap/jqvmap.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('property_inventory_theme/html/assets/css/style.css') }}" type="text/css"/>  --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/material-design-icons/css/material-design-iconic-font.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/datetimepicker/css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/select2/css/select2.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('property_inventory_theme/html/assets/lib/bootstrap-slider/css/bootstrap-slider.css') }}"/>
    <link rel="stylesheet" href="{{ asset('property_inventory_theme/html/assets/css/style.css') }}" type="text/css"/>

    <style>
      div.text-container {
          margin: 0 auto;
          width: 75%;    
      }

      .hideContent {
          overflow: hidden;
          line-height: 1em;
          height: 2em;
      }

      .showContent {
          line-height: 1em;
          height: auto;
      }
      .showContent{
          height: auto;
      }

      h1 {
          font-size: 24px;        
      }
      p {
          padding: 10px 0;
      }
      .show-more {
          padding: 10px 0;
          text-align: center;
      }
    </style>

    <link rel="stylesheet" href="{{ asset('property_inventory_theme/html/assets/css/mystyle.css') }}" type="text/css"/>
    <script src="{{ asset('property_inventory_theme/html/assets/js/owens.js') }}" type="text/javascript"></script>
    //dropzone script
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    //dropzone script
  </head>
  <body onload="startTime();">
  <?php date_default_timezone_set('Asia/Manila'); ?>
    <div class="be-wrapper be-fixed-sidebar">
      <nav class="navbar navbar-default navbar-fixed-top be-top-header" style="background-color:#2E4053;color:white;">
        <div class="container-fluid">
          <div class="navbar-header">
            {{--  <a href="index.html" class="navbar-brand"></a>  --}}
            <img src="{{ asset('property_inventory_theme/html/assets/img/clock.png') }}" style="height:50px;margin:5px;"><span style="font-size:20px;font-family:lucida calligraphy;">OJT Monitoring and Daily Journal System</span></img>
          </div>
          <div class="be-right-navbar">
            <ul class="nav navbar-nav navbar-right be-user-nav">
            @if(Auth::user()->image_photo == '' || Auth::user()->image_photo == 'undefined')
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="{{ asset('property_inventory_theme/html/assets/img/avatar-150.png') }}" alt="Avatar"><span class="user-name">{{Auth::user()->name}}</span></a>
            @elseif(strpos(Auth::user()->image_photo, 'http://') !== false || strpos(Auth::user()->image_photo, 'https://') !== false)
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="{{ Auth::user()->image_photo }}" alt="Avatar"><span class="user-name">{{Auth::user()->name}}</span></a>
            @else
              <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><img src="{{ asset('images/'.Auth::user()->image_photo) }}" alt="Avatar"><span class="user-name">{{Auth::user()->name}}</span></a>
            @endif
                <ul role="menu" class="dropdown-menu" style="width:250px;">
                  <li>
                    <div class="user-info">
                      <div class="user-name">{{Auth::user()->name}}</div>
                      <div class="user-position online">{{Auth::user()->agency}}</div>
                      <div class="user-position online">{{Auth::user()->position}}</div>
                    </div>
                  </li>
                  <li><a href="{{url('users_edit_password/'.Auth::user()->id)}}"><span class="icon mdi mdi-face"></span> Account</a></li>
                  {{--  <li><a href="#"><span class="icon mdi mdi-settings"></span> Settings</a></li>  --}}
                  <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="icon mdi mdi-power"></span> Logout</a></li>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </ul>
              </li>
            </ul>
            {{--  notification  --}}
            <ul class="nav navbar-nav navbar-right be-icons-nav">
              {{--  <li class="dropdown"><a href="#" role="button" aria-expanded="false" class="be-toggle-right-sidebar"><span class="icon mdi mdi-email" style="color:white;"></span></a></li>  --}}
              {{--  <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="dropdown-toggle"><span class="icon mdi mdi-accounts-outline" style="color:white;"></span><span class="indicator"></span></a>  --}}
                <ul class="dropdown-menu be-notifications">
                  <li>
                    <div class="title">Present Employees</div>
                    <div class="list">
                      <div class="be-scroller">
                        <div class="content">
                          <ul>
                            <li class="notification notification-unread"><a href="#">
                                <div class="image"><img src="{{ asset('property_inventory_theme/html/assets/img/avatar6.png') }}" alt="Avatar"></div>
                                <div class="notification-info">
                                  <div class="text"><span class="user-name">Jessica Caruso</span> accepted your invitation to join the team.</div><span class="date">2 min ago</span>
                                </div></a></li>
                            <li class="notification"><a href="#">
                                <div class="image"><img src="{{ asset('property_inventory_theme/html/assets/img/avatar6.png') }}" alt="Avatar"></div>
                                <div class="notification-info">
                                  <div class="text"><span class="user-name">Joel King</span> is now following you</div><span class="date">2 days ago</span>
                                </div></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="footer"> <a href="#">View all notifications</a></div>
                  </li>
                </ul>
              </li>
            </ul>
            {{--  notification  --}}
            {{--  <div class="page-title"><span style="margin-left:50px;">PROPERTY INVENTORY</span></div>  --}}
          </div>
        </div>
      </nav>
      <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper" style="box-shadow:1px 1px 20px #2E4053;"><a href="#" class="left-sidebar-toggle">Dashboard</a>
          <div class="left-sidebar-spacer">
            <div class="left-sidebar-scroll">
              <div class="left-sidebar-content">
                <ul class="sidebar-elements">
                  <li class="divider">NAVIGATION MENU</li>
                  @if(Auth::user()->utype == 'user')
                    <li class="active"><a href="{{url('/logbook')}}"><i class="icon mdi mdi-collection-bookmark"></i><span>Logbook</span></a></li>
                  @endif
                  <li class="parent"><a href="#"><i class="icon mdi mdi-assignment"></i><span>Journals</span></a>
                    <ul class="sub-menu">
                      @if(Auth::user()->utype == 'admin' || Auth::user()->utype == 'rd' || Auth::user()->utype == 'dc')
                        <li><a href="{{url('/dtr_lists')}}">List</a></li>
                      @endif
                      @if(Auth::user()->utype == 'sc' || Auth::user()->utype == 'dc' || Auth::user()->utype == 'user')
                        <li><a href="{{url('dtr_lists?employee_name='.Auth::user()->name.'&start_date='.date('Y').'-01-01'.'&end_date='.date('Y-m-d').'&per_page=10&filter=Print&type=My Journals')}}">My Journals</a></li>
                      @endif
                    </ul>
                  </li>
                  <li class="parent"><a href="#"><i class="icon mdi mdi-bookmark"></i><span>DTR</span></a>
                    <ul class="sub-menu">
                      @if(Auth::user()->utype == 'admin' || Auth::user()->utype == 'rd' || Auth::user()->utype == 'dc')
                        <li><a href="{{url('/dtr_lists')}}">List</a></li>
                      @endif
                      @if(Auth::user()->utype == 'sc' || Auth::user()->utype == 'dc' || Auth::user()->utype == 'user')
                        <li><a href="{{url('dtr_lists?employee_name='.Auth::user()->name.'&start_date='.date('Y').'-01-01'.'&end_date='.date('Y-m-d').'&per_page=10&filter=Print&type=My DTR')}}">My DTR</a></li>
                      @endif
                    </ul>
                  </li>
                  <!-- <li><a href="{{url('/overtime_request')}}"><i class="icon mdi mdi-time-countdown"></i><span>Overtime Request</span></a> -->
                  <li><a href="{{url('/announcement')}}"><i class="icon mdi mdi-mic-setting"></i><span>Announcement</span></a>
                  @if(Auth::user()->utype == 'rd')
                    <li><a href="{{url('/classwork')}}"><i class="icon mdi mdi-keyboard"></i><span>Task</span></a>
                  @endif
                  
                  @if(Auth::user()->utype == 'admin' || Auth::user()->utype == 'rd' || Auth::user()->utype == 'dc')<li><a href="{{url('/evaluation')}}"><i class="icon mdi mdi-account"></i><span>Evaluation</span></a>@endif
                  @if(Auth::user()->utype == 'admin' || Auth::user()->utype == 'rd')
                  <li class="parent"><a href="#"><i class="icon mdi mdi-accounts"></i><span>Users</span></a>
                    <ul class="sub-menu">
                      <li><a href="{{url('/users_lists')}}">Lists</a>
                      </li>
                      @if(Auth::user()->utype == 'admin')
                      <li><a href="{{url('/users_registration')}}">Register New</a>
                      </li>
                      <li><a href="{{url('/students_registration')}}">Register Student</a>
                      </li>
                      @endif
                    </ul>
                  </li>
                  <!-- <li><a href="{{url('/holidays')}}"><i class="icon mdi mdi-calendar"></i><span>Holidays</span></a> -->
                  @endif
                  {{--  <li><a target="_blank" href="{{url('/search_items')}}"><i class="icon mdi mdi-keyboard"></i><span>Frontdesk</span></a>  --}}
                  <!-- </li> -->

                  @if(Auth::user()->utype == 'user' || Auth::user()->utype == 'rd' || Auth::user()->utype == 'admin')
                    <li><a href="{{url('/solution')}}"><i class="icon mdi mdi-globe"></i><span>Alternative Solution</span></a></li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
          <div class="progress-widget text-center" style="font-size:15px;">
              Developed By: <br/><a href="###" style="font-size:20px;" id="developer_name"><b><i>Balbin, Eugenio & Niro</i></b></a>
          </div>
        </div>
      </div>
      <div class="be-content">
        <div class="main-content container-fluid">
        {{--  Inside Start  --}}
              @yield('content')
        {{--  Inside End  --}}
        </div>
      </div>
    </div>
    {{--  <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>  --}}
    {{--  <script src="{{ asset('property_inventory_theme/html/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>  --}}
    {{--  <script src="{{ asset('property_inventory_theme/html/assets/js/main.js') }}" type="text/javascript"></script>  --}}
    {{--  <script src="{{ asset('property_inventory_theme/html/assets/lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>  --}}
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery-flot/jquery.flot.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery-flot/jquery.flot.pie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery-flot/jquery.flot.resize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery-flot/plugins/jquery.flot.orderBars.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery-flot/plugins/curvedLines.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery.sparkline/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/countup/countUp.min.js') }}" type="text/javascript"></script>
    {{--  <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>  --}}
    {{--  <script src="{{ asset('property_inventory_theme/html/assets/lib/jqvmap/jquery.vmap.min.js') }}" type="text/javascript"></script>  --}}
    {{--  <script src="{{ asset('property_inventory_theme/html/assets/lib/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>  --}}
    {{--  <script src="{{ asset('property_inventory_theme/html/assets/js/app-dashboard.js') }}" type="text/javascript"></script>  --}}
    {{--  <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();
      	App.dashboard();
      
      });
    </script>  --}}

    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/js/main.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery-ui/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/jquery.nestable/jquery.nestable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/moment.js/min/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/lib/bootstrap-slider/js/bootstrap-slider.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/js/app-form-elements.js') }}" type="text/javascript"></script>
    <script src="{{ asset('property_inventory_theme/html/assets/js/app-dashboard.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            App.init();
            setInterval(function(){
                if($('#developer_name').css('color') == 'rgb(66, 133, 244)'){
                    $('#developer_name').css('color','#00A8EC');
                }else{
                    $('#developer_name').css('color','rgb(66, 133, 244)');
                }
            }, 500);
        });
    </script>
  </body>
</html>