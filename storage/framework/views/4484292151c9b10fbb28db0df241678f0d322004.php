<!DOCTYPE html>
<html lang="en">
<head>
	
</head>
<body>
	
<table >
	<tr>
		<td></td>
		<td colspan="4" align="center"><b>Reporte de Aplicaciones más usadas</b></td>
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
		<td><b>Localidad: </b></td>
		<td><?php echo e($filter['localidad']); ?></td>
	</tr>
	<tr></tr>
</table>

<table>
	<tr>
		<td></td>
		<td style="border: 1px solid black;"><b>DISPOSITIVO</b></td>
		<td style="border: 1px solid black;"><b>FECHA</b></td>
		<td style="border: 1px solid black;"><b>APLICACIÓN</b></td>
		<td style="border: 1px solid black;"><b>TRÁFICO (MB)</b></td>
	</tr>
	<?php $__currentLoopData = $datos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td></td>
		<td style="border: 1px solid black;"><?php echo e($v['cpe_name']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['fecha']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['application_name']); ?></td>
		<td style="border: 1px solid black;"><?php echo e($v['trafico']); ?></td>
	</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</table>
</body>
</html>