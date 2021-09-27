@extends('layouts.app')

@section('content')
<div class="row">
    <div class="main-content container-fluid">
        <div class="user-profile">
        <div class="row">
            @foreach($post_users_particular as $posts_users_particular)
            {{--  user profile  --}}
            <div class="col-md-5">
            <div class="user-display" style="border:1px solid gray;border-top:3px solid green;">
                <div class="user-display-bg"><img src="{{ asset('property_inventory_theme/html/assets/img/timeline.jpg') }}" style="height:200px;" alt="Profile Background"></div>
                <div class="user-display-bottom">
                @if($posts_users_particular->gender == 'Male')
                    <div class="user-display-avatar"><img src="{{ asset('property_inventory_theme/html/assets/img/avatar1.png') }}" alt="Avatar"></div>
                @else
                    <div class="user-display-avatar"><img src="{{ asset('property_inventory_theme/html/assets/img/avatar6.png') }}" alt="Avatar"></div>
                @endif
                <div class="user-display-info">
                    <div class="name">{{ $posts_users_particular->name }}</div>
                    <div class="nick"><span class="mdi mdi-account"></span> {{ $posts_users_particular->email }}</div>
                </div>
                <div class="row user-display-details">
                    <div class="col-xs-4">
                    <div class="title">Inserted</div>
                    <div class="counter">26</div>
                    </div>
                    <div class="col-xs-4">
                    <div class="title">Deleted</div>
                    <div class="counter">26</div>
                    </div>
                    <div class="col-xs-4">
                    <div class="title">Updated</div>
                    <div class="counter">26</div>
                    </div>
                </div>
                @if(session('suc'))
                    <div role="alert" class="alert alert-success alert-dismissible">
                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-check"></span>{{session('suc')}}</u></b>.
                    </div>
                @endif
                <div class="row user-display-details">
                    <div class="col-xs-6 col-xs-offset-6">
                        <a href="{{url('users_resetpassword/'.$posts_users_particular->id)}}" class="btn btn-space btn-danger" style="width:100%;">Reset Password</a>
                    </div>
                </div>
                </div>
            </div>
            </div>
            {{--  user profile  --}}
            @endforeach
            <div class="col-md-7">
            <div class="widget widget-fullwidth widget-small">
                <table class="table table-striped table-hover" style="border:1px solid gray;border-top:3px solid green;">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Username</th>
                            <th>UserType</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($post_users as $posts_users)
                            <tr>
                                @if($posts_users->gender == 'Male')
                                    <td class="user-avatar"> <img src="{{url('property_inventory_theme/html/assets/img/avatar1.png')}}" alt="Avatar">{{ $posts_users->name }}</td>
                                @else
                                    <td class="user-avatar"> <img src="{{url('property_inventory_theme/html/assets/img/avatar6.png')}}" alt="Avatar">{{ $posts_users->name }}</td>
                                @endif
                                <td>{{ $posts_users->email }}</td>
                                <td>@if($posts_users->utype==0) Administrator @else User @endif</td>
                                <td class="actions" style="text-align:left;">
                                @if($posts_users->utype!=0)
                                        <a href="{{url('users_edit/'.$posts_users->id)}}" class="icon"><i class="mdi mdi-edit" style="color:orange;font-size:14px;">&nbsp;<span style="font-family:tahoma;">Edit</span></i></a>&nbsp;&nbsp;&nbsp;
                                    @if($posts_users->status == 'Active')
                                        <a href="{{url('users_deactivated/'.$posts_users->id)}}" class="icon"><i class="mdi mdi-power" style="color:maroon;font-size:14px;">&nbsp;<span style="font-family:tahoma;">Deactivate</span></i></a>
                                    @else
                                        <a href="{{url('users_activate/'.$posts_users->id)}}" class="icon"><i class="mdi mdi-refresh-sync" style="color:green;font-size:14px;">&nbsp;<span style="font-family:tahoma;">Activate</span></i></a>
                                    @endif
                                @else
                                -
                                @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection