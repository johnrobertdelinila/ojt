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
@foreach($post_maintenance as $posts_maintenance)
    @if($posts_maintenance->maintenance_date <= date('Y-m-d', strtotime(date('Y-m-d H:i:s'))))
        <div role="alert" class="alert alert-danger alert-dismissible">
            <button type="button" data-dismiss="alert" aria-label="Close" class="close">
                <span aria-hidden="true" class="mdi mdi-close"></span>
            </button>
            <span class="icon mdi mdi-alert-triangle"></span>
            <strong>SERVER MAINTENANCE ALERT.</strong> Your system is going slower than usual.
        </div>
    @endif
@endforeach
{{--  MAINTENANCE ALERT  --}}
    <div class="panel panel-default panel-table" style="border:1px solid gray;border-top:3px solid #2E4053;">
        <div class="panel-body table-responsive">
            <div class="form-group" style="margin-bottom:0px;">
            <button class="btn btn-default active btn-lg" id="hide_filter_btn" style="margin:10px;font-size:15px;"><li style="font-size:15px;" class="mdi mdi-settings"></li> Filter Options</button>
            <a class="btn btn-default active btn-lg pull-right" href="{{url('/inventory_registration')}}" style="margin:10px;font-size:15px;"><li style="font-size:15px;font-weight:bold;" class="mdi mdi-plus"></li> Register Item</a>
            {{ Form::Open(['url'=>'inventory_export_excel','method'=>'get']) }}
                <table class="table" id="filter_table">
                    <tr>
                        <td style="width:20%;">
                            <label class="label_bold h4">Seller Name</label>
                            <select name="seller_name" class="form-control" style="padding:0px 0px 0px 10px;">
                                @isset($seller_name)
                                    <option value="{{$seller_name}}">{{$seller_name}}</option>
                                @endisset
                                    <option value="">All Sellers</option>
                                    @foreach($post_sellers as $posts_sellers)
                                        <option value="{{$posts_sellers->seller_name}}">{{$posts_sellers->seller_name}}</option>     
                                    @endforeach                               
                            </select>
                        </td>
                        <td style="width:20%;">
                            <label class="label_bold h4">Buyer Name</label>
                            <input type="text" name="buyer_name" class="form-control" value="@isset($buyer_name){{$buyer_name}}@endisset" style="padding:0px 0px 0px 10px;" placeholder="e.g. janine">
                        </td>
                        <td style="width:20%;">
                            <label class="label_bold h4">Item Status</label>
                            <select name="item_status" class="form-control" style="padding:0px 0px 0px 10px;">
                                @isset($item_status)
                                    <option value="{{$item_status}}">{{$item_status}}</option>
                                @endisset
                                    <option value="">All Items</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Released">Released</option> 
                                    <option value="Cashed Out">Cashed Out</option> 
                                    <option value="Cancelled">Cancelled</option> 
                            </select>
                        </td>
                        <td style="width:20%;">
                            <label class="label_bold h4">Date of Action</label>
                            <input type="date" name="date_actioned" class="form-control" value="@isset($date_actioned){{$date_actioned}}@endisset" style="padding:0px 0px 0px 10px;">
                        </td>
                        <td style="width:10%;">
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
                        <td colspan="5">
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
    <div class="panel-heading"> 
        <div class="title"><b>ITEMS LIST</b>
            <span class="label label-default pull-right" style="font-size:17px;padding:5px 10px;background-color:#FFA5A5;font-weight:bold;width:15%;"><i class="icon icon-left mdi mdi-bookmark"></i> Cancelled</span>
            <span class="label label-default pull-right" style="font-size:17px;padding:5px 10px;background-color:#B7B7B7;font-weight:bold;width:15%;"><i class="icon icon-left mdi mdi-bookmark"></i> Cashed Out</span>
            <span class="label label-default pull-right" style="font-size:17px;padding:5px 10px;background-color:#00FFFB;font-weight:bold;width:15%;"><i class="icon icon-left mdi mdi-bookmark"></i> Released</span>
            <span class="label label-default pull-right" style="font-size:17px;padding:5px 10px;background-color:white;font-weight:bold;width:15%;"><i class="icon icon-left mdi mdi-bookmark"></i> Pending</span>
        </div>
    </div>
    <div class="panel-body table-responsive">
        <table class="table table-hover table-bordered h4" style="border-top:1px solid #D9D9D9;">
        <thead>
            <tr>
                <th style="">No.</th>
                <th style="">Seller Name</th>
                <th style="">Buyer Name</th>
                <th style="">Amount</th>
                <th style="">Remarks</th>
                <th style="">Status</th>
                <th style="">Date of Action</th>
                <th style="">Date Created</th>
                <th style="">Action</th>
            </tr>
        </thead>
        <tbody class="no-border-x">
        <?php $item_amount_total = 0; ?>
        @if($post_inventory->count())
            @foreach($post_inventory as $posts_inventory)
                <?php $ctr = $posts_inventory->id; ?>
            @if($posts_inventory->item_status == 'Released')
                <tr style="background-color:#00FFFB;">
            @elseif($posts_inventory->item_status == 'Cashed Out')
                <tr style="background-color:#B7B7B7;">
            @elseif($posts_inventory->item_status == 'Cancelled')
                <tr style="background-color:#FFA5A5;">
            @else
                <tr>
            @endif
                    <?php $item_amount_total = $item_amount_total+$posts_inventory->item_amount; ?>
                    <td style="vertical-align:top;">{{$ctr}}.</td>
                    <td style="vertical-align:top;"><b><i>{{$posts_inventory->seller_name}}</i></b></td>
                    <td style="vertical-align:top;">{{$posts_inventory->buyer_name}}</td>
                    <td style="vertical-align:top;">{{number_format($posts_inventory->item_amount,2)}}</td>
                    <td style="vertical-align:top;">{{$posts_inventory->item_remarks}}</td>
                    <td style="vertical-align:top;">{{$posts_inventory->item_status}}</td>
                    <td style="vertical-align:top;">@if($posts_inventory->date_actioned == '-') {{$posts_inventory->date_actioned}} @else {{date_format(date_create($posts_inventory->date_actioned),"Y/m/d g:i A")}} @endif</td>
                    <td style="vertical-align:top;">{{date_format(date_create($posts_inventory->date_created),"Y/m/d g:i A")}}</td>
                    <td style="vertical-align:top;">
                    @if($posts_inventory->item_status == 'Pending')
                        <div class="btn-group btn-hspace">
                        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon icon-left mdi mdi-label"></i> Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="{{url('release_item/'.$posts_inventory->id)}}" onclick="return confirm('ITEM NUMBER:  {{$ctr}}\nSELLER NAME:  {{$posts_inventory->seller_name}}\nBUYER NAME:  {{$posts_inventory->buyer_name}}\nAMOUNT:  {{number_format($posts_inventory->item_amount,2)}}\n\nDo you want to RELEASE?');"><i class="icon icon-left mdi mdi-dropbox"></i> Release</a></li>
                                <li><a href="###" id="item_edit<?php echo $ctr; ?>" data-toggle="modal" data-target="#mod-success"><i class="icon icon-left mdi mdi-edit"></i> Edit</a></li>
                                <li><a href="{{url('qrcode/'.$posts_inventory->seller_id)}}" target="_blank"><i class="icon icon-left mdi mdi-print"></i> QR Code/s</a></li>
                                <li><a href="{{url('cancel_item/'.$posts_inventory->id)}}" onclick="return confirm('DO YOU WANT TO CANCEL ITEM NUMBER {{$ctr}}?');"><i class="icon icon-left mdi mdi-close-circle"></i> Cancel</a></li>
                            </ul>
                        </div>
                        <script>
                            $(document).ready(function(){
                                $('#item_edit<?php echo $ctr; ?>').on('click',function(event){
                                    $('#buyer_name_popup').val('<?php echo str_replace("'","\'",$posts_inventory->buyer_name); ?>');
                                    $('#item_amount_popup').val('<?php echo $posts_inventory->item_amount; ?>');
                                    $('#item_id_popup').val('<?php echo $posts_inventory->id; ?>');
                                    $('#item_remarks_popup').val('<?php echo str_replace("'","\'",stripslashes(str_replace("\r\n"," ", $posts_inventory->item_remarks))); ?>');
                                    $('#seller_name_popup').append('<option value="<?php echo $posts_inventory->seller_id; ?>" selected><?php echo str_replace("'","\'",$posts_inventory->seller_name); ?></option>'); 
                                });
                            });
                        </script>
                    @elseif($posts_inventory->item_status == 'Released')
                        <div class="btn-group btn-hspace">
                        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon icon-left mdi mdi-label"></i> Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="{{url('cashedout_item/'.$posts_inventory->id)}}" onclick="return confirm('CASHED OUT ITEM NUMBER {{$ctr}}?');"><i class="icon icon-left mdi mdi-money"></i> Cashed Out</a></li>
                                <li><a href="{{url('cashedout_all_item/'.$posts_inventory->seller_id)}}" onclick="return confirm('CASHED OUT ALL ITEMS OF {{$posts_inventory->seller_name}}?');"><i class="icon icon-left mdi mdi-money"></i> Cashed Out All</a></li>
                                <li><a href="{{url('pending_item/'.$posts_inventory->id)}}" onclick="return confirm('BACK TO PENDING ITEM NUMBER {{$ctr}}?');"><i class="icon icon-left mdi mdi-undo"></i> Back to Pending</a></li>
                            </ul>
                        </div>
                    @elseif($posts_inventory->item_status == 'Cashed Out')
                        <div class="btn-group btn-hspace">
                        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon icon-left mdi mdi-label"></i> Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="{{url('pending_item/'.$posts_inventory->id)}}" onclick="return confirm('BACK TO PENDING ITEM NUMBER {{$ctr}}?');"><i class="icon icon-left mdi mdi-undo"></i> Back to Pending</a></li>
                            </ul>
                        </div>
                    @elseif($posts_inventory->item_status == 'Cancelled')
                        <div class="btn-group btn-hspace">
                        <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><i class="icon icon-left mdi mdi-label"></i> Action <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                            <ul role="menu" class="dropdown-menu">
                                <li><a href="{{url('pending_item/'.$posts_inventory->id)}}" onclick="return confirm('BACK TO PENDING ITEM NUMBER {{$ctr}}?');"><i class="icon icon-left mdi mdi-undo"></i> Back to Pending</a></li>
                            </ul>
                        </div>
                    @endif
                    </td>
                </tr>
            @endforeach
                <tr>
                    <td colspan="3" style="font-size:15px;text-align:right;"><i class="icon icon-left mdi mdi-help"></i> <b>TOTAL:</b></td>
                    <td colspan="1"><b style="font-size:15px;">{{number_format($item_amount_total,2)}}</b></td>
                    <td colspan="5"></td>
                </tr>
                <tr>
                    <td colspan="11" style="text-align:center;">
                    @isset($per_page)
                        {{ $post_inventory->appends(['seller_name'=>$seller_name,'buyer_name'=>$buyer_name,'item_status'=>$item_status,'date_actioned'=>$date_actioned,'per_page'=>$per_page,'filter'=>'Filter'])->links() }}
                    @else
                        {{ $post_inventory->links() }}
                    @endisset
                    </td>
                </tr>
        @else
                <tr><td colspan="11" style="text-align:center;background-color:pink;font-weight:bold;">No Record</td></tr>
        @endif
        </tbody>
        </table>
        {{--  <a class="btn btn-space btn-primary btn-lg" href="{{ URL::previous() }}" style="margin-left:20px;margin-bottom:20px;"><i class="icon icon-left mdi mdi-arrow-left"></i> BACK</a>  --}}
    </div>
    </div>
