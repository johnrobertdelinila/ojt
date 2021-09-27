@extends('layouts.app')

@section('content')
<div class="row">
    <!--Hover table-->
    <div class="col-sm-8">
        <div class="panel panel-default panel-table" style="border:1px solid gray;border-top:3px solid green;">
        <div class="panel-heading">Users List
            <div class="tools"></div>
        </div>
        <div class="panel-body table-responsive">
            <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Username</th>
                    <th>UserType</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach($post_users as $posts_users)
                <tr>
                    @if($posts_users->image_photo == '' || $posts_users->image_photo == 'undefined')
                        <td class="user-avatar"> <img src="{{url('property_inventory_theme/html/assets/img/avatar1.png')}}" alt="Avatar">{{ $posts_users->name }}</td>
                    @elseif(strpos($posts_users->image_photo, 'http://') !== false || strpos($posts_users->image_photo, 'https://') !== false)
                        <td class="user-avatar"> <img src="{{url($posts_users->image_photo)}}" alt="Avatar">{{ $posts_users->name }}</td>
                    @else
                        <td class="user-avatar"> <img src="{{url('images/'.$posts_users->image_photo)}}" alt="Avatar">{{ $posts_users->name }}</td>
                    @endif
                    <td>{{ $posts_users->email }}</td>
                    <td>{{ $posts_users->utype }}</td>
                    <td>{{ $posts_users->status }}</td>
                    <td class="actions" style="text-align:left;">
                    @if($posts_users->utype!='admin')
                            <a href="{{url('users_edit_password/'.$posts_users->id)}}" class="btn btn-md btn-warning"><i class="mdi mdi-edit">&nbsp;<span style="font-family:tahoma;">Edit</span></i></a>&nbsp;&nbsp;&nbsp;
                        @if($posts_users->status == 'Active')
                            <a href="{{url('users_deactivated/'.$posts_users->id)}}" class="btn btn-md btn-danger"><i class="mdi mdi-power">&nbsp;<span style="font-family:tahoma;">Deactivate</span></i></a>
                        @else
                            <a href="{{url('users_activate/'.$posts_users->id)}}" class="btn btn-md btn-success"><i class="mdi mdi-refresh-sync">&nbsp;<span style="font-family:tahoma;">Activate</span></i></a>
                        @endif
                    @else
                    -
                    @endif

                    </td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="5" class="text-center">{{ $post_users->links() }}</td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
@endsection