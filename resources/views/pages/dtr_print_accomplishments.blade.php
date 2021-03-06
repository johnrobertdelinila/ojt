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
tr.noBorder td {
  border: 0;
}
</style>

<p id="p_button">
    {{--  <a href="{{ URL::previous() }}"  style="background-color:maroon;padding:10px 30px;color:white;cursor:pointer;border:1px solid black;text-decoration:none;font-family:calibri;">BACK</a>  --}}
    {{--  <a onclick="print_me();" style="background-color:green;padding:10px 30px;color:white;cursor:pointer;border:1px solid black;text-decoration:none;font-family:calibri;">PRINT</a>  --}}
</p>
<table border="1" cellpadding="5" style="width:1000px;border-collapse: collapse;border:1px solid gray;font-family:tahoma;font-size:15px;">
<thead>
    <tr>
        <th colspan="6" style="padding:5px 0px;font-size:30px;text-shadow: -1px 1px 1px gray;">
            <img style="width:70%;" src="{{ asset('property_inventory_theme/html/assets/img/lorma-colleges.jpg') }}"><br/>
            EMPLOYEE ACCOMPLISHMENTS LOGS
        </th>
    </tr>
    <tr>
        <th colspan="6" style="padding:10px 0px;font-size:20px;">
            @if($employee_name == '') ALL STUDENTS @else {{$employee_name}} @endif<br/>
            <span style="font-size:17px;">From: {{date("F d, Y", strtotime($start_date))}} to {{date("F d, Y", strtotime($end_date))}}</span>
        </th>
    </tr>
    <tr>
        <th style="width:20%;">Date</th>
        <th style="width:85%;">Journal</th>
    </tr>
</thead>
<tbody class="no-border-x" id="myTable">
    <?php 
    $total_accumulated_hours = 0; 
    $start_date_inside = $start_date;
    $end_date_inside = $end_date;
    $table_row = -1;
    ?>
    <?php while (strtotime($start_date_inside) <= strtotime($end_date_inside)) { $table_row = $table_row + 1; ?>
        <tr>
            <td><?php echo date("F d, Y (D)", strtotime($start_date_inside)).'<br/>'; ?></td>
            <td>-</td>
        </tr>
        @foreach($post_dtr as $posts_dtr)
            @if($posts_dtr->date == $start_date_inside)
                <script> document.getElementById("myTable").deleteRow('<?php echo $table_row; ?>'); </script>
                <tr height="12px;">
                    <td>{{date("F d, Y (D)", strtotime($posts_dtr->date))}}</td>
                    <td>{{$posts_dtr->accomplishment}}</td>
                </tr>
            @endif
        @endforeach
        <?php $start_date_inside = date ("Y-m-d", strtotime("+1 day", strtotime($start_date_inside))); } $start_date_inside = $start_date; ?>
</tbody>
</table> 
<div style="width:1000px;font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;font-size:18px;">  

    <div style="margin-top:75px;text-align:center;">
                @if($signature != null)
                    <center><img src="{{ asset('images/'.$signature) }}" width="250" alt="Signature"></center>
                @endif
                <center><span style="border-top:2px solid;font-size:20px;">SIGNATURE OF STUDENT</span></center><br><br>
                <hr style='height:3px;color:#333;background-color:#333;'>
                <span style="font-size:18px;float:left;"><b><i>Verified as to the prescribed office hours</i></b></span><br><br><br>
                @if($head_signature != null)
                    <center><img src="{{ asset('images/'.$head_signature) }}" width="250" alt="Signature"></center>
                @endif
                <center>
                <span style="border-bottom:2px solid;font-size:22px;">@if($section_head == '')  @else {{strtoupper($section_head)}} @endif<br/></span>
                <span style="font-size:20px;"><i>@if($section_head == '')  @else {{strtoupper($agency)}} @endif</i></span>
                </center>
        </div>
    </div>