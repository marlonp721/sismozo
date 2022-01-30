<?php $__env->startSection('breadcrumb'); ?>
    <li>INICIO</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3><?php echo e(greetings()); ?>, <?php echo e(auth()->user()->fullname); ?></h3>
                    
                </div>
                <div class="card-action">
                    <h3 class="pull-right"><?php echo e(fulldate()); ?></h3>
                </div>
            </div>

            <div class="card-body">
            
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>