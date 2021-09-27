@extends('layouts.app')

@section('content')
<div class="row">
    <div class="main-content container-fluid">
        <div class="user-profile">
        <div class="row">
            {{--  user profile  --}}
            <div class="col-md-5">
            <div class="user-display" style="border:1px solid gray;border-top:3px solid #2E4053;">
                <div class="user-display-bottom">
                <div class="row" style="font-size:15px;text-align:center;font-weight:bold;margin-bottom:10px;">SELLER INFORMATION</div>
                @if(session('suc_registered'))
                    <div role="alert" class="alert alert-success alert-dismissible">
                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-check"></span>Successfully Registered Seller <b>{{session('suc_registered')}}</b>!</u></b>
                    </div>
                @endif
                @if(session('suc_updated'))
                    <div role="alert" class="alert alert-success alert-dismissible">
                        <button type="button" data-dismiss="alert" aria-label="Close" class="close"><span aria-hidden="true" class="mdi mdi-close"></span></button><span class="icon mdi mdi-check"></span>Successfully Updated Seller <b>{{session('suc_updated')}}</b>!</u></b>
                    </div>
                @endif

                <form action="sellers_add" method="post" id="frm_seller">
                {{ csrf_field() }}
                    <input type="hidden" class="form-control tbox" value="@if(session('seller_id')){{session('seller_id')}}@endif" name="seller_id" readonly>
                    <input type="text" class="form-control tbox" value="@if(session('seller_name')){{session('seller_name')}}@endif" name="seller_name" placeholder="Name" required autofocus>
                    
                    <div class="input-group xs-mb-15"><span class="input-group-addon">+63</span>
                        <input type="text" maxlength="10" minlength="10" class="form-control tbox" value="@if(session('seller_contact')){{session('seller_contact')}}@endif" name="seller_contact" placeholder="Contact Number">
                    </div>

                    <textarea type="text" class="form-control tbox" name="seller_remarks" placeholder="Remarks">@if(session('seller_remarks')){{session('seller_remarks')}}@endif</textarea>

                    <input type="hidden" class="form-control tbox" value="@if(session('seller_name')){{'update'}}@else{{'insert'}}@endif" name="submit_type" readonly>
                    <button class="btn btn-space btn-primary" id="btn_save"><i class="icon icon-left mdi mdi-floppy"></i> Save</button>
                </form>

                </div>
            </div>
            </div>
            {{--  user profile  --}}
            <div class="col-md-7">
            <div class="widget widget-fullwidth widget-small" style="border:1px solid gray;border-top:3px solid #2E4053;">
                <table class="table table-hover table-bordered h4" style="margin:0px;">
                    <thead>
                        <tr>
                            <th colspan="4" style="text-align:center;font-size:15px;">SELLERS LIST</th>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($post_sellers as $posts_sellers)
                    @if($posts_sellers->seller_status == 'yes')
                        <tr>
                    @else
                        <tr style="background-color:#FFDCE1;">
                    @endif
                            <td><a href="{{url('inventory_export_excel?seller_name='.$posts_sellers->seller_name.'&buyer_name=&item_status=&date_actioned=&per_page=10&filter=Filter')}}">{{$posts_sellers->seller_name}}</a></td>
                            <td>{{$posts_sellers->seller_contact}}</td>
                            <td>{{$posts_sellers->seller_remarks}}</td>
                            <td>
                                <div class="btn-group btn-hspace">
                                <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon icon-left mdi mdi-label"></i> Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                                    <ul role="menu" class="dropdown-menu">
                                        @if($posts_sellers->seller_status == 'yes')
                                            <li><a href="{{url('edit_seller/'.$posts_sellers->id)}}"><i class="icon icon-left mdi mdi-edit"></i> Edit</a></li>
                                            <li><a href="{{url('deactivate_seller/'.$posts_sellers->id)}}" onclick="return confirm('Do you want to deactivate {{$posts_sellers->seller_name}}?');"><i class="icon icon-left mdi mdi-block"></i> Deactivate</a></li>
                                        @else
                                            <li><a href="{{url('activate_seller/'.$posts_sellers->id)}}" onclick="return confirm('Do you want to activate {{$posts_sellers->seller_name}}?');"><i class="icon icon-left mdi mdi-key"></i> Activate</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                        <tr>
                            <td colspan="4" style="padding:0px;text-align:center;">{{ $post_sellers->links() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#frm_seller').on('submit', function(event){
            $('#btn_save').attr('disabled',true);
        });
    });
</script>
@endsection