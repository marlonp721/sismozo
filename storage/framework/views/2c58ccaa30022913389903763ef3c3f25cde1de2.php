<?php $__env->startSection('content'); ?>
<div class="container">
	<br><br>
	<div class="row">
		<div class="col-md-12">
			<h1>Sistema de Monitoreo Remoto</h1>			
		</div>
	</div>
	<br><br>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-body">
                	<br>
                	<div class="row">
                		<div class="col-md-12" align="center">
                			<span class="fa fa-bar-chart fa-4x"></span>
                		</div>
                	</div>
                	<div class="row">
                		<div class="col-md-12" align="center">
                			<a href="<?php echo e($url_epad['General']); ?>"><h4>Herramienta de Monitoreo y Ticket</h4></a>
                            <?php $__currentLoopData = $url_externa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($k!='url'): ?>
                                    <span  ><h4>&nbsp;</h4></span>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                		</div>
                	</div>
                	<br>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        	<div class="panel panel-default">
                <div class="panel-body">
                	<br>
                    <div class="row">
                		<div class="col-md-12" align="center">
                			<span class="icon fa fa-wifi fa-4x"></span>
                		</div>
                	</div>
                	<div class="row">
                		<div class="col-md-11 col-md-offset-1"  style="text-align: left;padding-left: 30px;">
                                   
                                     
                                    <?php $__currentLoopData = $url_externa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($k!='url'): ?>
                                            <a  href="<?php echo e($url); ?>"><h4>- <?php echo e($k); ?></h4></a>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                		</div>
                	</div>
                	<br>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>