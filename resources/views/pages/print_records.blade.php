<style>

@media print {
    @page {
        margin-top: 0;
        margin-bottom: 0;
    }
    body {
        margin-top: .5in;
    }
}

</style>

<p id="p_button">
    <a href="{{ URL::previous() }}"  style="background-color:maroon;padding:10px 30px;color:white;cursor:pointer;border:1px solid black;text-decoration:none;font-family:calibri;">BACK</a>
    <a href="##" onclick="print_me();" style="background-color:green;padding:10px 30px;color:white;cursor:pointer;border:1px solid black;text-decoration:none;font-family:calibri;">PRINT</a>
</p>
<table border="1" style="width:1000px;border-collapse: collapse;border:1px solid gray;font-family:courier new;font-size:14px;">
<thead>
    <tr>
        <th colspan="8" style="padding:10px 0px;">
            <img style="width:100px;box-shadow:0px 0px 3px black;" src="{{ asset('property_inventory_theme/html/assets/img/OOTD.jpg') }}"><br/>
            <span style="font-size:20px;">OOTD FOR LESS</span><br/>
            <?php date_default_timezone_set("Asia/Manila"); ?>
            {{date_format(date_create(date("Y-m-d h:i:sa")),"F jS Y, l g:i A")}}
        </th>
    </tr>
    <tr>
        <th style="padding:10px 0px;">No.</th>
        <th style="">Seller Name</th>
        <th style="">Buyer Name</th>
        <th style="">Amount</th>
        <th style="">Remarks</th>
        <th style="">Status</th>
        <th style="">Date of Action</th>
        <th style="">Date Created</th>
    </tr>
</thead>
<tbody class="no-border-x">
<?php $item_amount_total = 0; ?>
@if($post_inventory->count())
    @foreach($post_inventory as $posts_inventory)
        <?php $ctr = $posts_inventory->id; ?>
        <tr>
            <?php $item_amount_total = $item_amount_total+$posts_inventory->item_amount; ?>
            <td style="vertical-align:top;">{{$ctr}}.</td>
            <td style="vertical-align:top;"><b><i>{{$posts_inventory->seller_name}}</i></b></td>
            <td style="vertical-align:top;">{{$posts_inventory->buyer_name}}</td>
            <td style="vertical-align:top;">₱{{number_format($posts_inventory->item_amount,2)}}</td>
            <td style="vertical-align:top;">{{$posts_inventory->item_remarks}}</td>
            <td style="vertical-align:top;">{{$posts_inventory->item_status}}</td>
            <td style="vertical-align:top;">@if($posts_inventory->date_actioned == '-') {{$posts_inventory->date_actioned}} @else {{date_format(date_create($posts_inventory->date_actioned),"Y/m/d g:i A")}} @endif</td>
            <td style="vertical-align:top;">{{date_format(date_create($posts_inventory->date_created),"Y/m/d g:i A")}}</td>
        </tr>
    @endforeach
        <tr>
            <td colspan="3" style="font-size:15px;text-align:right;"><i class="icon icon-left mdi mdi-help"></i> <b>TOTAL:</b></td>
            <td colspan="1"><b style="font-size:15px;">₱{{number_format($item_amount_total,2)}}</b></td>
            <td colspan="5"></td>
        </tr>
@else
        <tr><td colspan="11" style="text-align:center;background-color:pink;font-weight:bold;">No Record</td></tr>
@endif
</tbody>
</table>

<script>
    function print_me(){
        document.getElementById("p_button").style.display = "none";
        window.print();
        document.getElementById("p_button").style.display = "block";
    }
</script>