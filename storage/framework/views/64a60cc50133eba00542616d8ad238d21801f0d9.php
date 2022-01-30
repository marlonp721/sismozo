<!DOCTYPE html>
<html lang="en">
<head>
	
</head>
<body>
	
<table >
	<tr>
		<td></td>
		<td colspan="4" align="center"><b>Reporte de Sesiones de Clientes - Datos Historicos</b></td>
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
		<td><b>Región: </b></td>
		<td><?php echo e($filter['region']); ?></td>
		<td><b>Año:  <?php echo e($filter['anio']); ?></b></td>
		<td align="left"></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td><b>Mes:  <?php echo e($filter['mes']); ?> </b></td>
		<td></td>
	</tr>
	<tr></tr>
</table>

<table>
	<tr>
		<td></td>
		<td style="border: 1px solid black;"><b>REGION</b></td>
		<td style="border: 1px solid black;"><b>APP NAME</b></td>
		<td style="border: 1px solid black;"><b>AÑO</b></td>
		<td style="border: 1px solid black;"><b>MES</b></td>
		<td style="border: 1px solid black;"><b>ARCHIVO SESIONES DE CLIENTES</b></td>
	</tr>
	<?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td></td>
		<td style="border: 1px solid black;" ><?php echo e($v['region']); ?></td>
		<td style="border: 1px solid black;" ><?php echo e($v['ap_name']); ?></td>
		<td style="border: 1px solid black;" ><?php echo e($v['anio']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['mes']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['historico']); ?></td>
	</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
</body>
</html>