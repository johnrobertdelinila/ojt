@if($check_maintenance < 1)
    @php
        header("Location: " . URL::to('/logbook'), true, 302);
        exit();
    @endphp
@endif
<center>
<span style="font-size:80px;font-family:calibri;font-weight:bold;">
    OJT Monitoring<br/>
    and Accomplishment System<br/>
    (DAMAS)<br/>
</span><br/>
<img src="{{ asset('property_inventory_theme/html/assets/img/under_maintenance.jpg') }}" style="width:100%;margin:auto;"></img>
</center>