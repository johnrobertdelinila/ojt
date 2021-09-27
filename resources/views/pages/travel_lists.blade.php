@extends('layouts.app')

@section('content')
<div class="row">
{{--  <div class="col-md-12 panel panel-default panel-border-color panel-border-color-primary">  --}}
{{--  @if(session('suc_released'))
    <script>
        alert('Successfully Released!');
    </script>
@endif
@if(session('suc_cancelled'))
    <script>
        alert('Successfully Cancelled!');
    </script>
@endif  --}}
{{--  FILTER  --}}
<div class="col-md-12">
{{--  MAINTENANCE ALERT  --}}
<?php date_default_timezone_set('Asia/Manila'); ?>
{{--  MAINTENANCE ALERT  --}}
    <div class="panel panel-default panel-table" style="border:1px solid gray;border-top:3px solid #2E4053;">
        <div class="panel-body table-responsive">
            <div class="form-group" style="margin-bottom:0px;">
            <button class="btn btn-default active btn-lg" id="hide_filter_btn" style="margin:10px;font-size:15px;"><li style="font-size:15px;" class="mdi mdi-settings"></li> Filter Options</button>
            <a class="btn btn-default active btn-lg pull-right" href="{{url('/travel_registration')}}" style="margin:10px;font-size:15px;"><li style="font-size:15px;font-weight:bold;" class="mdi mdi-plus"></li> Register New</a>
            {{ Form::Open(['url'=>'travel_filter','method'=>'get']) }}
                <table class="table" id="filter_table">
                    <tr>
                        <td style="width:20%;">
                            <label class="label_bold h4">Student Name</label>
                            <select name="employee_name" class="form-control select2" style="padding:0px 0px 0px 10px;">
                                @isset($employee_name)
                                    <option value="">All Student</option>
                                    @foreach($post_users as $posts_users)
                                        @if($posts_users->name == $employee_name)
                                            <option value="{{$posts_users->name}}" selected>{{$posts_users->name}}</option>
                                        @else
                                            <option value="{{$posts_users->name}}">{{$posts_users->name}}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="">All Student</option>
                                    @foreach($post_users as $posts_users)
                                        <option value="{{$posts_users->name}}">{{$posts_users->name}}</option>
                                    @endforeach
                                @endisset
                            </select>
                        </td>
                        <td style="width:20%;">
                            <label class="label_bold h4">Destination</label>
                            <input type="text" name="destination" class="form-control" value="@isset($destination){{$destination}}@endisset" style="padding:0px 0px 0px 10px;" placeholder="e.g. Quezon City">
                        </td>
                        <td style="width:20%;">
                            <label class="label_bold h4">Travel Status</label>
                            <select name="travel_status" class="form-control" style="padding:0px 0px 0px 10px;">
                                @isset($travel_status)
                                    <option value="{{$travel_status}}">{{$travel_status}}</option>
                                @endisset
                                    <option value="">All Items</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Recommended For Approval">Recommended For Approval</option> 
                                    <option value="Approved">Approved</option> 
                                    <option value="Disapproved">Disapproved</option> 
                            </select>
                        </td>
                        <td style="width:15%;">
                            <label class="label_bold h4">Departure</label>
                            <input type="date" name="departure" class="form-control" value="@isset($departure){{$departure}}@endisset" style="padding:0px 0px 0px 10px;">
                        </td>
                        <td style="width:15%;">
                            <label class="label_bold h4">Arrival</label>
                            <input type="date" name="arrival" class="form-control" value="@isset($arrival){{$arrival}}@endisset" style="padding:0px 0px 0px 10px;">
                        </td>
                        <td style="width:20%;">
                            <label class="label_bold h4">Per page</label>
                            <select name="per_page" class="form-control" style="padding:0px 0px 0px 10px;">
                                @isset($per_page)
                                    <option value="{{$per_page}}">@if($per_page > 5000) ALL @else {{$per_page}} @endif</option>
                                @endisset
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="500">500</option>
                                    <option value="9999999">ALL</option>
                            </select>
                        </td>
                        {{--  <td style="width:10%;">
                            <label class="label_bold h4">&nbsp;</label>
                            <button name="filter" value="Filter" style="padding:0px;" class="form-control tbox btn btn-space btn-primary"><i class="icon icon-left mdi mdi-filter-list"></i> Filter</button>
                        </td>  --}}
                    </tr>
                    <tr>
                        <td colspan="6">
                            <p class="xs-mt-10 xs-mb-10 pull-right">
                                {{--  <button class="btn btn-space btn-success btn-lg"><i class="icon icon-left mdi mdi-print"></i> PRINT RECORDS</button>  --}}
                                <button name="filter" value="Print" class="btn btn-space btn-primary btn-lg"><i class="icon icon-left mdi mdi-filter-list"></i> Filter</button>
                                <button name="print" value="Filter" class="btn btn-space btn-success btn-lg"><i class="icon icon-left mdi mdi-print"></i> Print</button>
                            </p>
                        </td>
                    </tr>
                </table>
            {{ Form::Close() }}
            </div>
        </div>
    </div>
