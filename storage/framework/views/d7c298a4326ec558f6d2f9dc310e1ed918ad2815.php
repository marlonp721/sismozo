<!DOCTYPE html>
<html>

<head>
    <title><?php echo e(config('app.name', 'Ir21-Roaming')); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('logo_gilat.ico')); ?>"/>

    <!-- Fonts 
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>

     Fill Core Stacks -->

    <?php echo $__env->make('layouts.admin.assets.core', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!-- CSS App -->
    
    <?php echo $__env->yieldPushContent('css'); ?>

</head>

<body class="flat-blue">
    <div class="app-container">
        <div class="row content-container">

            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid">
                    <?php echo $__env->make('layouts.admin.nav', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </div>
            </nav>

            <div class="side-menu sidebar-default">
                <?php echo $__env->make('layouts.admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </div>

            <!-- Main Content -->
            <div class="container-fluid">
                <div class="side-body padding-top">
                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>

        </div>

        <footer class="app-footer">
            <div class="wrapper">
                <span class="pull-right">0.1 <a href="#"><i class="fa fa-long-arrow-up"></i></a></span> © <?php echo e(Carbon::now()->format('Y')); ?> Copyright.
            </div>
        </footer>

    </div>

    <!-- Libraries -->

    <?php echo $__env->yieldPushContent('libraries'); ?>

    <!-- Global Variables -->

    <script type="text/javascript">

        var default_grid = "<?php echo e(route('default')); ?>"
        var current_url  = "<?php echo e(Request::url()); ?>"
        var url_show_profile = "<?php echo e(route('profile')); ?>"
        
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>

</html>
