<?php $__env->startSection('breadcrumb'); ?>
<li>REPORTES</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <span class="title">REPORTES</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                  <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                          <div class="col-md-12"><h2>Reportes: </h2></div>
                          <div class="col-md-12"><a style="padding-left: 25px;" href="<?php echo e(route('module.report.alarms')); ?>">Reporte de Alarmas historicas</a></div>
                          <div class="col-md-12"><a style="padding-left: 25px;" href="<?php echo e(route('module.report.bandwidth')); ?>">Reporte de Consumo de ancho banda</a></div>
                          <div class="col-md-12"><a style="padding-left: 25px;" href="<?php echo e(route('module.report.app.most.used.data')); ?>">Reporte de aplicaciones más usadas</a></div>
                          <div class="col-md-12"><a style="padding-left: 25px;" href="<?php echo e(route('module.quality.velocity')); ?>">Reporte de Indicadores de Calidad</a></div>
                          <div class="col-md-12"><a style="padding-left: 25px;" href="<?php echo e(route('module.report.velocity')); ?>">Reporte de Medición de Velocidad</a></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                          <div class="col-md-12"><h2>Reportes Mensuales: </h2></div>
                          <div class="col-md-12"><a style="padding-left: 25px;" href="<?php echo e(route('module.report.service.availability')); ?>">Reporte mensual de disponibilidad del servicio</a></div>
                          <div class="col-md-12"><a style="padding-left: 25px;" href="<?php echo e(route('module.report.traffic.epad')); ?>">Reporte mensual de tráfico de cada EPAD</a></div>
                          <div class="col-md-12"><a style="padding-left: 25px;" href="<?php echo e(route('module.report.traffic.institution')); ?>">Listado de EPADs que no cursaron tráfico en el mes</a></div>
                          <div class="col-md-12"><a style="padding-left: 25px;" href="<?php echo e(route('module.report.tickets.month')); ?>">Reporte mensual de tickets de incidentes y fallas</a></div>
                      </div>
                    </div>
                    </div>     
                </div>
                
            </div>
               
            </div>
          
        </div>
    </div>
</div>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>