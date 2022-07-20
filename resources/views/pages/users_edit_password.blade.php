@extends('layouts.app')

@section('content')
<div class="row">
    <div class="main-content container-fluid">
        <div class="user-profile">
        <div class="row">
            @foreach($post_users_particular as $posts_users_particular)
            @if($posts_users_particular->id == Auth::user()->id || Auth::user()->utype == 'admin')
            {{--  user profile  --}}
            <div class="col-md-5">
            <div class="user-display" style="border:1px solid gray;border-top:3px solid green;">
                <div class="user-display-bg"><img src="{{ asset('property_inventory_theme/html/assets/img/timeline.jpg') }}" style="height:200px;" alt="Profile Background"></div>
                <div class="user-display-bottom">
                {{--  profile picture  --}}
                    <div class="user-display-avatar">
                        @if($posts_users_particular->image_photo == '' || $posts_users_particular->image_photo == 'undefined')
                            <img src="{{ asset('property_inventory_theme/html/assets/img/avatar-150.png') }}" id="profile_picture" alt="Avatar">
                        @elseif(strpos($posts_users_particular->image_photo, 'http://') !== false || strpos($posts_users_particular->image_photo, 'https://') !== false)
                            <td class="user-avatar"> <img src="{{url($posts_users_particular->image_photo)}}" alt="Avatar"></td>
                        @else
                            <img src="{{ asset('images/'.$posts_users_particular->image_photo) }}" id="profile_picture" alt="Avatar">
                        @endif
                    </div>            
                {{--  profile picture  --}}
                <div class="user-display-info">
                    <div class="name">{{ $posts_users_particular->name }}</div>
                    <div class="nick"><span class="mdi mdi-account"></span> {{ $posts_users_particular->email }}</div>
                </div><br/>
                <div class="row user-display-details">
                    <div class="col-xs-6">
                        <form type="post" action="profile_picture_form" id="profile_picture_form">
                        @csrf
                            <span class="input-group-addon">Profile Picture</span>
                            <input type="text" name="id" value="{{$posts_users_particular->id}}" readonly hidden>
                            <input type="file" accept="image/*" onchange="$('#profile_picture_form').submit();" id="profile_picture_input" name="image_photo" class="form-control">
                        </form>
                    </div>
                    <div class="col-xs-6">
                        <form type="post" action="signature_form" id="signature_form">
                        @csrf
                            <span class="input-group-addon">E-Signature</span>
                            <input type="text" name="id" value="{{$posts_users_particular->id}}" readonly hidden>
                            <input type="file" accept="image/*" onchange="$('#signature_form').submit();" id="profile_picture_input" name="image_photo" class="form-control">
                        </form>
                    </div>
                    @if(Auth::user()->utype == 'admin')
                        <div class="col-xs-6">
                            <a href="{{url('users_resetpassword/'.$posts_users_particular->id)}}" class="btn btn-space btn-danger btn-lg" style="width:100%;">Reset Password</a>
                        </div>
                    @endif
                </div><br/>
                @if(session('suc'))
                    <div role="alert" class="alert alert-success alert-dismissible">
                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-check"></span>{{session('suc')}}</u></b>.
                    </div>
                @endif
                @if(session('suc2'))
                    <div role="alert" class="alert alert-success alert-dismissible">
                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-check"></span>{{session('suc2')}}</u></b>
                    </div>
                @endif
                @if(session('err2'))
                    <div role="alert" class="alert alert-danger alert-dismissible">
                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button>{{session('err2')}}</u></b>
                    </div>
                @endif
                <form onsubmit="return confirm('Do you want to proceed?');" method="get" action="{{url('/change_information/'.$posts_users_particular->id)}}">
                    <div class="row" style="font-size:16px;text-align:left;font-weight:bold;margin-bottom:10px;padding-left:20px;">Information</div>
                    <div class="input-group xs-mb-15"><span class="input-group-addon">Name:</span>
                        <input type="text" placeholder="Username" name="name" class="form-control" value="{{$posts_users_particular->name}}">
                    </div>
                    <div class="input-group xs-mb-15"><span class="input-group-addon">Deployed Agency:</span>
                        <input type="text" placeholder="Position" name="position" class="form-control" value="{{$posts_users_particular->position}}">
                    </div>
                    <div class="input-group xs-mb-15"><span class="input-group-addon">Course:</span>
                        <input type="text" placeholder="Division" name="agency" class="form-control" value="{{$posts_users_particular->agency}}">
                    </div>
                    @if(Auth::user()->utype == 'admin')
                        <button type="submit" class="btn btn-primary btn-md">Save Changes <i class="icon mdi mdi-floppy"></i></button>
                    @endif
                    <br/><br/>
                </form>
                <form onsubmit="return confirmthis();" method="get" action="{{url('/change_password/'.$posts_users_particular->id)}}">
                    <div class="row" style="font-size:16px;text-align:left;font-weight:bold;margin-bottom:10px;padding-left:20px;">Change Password</div>
                    <div class="input-group xs-mb-15"><span class="input-group-addon">Username:</span>
                        <input type="text" placeholder="Username" class="form-control" value="{{$posts_users_particular->email}}" readonly>
                    </div>
                    <input type="password" class="form-control tbox" name="old_password" placeholder="Old Password" required>
                    <input type="password" class="form-control tbox" name="new_password" placeholder="New Password" id="new_password" required>
                    <input type="password" class="form-control tbox" placeholder="Confirm New Password" id="confirm_password" required>
                    <button type="submit" class="btn btn-primary btn-md">Change Password <i class="icon mdi mdi-floppy"></i></button>
                    <br/><br/>
                </form>
                @if(Auth::user()->utype == 'admin')
                    <form method="post" onsubmit="return confirm_overtime();" action="set_overtime">
                    @csrf
                        <div class="row" style="font-size:16px;text-align:left;font-weight:bold;margin-bottom:10px;padding-left:20px;">Set Overtime</div>
                        <input type="hidden" name="id" class="form-control" value="{{$posts_users_particular->id}}" readonly>
                        <div class="input-group xs-mb-15"><span class="input-group-addon">Start Date:</span>
                            <input type="date" name="ot_start" id="ot_start" class="form-control" value="{{$posts_users_particular->ot_start}}" required>
                        </div>
                        <div class="input-group xs-mb-15"><span class="input-group-addon">End Date:</span>
                            <input type="date" name="ot_end" id="ot_end" class="form-control" value="{{$posts_users_particular->ot_end}}" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-md">Set Overtime <i class="icon mdi mdi-floppy"></i></button>
                    </form>
                @endif
                </div>
            </div>
            </div>
            {{--  user profile  --}}
            @endif
            @endforeach
            
        </div>
        </div>
    </div>
