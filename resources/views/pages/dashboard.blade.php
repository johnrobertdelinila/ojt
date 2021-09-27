@extends('layouts.app')

@section('content')
<div class="row">
    <a href="{{url('travel_lists')}}" style="color:black;">
    <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="widget widget-tile" style="border:1px solid gray;box-shadow: -3px 3px 3px gray;">
                    {{--  <div id="spark3" class="chart sparkline"></div>  --}}
                    <i class="icon mdi mdi-storage" style="font-size:50px;padding:0px;position:absolute;color:#2E4053 ;"></i>
                    <div class="data-info">
                    <div class="desc">ALL TRAVEL ORDER</div>
                    <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="{{$post_all}}" class="number">0</span>
                    </div>
                    </div>
                </div>
    </div>
    </a>
    <a href="{{url('travel_filter?employee_name=&destination=&travel_status=Pending&departure=&arrival=&per_page=10&filter=Print')}}" style="color:black;">
    <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="widget widget-tile" style="border:1px solid gray;box-shadow: -3px 3px 3px gray;">
                    {{--  <div id="spark4" class="chart sparkline"></div>  --}}
                    <i class="icon mdi mdi-time-countdown" style="font-size:50px;padding:0px;position:absolute;color:maroon;"></i>
                    <div class="data-info">
                    <div class="desc">PENDING</div>
                    <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="{{$post_pending}}" class="number">0</span>
                    </div>
                    </div>
                </div>
    </div>
    </a>
    <a href="{{url('travel_filter?employee_name=&destination=&travel_status=Recommended+For+Approval&departure=&arrival=&per_page=10&filter=Print')}}" style="color:black;">
    <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="widget widget-tile" style="border:1px solid gray;box-shadow: -3px 3px 3px gray;">
                    {{--  <div id="spark1" class="chart sparkline"></div>  --}}
                    <i class="icon mdi mdi-assignment-check" style="font-size:50px;padding:0px;position:absolute;color:orange;"></i>
                    <div class="data-info">
                    <div class="desc" style="margin-left:-100px;">RECOMMENDED FOR APPROVAL</div>
                    <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="{{$post_recommended_for_approval}}" class="number">0</span>
                    </div>
                    </div>
                </div>
    </div>
    </a>
    <a href="{{url('travel_filter?employee_name=&destination=&travel_status=Approved&departure=&arrival=&per_page=10&filter=Print')}}" style="color:black;">
    <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="widget widget-tile" style="border:1px solid gray;box-shadow: -3px 3px 3px gray;">
                    {{--  <div id="spark1" class="chart sparkline"></div>  --}}
                    <i class="icon mdi mdi-assignment-check" style="font-size:50px;padding:0px;position:absolute;color:green;"></i>
                    <div class="data-info">
                    <div class="desc">APPROVED</div>
                    <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="{{$post_approved}}" class="number">0</span>
                    </div>
                    </div>
                </div>
    </div>
    </a>
    <a href="{{url('travel_filter?employee_name=&destination=&travel_status=Disapproved&departure=&arrival=&per_page=10&filter=Print')}}" style="color:black;">
    <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="widget widget-tile" style="border:1px solid gray;box-shadow: -3px 3px 3px gray;">
                    {{--  <div id="spark4" class="chart sparkline"></div>  --}}
                    <i class="icon mdi mdi-close-circle" style="font-size:50px;padding:0px;position:absolute;color:red;"></i>
                    <div class="data-info">
                    <div class="desc">DISAPPROVED</div>
                    <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="{{$post_disapproved}}" class="number">0</span>
                    </div>
                    </div>
                </div>
    </div>
    </a>
    <a href="{{url('sellers_lists')}}" style="color:black;">
    <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="widget widget-tile" style="border:1px solid gray;box-shadow: -3px 3px 3px gray;">
                    {{--  <div id="spark2" class="chart sparkline" style="color:black;"></div>  --}}
                    <i class="icon mdi mdi-account" style="font-size:50px;padding:0px;position:absolute;color:darkblue;"></i>
                    <div class="data-info">
                    <div class="desc">USERS</div>
                    <div class="value"><span class="indicator indicator-equal mdi mdi-chevron-right"></span><span data-toggle="counter" data-end="{{$post_users}}" data-suffix="" class="number">0</span>
                    </div>
                    </div>
                </div>
    </div>
    </a>
    
    {{--  <div class="col-xs-12 col-md-6 col-lg-3">
                <div class="widget widget-tile" style="border:1px solid gray;box-shadow: -3px 3px 3px gray;">
                    <div id="spark4" class="chart sparkline"></div>
                    <div class="data-info">
                    <div class="desc">Sample</div>
                    <div class="value"><span class="indicator indicator-negative mdi mdi-chevron-down"></span><span data-toggle="counter" data-end="113" class="number">0</span>
                    </div>
                    </div>
                </div>
    </div>  --}}
          {{--  <div class="col-md-3">
                  <p class="xs-mt-10 xs-mb-10">
                    <button class="btn btn-lg btn-success" style="width:100%;"><i class="icon icon-left mdi mdi-refresh-sync"></i> SYSTEM UPDATE</button>
                  </p>
          </div>  --}}
</div>
{{--  <a href="{{url('export')}}">Export</a>  --}}
{{--  INITIALIZE FORM DASHBOARD  --}}
    <script type="text/javascript">
        $(document).ready(function(){
            App.dashboard();
        });
    </script>
@endsection