</div>
{{--  FILTER  --}}
<div class="col-md-12">
    <div class="panel panel-default panel-table" style="border:1px solid gray;border-top:3px solid #2E4053;">
    <div class="panel-body table-responsive">
        <div class="panel-heading"> 
            <div class="title"><b>TRAVEL ORDER LIST</b>
                <span class="label label-default pull-right" style="font-size:17px;padding:5px 10px;background-color:#FF5D5D;font-weight:bold;width:15%;"><i class="icon icon-left mdi mdi-bookmark"></i> Disapproved</span>
                <span class="label label-default pull-right" style="font-size:17px;padding:5px 10px;background-color:#00FFFB;font-weight:bold;width:15%;"><i class="icon icon-left mdi mdi-bookmark"></i> Approved</span>
                <span class="label label-default pull-right" style="font-size:17px;padding:5px 10px;background-color:yellow;font-weight:bold;width:25%;"><i class="icon icon-left mdi mdi-bookmark"></i> Recommended For Approval</span>
                <span class="label label-default pull-right" style="font-size:17px;padding:5px 10px;background-color:white;font-weight:bold;width:15%;"><i class="icon icon-left mdi mdi-bookmark"></i> Pending</span>
            </div>
        </div>
        <table class="table table-hover table-bordered h4" style="border-top:1px solid #D9D9D9;">
        <thead>
            <tr>
                <th style="width:10%;">Travel ID</th>
                <th style="width:20%;">Employee/s</th>
                <th style="width:20%;">Purpose</th>
                <th style="width:20%;">Destination</th>
                <th style="width:10%;">Departure</th>
                <th style="width:10%;">Arrival</th>
                <th style="width:5%;">Travel Status</th>
                <th style="width:5%;">Action</th>
            </tr>
        </thead>

        <tbody class="no-border-x">
            @foreach($post_travelorder as $posts_travelorder)
            @if($posts_travelorder->travel_status == 'PENDING')
            <tr>
            @elseif($posts_travelorder->travel_status == 'RECOMMENDED FOR APPROVAL')
            <tr style="background-color:YELLOW;">
            @elseif($posts_travelorder->travel_status == 'APPROVED')
            <tr style="background-color:#00FFFB;">
            @elseif($posts_travelorder->travel_status == 'DISAPPROVED')
            <tr style="background-color:#FF5D5D;">
            @else
            @endif
                <td>{{$posts_travelorder->travel_id}}</td>
                <td>
                    @foreach($post_travelemployee as $posts_travelemployee)
                        @if($posts_travelemployee->travel_id == $posts_travelorder->travel_id)
                            {{$posts_travelemployee->name}}, 
                        @endif
                    @endforeach
                </td>
                <td>{{$posts_travelorder->purpose}}</td>
                <td>{{$posts_travelorder->destination}}</td>
                <td>{{$posts_travelorder->departure}}</td>
                <td>{{$posts_travelorder->arrival}}</td>
                <td>{{$posts_travelorder->travel_status}}</td>
                <td>
                    <div class="btn-group btn-hspace">
                        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                        <ul role="menu" class="dropdown-menu">
                            <li><a href="{{url('/travel_edit/'.$posts_travelorder->id)}}">View</a></li>
                            @if($posts_travelorder->travel_status == 'APPROVED')
                            <li><a href="###">Print</a></li>
                            @endif
                        </ul>
                    </div>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="11" style="text-align:center;">
                @isset($per_page)
                    {{ $post_travelorder->appends(['destination'=>$destination,'travel_status'=>$travel_status,'departure'=>$departure,'arrival'=>$arrival,'per_page'=>$per_page,'filter'=>'Filter'])->links() }}
                @else
                    {{ $post_travelorder->links() }}
                @endisset
                </td>
            </tr>
        </tbody>

        </table>
    </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function(){
        $('#filter_table').hide();
        $('#hide_filter_btn').click(function(event){
        $('#filter_table').toggle(150);
        });
    });
</script>
{{--  INITIALIZE FORM ELEMENTS  --}}
<script type="text/javascript">
    $(document).ready(function(){
        App.formElements();
    });
</script>
@endsection