</div>
<script>
    function confirmthis(){
        if(document.getElementById("new_password").value == document.getElementById("confirm_password").value){ return true; }else{ alert('Mismatch Password!'); return false; }
    }
    function confirm_overtime(){
        if(confirm('Do you want to proceed?') == true){
            var ot1 = document.getElementById('ot_start').value;
            var ot2 = document.getElementById('ot_end').value;
            if(ot1 <= ot2){
                return true;
            }else{
                alert('Start Date Must Greater Than End Date!');
                return false;
            }
        }else{
            return false;
        }
    }
</script>
<script>
    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
        $('#profile_picture').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
    }

    $("#profile_picture_input").change(function() {
    readURL(this);
    });
</script>

<script>
$(document).ready(function(){
	$('#profile_picture_form').on('submit',function(event){
            event.preventDefault();
		$.ajax({
            url:"{{ route('profile_picture_form.action') }}",
			method:"POST",
            data:new FormData(this),
			dataType:'JSON',
			contentType: false,
			cache: false,
			processData: false,
			success:function(data){
                alert('Successfully Changed Your Profile Picture!');
			}
		});
	});

    $('#signature_form').on('submit',function(event){
            event.preventDefault();
		$.ajax({
            url:"{{ route('signature_form.action') }}",
			method:"POST",
            data:new FormData(this),
			dataType:'JSON',
			contentType: false,
			cache: false,
			processData: false,
			success:function(data){
                alert('Successfully Uploaded E-Signature!');
			}
		});
	});
});
</script>
@endsection