</div>
</div>
{{--  MODAL EDIT  --}}
    <div id="mod-success" tabindex="-1" role="dialog" style="" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="padding-bottom:0px;">
            <button type="button" data-dismiss="modal" aria-hidden="true" class="close"><span class="mdi mdi-close"></span></button>
          </div>
          <div class="modal-body">
                    {{--  FORM CONTENT  --}}
                    <form method="post" action="update_item">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Seller Name</label>
                            <select name="seller_id" id="seller_name_popup" class="form-control">
                                @foreach($post_sellers as $posts_sellers)
                                    <option value="{{$posts_sellers->id}}">{{$posts_sellers->seller_name}}</option>     
                                @endforeach      
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Buyer Name</label>
                            <input type="text" name="buyer_name" id="buyer_name_popup" placeholder="Buyer Name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" name="item_amount" id="item_amount_popup" placeholder="Amount" class="form-control">
                            <input type="hidden" name="item_id" id="item_id_popup" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea name="item_remarks" id="item_remarks_popup" placeholder="Remarks" class="form-control"></textarea>
                        </div>
                        <div class="row xs-pt-15">
                            <div class="col-xs-12">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-primary">Update</button>
                                    <button type="button" data-dismiss="modal" class="btn btn-space btn-default">Cancel</button>
                                </p>
                            </div>
                        </div>
                    </form>
                    {{--  FORM CONTENT  --}}
          </div>
        </div>
      </div>
    </div>
{{--  MODAL EDIT  --}}
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