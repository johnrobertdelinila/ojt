@extends('layouts.app')

@section('content')
<div class="row">
    <div class="main-content container-fluid">
        <div class="user-profile">
        <div class="row">
            {{--  user profile  --}}
            <div class="col-md-7">
            <div class="widget widget-fullwidth widget-small" style="border:1px solid gray;border-top:3px solid #2E4053;">
                <table class="table table-hover table-bordered h4" style="margin:0px;">
                    <thead>
                        <tr>
                            <th style="text-align:center;font-size:15px;">BUYERS LIST</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($post_buyers as $posts_buyers)
                        <tr>
                            <td><a href="{{url('inventory_export_excel?seller_name=&buyer_name='.$posts_buyers->buyer_name.'&item_status=&date_actioned=&per_page=10&filter=Filter')}}">{{$posts_buyers->buyer_name}}</a></td>
                        </tr>
                    @endforeach
                        <tr>
                            <td style="padding:0px;text-align:center;">{{ $post_buyers->links() }}</td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
            </div>
            {{--  user profile  --}}
        </div>
        </div>
    </div>
</div>
@endsection