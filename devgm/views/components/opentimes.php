<h3 class="page_title">Openingstijden</h3>
<div class="spcr_v px24"></div>
<?php
	$day_of_week = date('N');
?>
<table class="txt_s_m">
	<tr>
		<td><?php echo $day_of_week==1 ? '<strong class="txt_c_1">':''; ?>Maandag<?php echo $day_of_week==1 ? '</strong>':''; ?></td>
		<td><?php echo $day_of_week==1 ? '<strong class="txt_c_1">':''; ?><?php echo $tags['geopend_maandag'][1]?><?php echo $day_of_week==SOAP_1_1 ? '</strong>':''; ?></td>
	</tr>
	<tr>
		<td><?php echo $day_of_week==2 ? '<strong class="txt_c_1">':''; ?>Dinsdag<?php echo $day_of_week==2 ? '</strong>':''; ?></td>
		<td><?php echo $day_of_week==2 ? '<strong class="txt_c_1">':''; ?><?php echo $tags['geopend_dinsdag'][1]?><?php echo $day_of_week==2 ? '</strong>':''; ?></td>
	</tr>
	<tr>
		<td><?php echo $day_of_week==3 ? '<strong class="txt_c_1">':''; ?>Woensdag<?php echo $day_of_week==3 ? '</strong>':''; ?></td>
		<td><?php echo $day_of_week==3 ? '<strong class="txt_c_1">':''; ?><?php echo $tags['geopend_woensdag'][1]?><?php echo $day_of_week==3 ? '</strong>':''; ?></td>
	</tr>
	<tr>
		<td><?php echo $day_of_week==4 ? '<strong class="txt_c_1">':''; ?>Donderdag<?php echo $day_of_week==4 ? '</strong>':''; ?></td>
		<td><?php echo $day_of_week==4 ? '<strong class="txt_c_1">':''; ?><?php echo $tags['geopend_donderdag'][1]?><?php echo $day_of_week==4 ? '</strong>':''; ?></td>
	</tr>
	<tr>
		<td><?php echo $day_of_week==5 ? '<strong class="txt_c_1">':''; ?>Vrijdag<?php echo $day_of_week==5 ? '</strong>':''; ?></td>
		<td><?php echo $day_of_week==5 ? '<strong class="txt_c_1">':''; ?><?php echo $tags['geopend_vrijdag'][1]?><?php echo $day_of_week==5 ? '</strong>':''; ?></td>
	</tr>
	<tr>
		<td><?php echo $day_of_week==6 ? '<strong class="txt_c_1">':''; ?>Zaterdag<?php echo $day_of_week==6 ? '</strong>':''; ?></td>
		<td><?php echo $day_of_week==6 ? '<strong class="txt_c_1">':''; ?><?php echo $tags['geopend_zaterdag'][1]?><?php echo $day_of_week==6 ? '</strong>':''; ?></td>
	</tr>
	<tr>
		<td><?php echo $day_of_week==7 ? '<strong class="txt_c_1">':''; ?>Zondag<?php echo $day_of_week==7 ? '</strong>':''; ?></td>
		<td><?php echo $day_of_week==7 ? '<strong class="txt_c_1">':''; ?><?php echo $tags['geopend_zondag'][1]?><?php echo $day_of_week==7 ? '</strong>':''; ?></td>
	</tr>
</table>