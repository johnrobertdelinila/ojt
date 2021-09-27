@extends('layouts.app_plain')

@section('content')
<script src="js/jquery.min.js"></script>
<script src="js/instascan.min.js"></script>
<div class="row">
    <div class="col-sm-5">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
            <div class="panel-body">
                {{--  HEADER LANE AND SEARCH INPUT  --}}
                <form method="get" action="search_items">
                <div class="form-group col-md-12">
                    <h1 style="font-family:lucida calligraphy;color:#FF366F;"><center><b>OOTD for Less</center></b></h1>
                    <label class="h4">
                        <b>BUYER NAME or SELLER NAME &nbsp; <i class="icon icon-left mdi mdi-long-arrow-down"></i></b>
                    </label>
                    <label class="h4 pull-right">
                        <b>PRESS ENTER TO SEARCH</b>
                    </label>
                    <div class="input-group xs-mb-15">
                        <span class="input-group-addon" style="background-color:#428bca;color:white;font-size:25px;">
                            <i class="icon icon-left mdi mdi-search"></i>
                        </span>
                        <input type="text" name="buyer_seller" id="buyer_seller" placeholder="Enter here . . ." class="form-control" autofocus>
                        <button type="submit" id="btn_search" hidden>Search</button>
                    </div>
                </div>
                </form>
                {{--  QRCODE LANE  --}}
                <label class="h4">
                    <b>
                        <img src="{{ asset('property_inventory_theme/html/assets/img/qr.png') }}" style="width:50px;">
                        PLACE YOUR QR CODE HERE &nbsp; <i class="icon icon-left mdi mdi-long-arrow-down"></i>
                    </b>
                </label>
                <video id="preview" style="width:100%;"></video>
                <script type="text/javascript">
                    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
                    scanner.addListener('scan', function (content) {
                        $('#buyer_seller').val(content);
                        $('#btn_search').click();
                    });
                    Instascan.Camera.getCameras().then(function (cameras) {
                        if (cameras.length > 0) {
                        scanner.start(cameras[0]);
                        } else {
                        console.error('No cameras found.');
                        }
                    }).catch(function (e) {
                        console.error(e);
                    });

                </script>
                {{--  FOOTER  --}}
                <div class="form-group col-md-12">
                    <div class="footer-copyright text-center py-3" style="font-size:15px;"> 
                    © <?php
                        $date = new DateTime('now', new DateTimeZone('Asia/Manila'));
                        echo $date->format('Y-m-d');
                    ?> All Rights Reserved<br/>
                    Developed By: <a href="###" id="developer_name" onclick="alert('CONTACT NUMBER\n\nSMART:  09092159941\nGLOBE:  09065867958');" style="font-size:20px;"><b><i>Owens</i></b></a>
                        
                    </div>
                </div>
            </div>
        
        </div>
    </div>
    <div class="col-md-7">
        <div class="panel panel-border-color panel-border-color-primary">
            <div class="panel-body">
                <label class="h1">
                    <i class="icon icon-left mdi mdi-help"></i><b>@if($buyer_seller) {{$buyer_seller}} @else @endif</b>
                </label><br/><br/>
                <table class="table table-hover table-bordered h4">
                    <thead>
                        <tr>
                        <th style="width:5%;"></th>
                        <th style="width:35%;">SELLER</th>
                        <th style="width:35%;">BUYER</th>
                        <th style="width:10%;">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form method="post" action="multi_release_item" onsubmit="return confirm('Do you want to proceed?');">
                        {{ csrf_field() }}
                            <?php $ctr = 0; ?>
                            @foreach($post as $posts)
                            <?php $ctr = $ctr+1; ?>
                                <tr @if($posts->item_bookmark == 'yes') style="background-color:#FDFF66;" @endif>
                                    <td>
                                        <div class="be-checkbox be-checkbox-sm">
                                            <input id="item_id<?php echo $ctr; ?>" value="{{$posts->id}}" name="item_id[]" type="checkbox" @if($ctr == 1) checked @endif>
                                            <label for="item_id<?php echo $ctr; ?>"></label>
                                        </div>
                                    </td>
                                    <td>{{ $posts->seller_name }}</td>
                                    <td>{{ $posts->buyer_name }}</td>
                                    <td>{{ number_format($posts->item_amount,2) }}</td>
                                </tr>
                            @endforeach
                            @if($post->count() < 1)
                                <tr>
                                    <td style="background-color:#FFA5A5;"></td>
                                    <td style="background-color:#FFA5A5;">No Result Found</td>
                                    <td colspan="2" style="background-color:#FFA5A5;">No Result Found</td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="4">
                                        <button type="submit" name="btn_frontdesk" value="release" class="btn btn-lg btn-success"><i class="mdi mdi-dropbox"></i> Release</button>
                                        <button type="submit" name="btn_frontdesk" value="mark" class="btn btn-lg btn-danger"><i class="mdi mdi-bookmark"></i> Bookmark</button>
                                        <button type="submit" name="btn_frontdesk" value="unmark" class="btn btn-lg btn-default active"><i class="mdi mdi-bookmark"></i> Unmark</button>
                                    </td>
                                </tr>
                            @endif
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--
    <footer class="page-footer font-small blue">
        <div class="footer-copyright text-center py-3"> 
        © <?php
            $date = new DateTime('now', new DateTimeZone('Asia/Manila'));
            echo $date->format('Y-m-d');
        ?> All Rights Reserved<br/>
        Developed By: <a href="###" id="developer_name" onclick="alert('CONTACT NUMBER\n\nSMART:  09092159941\nGLOBE:  09065867958');"><b><i>Owens</i></b></a>
            
        </div>
    </footer>
-->
<script>
    $(document).ready(function(){
        setInterval(function(){
            if($('#developer_name').css('color') == 'rgb(66, 133, 244)'){
                $('#developer_name').css('color','#00A8EC');
            }else{
                $('#developer_name').css('color','rgb(66, 133, 244)');
            }
        }, 500);
    });
</script>
@endsection