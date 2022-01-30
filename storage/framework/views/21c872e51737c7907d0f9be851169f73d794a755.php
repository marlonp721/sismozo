<!DOCTYPE html>
<html lang="en">
<head>
	
</head>
<body>
	
<table >
	<tr>
		<td></td>
		<td colspan="4" align="center"><b>Reporte de Wireless Client Session</b></td>
	</tr>
	<tr></tr>
	<tr>
		<td></td>
		<td><b>Fecha de Exportación: </b></td>
		<td><?php echo e(\Carbon::now()); ?></td>
	</tr>
	<tr></tr>
	<tr>
		<td></td>
		<td><b>Fecha inicio: </b></td>
		<td><?php echo e($filter['f_i']); ?></td>
		<td><b>Fecha Fin: </b></td>
		<td><?php echo e($filter['f_f']); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><b>Región: </b></td>
		<td><?php echo e($filter['region']); ?></td>
		<td><b>Provincia: </b></td>
		<td><?php echo e($filter['provincia']); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><b>Distrito: </b></td>
		<td><?php echo e($filter['distrito']); ?></td>
<!-- 		<td><b>Localidad: </b></td>
		<td><?php echo e($filter['localidad']); ?></td> -->
	</tr>
	<tr></tr>
</table>

<table>
	<tr>
		<td></td>
		<td style="border: 1px solid black;"><b>Client Name</b></td>
		<td style="border: 1px solid black;"><b>Group Name</b></td>
		<td style="border: 1px solid black;"><b>AP name</b></td>
		<td style="border: 1px solid black;"><b>AP mac</b></td>
		<td style="border: 1px solid black;"><b>Associated ssid</b></td>
		<td style="border: 1px solid black;"><b>Working Mode</b></td>
		<td style="border: 1px solid black;"><b>Attached Band</b></td>
		<td style="border: 1px solid black;"><b>Client Mac</b></td>
		<td style="border: 1px solid black;"><b>Client Ipv4 Address</b></td>
		<td style="border: 1px solid black;"><b>Device Category</b></td>
		<td style="border: 1px solid black;"><b>Device OS</b></td>
		<td style="border: 1px solid black;"><b>Associated Time</b></td>
		<td style="border: 1px solid black;"><b>Time Connected</b></td>
		<td style="border: 1px solid black;"><b>Channel</b></td>
		<td style="border: 1px solid black;"><b>Rx Total</b></td>
		<td style="border: 1px solid black;"><b>Tx Total</b></td>
		<td style="border: 1px solid black;"><b>Rx_Rate</b></td>
		<td style="border: 1px solid black;"><b>Tx_Rate</b></td>
		<td style="border: 1px solid black;"><b>Access Role Profile</b></td>
		<td style="border: 1px solid black;"><b>Vlan</b></td>
		<td style="border: 1px solid black;"><b>Client Ipv6 Address</b></td>
		<td style="border: 1px solid black;"><b>Security Type</b></td>
		<td style="border: 1px solid black;"><b>Location</b></td>
		<td style="border: 1px solid black;"><b>User Name</b></td>
		<td style="border: 1px solid black;"><b>Rssi</b></td>
		<td style="border: 1px solid black;"><b>Phy Rx Rate</b></td>
		<td style="border: 1px solid black;"><b>Phy Tx Rate</b></td>
	</tr>
	<?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td></td>
		<td style="border: 1px solid black;"><?php echo e($v['client_name']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['group_name']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['ap_name']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['wifi_mac']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['associated_ssid']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['working_mode']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['attached_band']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['client_mac']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['client_ipv4_address']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['device_category']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['device_os']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['associate_time']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['time_connected']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['channel']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['rx_total']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['tx_total']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['rx_rate']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['tx_rate']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['access_role_profile']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['vlan']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['client_ipv6_address']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['security_type']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['location']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['username']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['rssi']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['phy_rx_rate']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['phy_tx_rate']); ?></td>
	</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
</body>
</html>