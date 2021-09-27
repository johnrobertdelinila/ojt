<table border='1' style="width:1500px;font-family:times new roman;font-size:40px;">
	<tr style="font-weight:none;text-align:center;font-weight:bold;font-size:50px;">
	@if($property_type_yr_excel_top == "")
		<td colspan="11" style="border:0px;"><span>Inventory of Property, Plant and Equipment</span>
		<br/>{{$property_type_name_excel_top}}
		<br/>As of <?php echo date('F d, Y',strtotime($as_of)); ?></td>
	@else
		<td colspan="11" style="border:0px;"><span>Inventory of Property, Plant and Equipment</span>
		<br/>{{$property_type_name_excel_top}}
		<br/>As of <?php echo date('F d, Y',strtotime($as_of)); ?></td>
	@endif
	</tr>
	<tr><td style="border:0px;"><br/></td></tr>
	<tr style="font-style:italic;text-align:left;font-weight:bold;font-size:50px;">
		<td colspan="8" style="border:0px;">Department: Department of Environment and Natural Resources</td>
		<td colspan="3" style="border:0px;">Region: I</td>
		{{--  <td colspan="2" rowspan="2" style="border:0px;">Charge to: @if($charge_to == "Charge to AQMF|like") AQMF @endif</td>  --}}
	</tr>
	<tr style="font-style:italic;text-align:left;font-weight:bold;font-size:50px;">
		<td colspan="8" style="border:0px;">Bureau: Environmental Management Bureau</td>
		<td colspan="3" style="border:0px;">Province: La Union</td>
	</tr>
	<tr>
	@if($property_type_yr_excel_top == "")
		<td colspan="11" style="border:0px;">&nbsp;</td>
	@else
		<td colspan="11" style="border:0px;">&nbsp;</td>
	@endif
	</tr>
	<tr style="font-weight:bold;">
		<td>Qty/Unit</td>
		<td>ItemName</td>
		<td>PropertyNo.</td>
		{{--  <td>Description</td>  --}}
		<td>DateAcquired</td>
		<td>SerialNo.</td>
		<td>PAR to</td>
		<td>Locator</td>
		<td>UnitValue</td>
		<td>TotalValue</td>
		<td>NetbookValue</td>
	@if($property_type_yr_excel_top == "")
		<td>LifeSpan</td>
		<td>Property Type</td>
	@endif
		<td>Remarks</td>
	</tr>
	@if($property_type_yr_excel_top != "")
		<tr style="font-weight:bold;">
			<td><i><br/>{{ $property_type_yr_excel_top }}(yr/s)<br/><br/></i></td>
			<td colspan="2"><i><br/>{{ $property_type_name_excel_top }}<br/><br/></i></td>
		</tr>
	@endif
	<?php 
		$total_unit = 0; 
		$total_total = 0; 
		$sum_netbook_value = 0; 
	?>
	@if($post_inventory->count())
	@foreach($post_inventory as $posts_inventory)
	<?php 
		$total_unit = $total_unit+$posts_inventory['inv_unit_value']; 
		$total_total = $total_total+$posts_inventory['inv_total_value']; 
	?>
		<tr style="vertical-align:top;">
			<td>{{$posts_inventory['inv_extra4']}}</td>
			<td>
				{{$posts_inventory['inv_name']}}
				@foreach($post_acc as $posts_acc)
					@if($posts_acc['inv_tracer']==$posts_inventory['id'])
							<br/>&nbsp;&nbsp;&nbsp;
							<i>-{{$posts_acc['acc_name']}} ({{$posts_acc['acc_serial']}})</i>
					@endif
				@endforeach
			</td>
			<td>{{$posts_inventory['inv_prop_no']}}</td>
			<!-- <td>@if($posts_inventory['inv_desc']) <?php echo str_replace("Charge to AQMF","",nl2br($posts_inventory['inv_desc'])); ?> @else - @endif</td> -->
			<td>{{$posts_inventory['inv_date_acq']}}</td>
			<td>@if($posts_inventory['inv_serial']) {{$posts_inventory['inv_serial']}} @else - @endif</td>
			<td>
				{{$posts_inventory['inv_mr']}}
				@foreach($post_par as $posts_par)
					@if($posts_par['inv_tracer']==$posts_inventory['id'])
							<br/>&nbsp;&nbsp;&nbsp;
							<i>-End-User: {{$posts_par['par_name']}}</i>
					@endif
				@endforeach
			</td>
			<td>{{$posts_inventory['inv_locator']}}</td>
			<td>{{number_format($posts_inventory['inv_unit_value'],2)}}</td>
			<td>{{number_format($posts_inventory['inv_total_value'],2)}}</td>
			<td>
				<?php
					if(date('d', strtotime($posts_inventory->inv_date_acq))<=15){
						$acq_cost = $posts_inventory->inv_total_value;
						$lifespan = $posts_inventory->inv_extra1*12;
						$depr_num_a = 12-date('m', strtotime($posts_inventory->inv_date_acq))+1;
						$depr_num_b = 12*(date('Y', strtotime($as_of))-date('Y', strtotime($posts_inventory->inv_date_acq))-1);
						$depr_num_c = date('m', strtotime($as_of));
						$depr_exp_monthly = ($acq_cost * 0.95)/$lifespan;
						$depr = $depr_num_a+$depr_num_b+$depr_num_c;
						$ad = $depr * $depr_exp_monthly;
						$nbv = $acq_cost - $ad;
						if($posts_inventory->inv_date_acq <= $as_of){
							if($depr >= $lifespan){
								echo '<span style="color:red;">'.number_format($acq_cost*0.05,2).'</span>';
								$sum_netbook_value = $sum_netbook_value+($acq_cost*0.05);
							}else{
								echo number_format($nbv,2);
								$sum_netbook_value = $sum_netbook_value+$nbv;
							}
						}else{
							echo number_format($posts_inventory->inv_total_value,2);
							$sum_netbook_value = $sum_netbook_value+$posts_inventory->inv_total_value;
						}
					}else{
						$acq_cost = $posts_inventory->inv_total_value;
						$lifespan = $posts_inventory->inv_extra1*12;
						$depr_num_a = 12-date('m', strtotime($posts_inventory->inv_date_acq));
						$depr_num_b = 12*(date('Y', strtotime($as_of))-date('Y', strtotime($posts_inventory->inv_date_acq))-1);
						$depr_num_c = date('m', strtotime($as_of));
						$depr_exp_monthly = ($acq_cost * 0.95)/$lifespan;
						$depr = $depr_num_a+$depr_num_b+$depr_num_c;
						$ad = $depr * $depr_exp_monthly;
						$nbv = $acq_cost - $ad;
						if($posts_inventory->inv_date_acq <= $as_of){
							if($depr >= $lifespan){
								echo '<span style="color:red;">'.number_format($acq_cost*0.05,2).'</span>';
								$sum_netbook_value = $sum_netbook_value+($acq_cost*0.05);
							}else{
								echo number_format($nbv,2);
								$sum_netbook_value = $sum_netbook_value+$nbv;
							}
						}else{
							echo number_format($posts_inventory->inv_total_value,2);
							$sum_netbook_value = $sum_netbook_value+$posts_inventory->inv_total_value;
						}
					}
				?>
			</td>
	@if($property_type_yr_excel_top == "")
			<td>{{$posts_inventory['inv_extra1']}} @if($posts_inventory['inv_extra1']>1) yrs. @else yr. @endif</td>
			<td>{{$posts_inventory['inv_extra3']}}</td>
	@endif
			<td>{{$posts_inventory['inv_remarks']}}</td>
		</tr>
	@endforeach
	@else
		<tr>
			<td colspan="14" style="text-align:center;">No Records</td>
		</tr>
	@endif
		<tr style="font-weight:bold;">
			<td colspan="7" style="border:0px;"></td>
			<td style="background-color:yellow;">GRAND TOTAL</td>
			<td style="background-color:yellow;">{{ number_format($total_total,2) }}</td>
			<td style="background-color:yellow;">{{ number_format($sum_netbook_value,2) }}</td>
		@if($property_type_yr_excel_top == "")
			<td colspan="2" style="border:0px;"></td>
		@else
			<td style="border:0px;"></td>
		@endif
		</tr>
		<tr style="font-weight:bold;"><td colspan="11" style="text-align:center;border:0px;"><br/><br/></td></tr>
		<tr style="font-weight:bold;">
			<td colspan="2" style="text-align:center;border:0px;"></td>
			<td colspan="4" style="text-align:left;border:0px;">Prepared by: </td>
			<td colspan="5" style="text-align:left;border:0px;">Approved by: </td>
		</tr>
		<tr style="font-weight:bold;"><td colspan="11" style="text-align:center;border:0px;"><br/></td></tr>
		<tr style="font-weight:bold;">
			<td colspan="2" style="text-align:center;border:0px;"></td>
			<td colspan="4" style="text-align:left;border:0px;">GERTRUDES A. OBEDOZA</td>
			<td colspan="5" style="text-align:left;border:0px;">Engr. MARIA DORICA NAZ-HIPE, CESE</td>
		</tr>
		<tr style="font-weight:bold;">
			<td colspan="2" style="text-align:center;border:0px;"></td>
			<td colspan="4" style="text-align:left;border:0px;">AOIII/Supply & Property Officer</td>
			<td colspan="5" style="text-align:left;border:0px;">REGIONAL DIRECTOR</td>
		</tr>
</table>

<?php
	//$file="property_inventory.xls";
	$file="property_inventory.xls";
	header("Content-Disposition: attachment; filename=$file");
?>