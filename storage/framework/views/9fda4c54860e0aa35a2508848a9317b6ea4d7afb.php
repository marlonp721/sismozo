<?php $__env->startPrepend('css'); ?>
	
	<link rel="stylesheet" href="<?php echo e(asset('libraries/bootstrap/bootstrap-switch.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('libraries/bootstrap/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('libraries/bootstrap/animate.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('libraries/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/themes/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/themes/flat.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/pedidos/mesa_scroll.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('libraries/pikaday/pikaday.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('libraries/manific-popup/css/magnific-popup.css')); ?>">
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2022.1.119/styles/kendo.default-main.min.css" />
    


<?php $__env->stopPrepend(); ?>

<?php $__env->startPrepend('libraries'); ?>
    
    <script src="https://kendo.cdn.telerik.com/2022.1.119/js/jquery.min.js"></script>
    <script src="<?php echo e(asset('libraries/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('libraries/bootstrap/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('libraries/bootstrap/bootstrap-switch.min.js')); ?>"></script>
    <script src="<?php echo e(asset('libraries/match-height/jquery.matchHeight-min.js')); ?>"></script>
    <script src="<?php echo e(asset('libraries/bootbox/bootbox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('libraries/pikaday/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('libraries/pikaday/pikaday.js')); ?>"></script>
    <script src="<?php echo e(asset('libraries/pikaday/pikaday.jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('libraries/manific-popup/jquery.magnific-popup.min.js')); ?>"></script>


    
<?php $__env->stopPrepend(); ?>

<?php echo $__env->make('layouts.admin.assets.libraries.kendo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.datetime', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.jquery-validation', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.checkbox', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.select2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startPrepend('scripts'); ?>
    <script src="<?php echo e(asset('js/modules/pedidos/index.js')); ?>"></script>
	<script src="<?php echo e(asset('js/custom/app.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom/alert-functions.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom/functions.js')); ?>"></script>
    <script src="<?php echo e(asset('js/modules/pedidos/mesa_scroll.js')); ?>"></script>
    <script src="<?php echo e(asset('js/modules/pedidos/edit_pedidos.js')); ?>"></script>
<?php $__env->stopPrepend(); ?>