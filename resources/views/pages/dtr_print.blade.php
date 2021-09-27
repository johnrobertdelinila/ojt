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
    <a href="" onclick="print_me();" style="background-color:green;padding:10px 30px;color:white;cursor:pointer;border:1px solid black;text-decoration:none;font-family:calibri;">PRINT</a>
</p>
<table border="1" cellpadding="10" style="width:1000px;border-collapse: collapse;border:1px solid gray;font-family:tahoma;font-size:20px;">
<thead>
    <tr>
        <th colspan="2" style="padding:10px 0px;">DAILY ACCOMPLISHMENT REPORT</th>
    </tr>
</thead>
<tbody class="no-border-x">
    @foreach($post_records as $posts_records)
        <tr>
            <td style="width:20%;">Name:</td>
            <td style="width:80%;">{{$posts_records->name}}</td>
        </tr>
        <tr>
            <td style="width:20%;">Date:</td>
            <td style="width:80%;">{{date("M d, Y (l)", strtotime($posts_records->date))}}</td>
        </tr>
        <tr>
            <td style="width:20%;">Time In (AM):</td>
            <td style="width:80%;">@if($posts_records->time1){{date( 'g:i A', strtotime($posts_records->time1))}}@endif</td>
        </tr>
        <tr>
            <td style="width:20%;">Time Out (NN):</td>
            <td style="width:80%;">@if($posts_records->time2){{date( 'g:i A', strtotime($posts_records->time2))}}@endif</td>
        </tr>
        <tr>
            <td style="width:20%;">Time In (NN):</td>
            <td style="width:80%;">@if($posts_records->time3){{date( 'g:i A', strtotime($posts_records->time3))}}@endif</td>
        </tr>
        <tr>
            <td style="width:20%;">Time Out (PM):</td>
            <td style="width:80%;">@if($posts_records->time4){{date( 'g:i A', strtotime($posts_records->time4))}}@endif</td>
        </tr>
        <tr>
            <td style="width:20%;vertical-align: top;">Journal:</td>
            <td style="width:80%;"><?php echo stripslashes(nl2br($posts_records->accomplishment)) ?></td>
        </tr>
        <tr>
            <td style="width:20%;vertical-align: top;">Remarks:</td>
            <td style="width:80%;"><?php echo stripslashes(nl2br($posts_records->remarks)) ?></td>
        </tr>
    @endforeach
</tbody>
</table>

<script>
    function print_me(){
        document.getElementById("p_button").style.display = "none";
        window.print();
        document.getElementById("p_button").style.display = "block";
    }
</script>