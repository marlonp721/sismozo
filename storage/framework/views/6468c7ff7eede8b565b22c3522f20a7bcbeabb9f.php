<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Ir21-Roaming')); ?></title>
    
    <!-- Styles -->
    <link href="<?php echo e(asset('libraries/bootstrap/bootstrap.min.css')); ?>" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href=""/>
    <link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('libraries/font-awesome/css/font-awesome.min.css')); ?>">
    <?php echo $__env->yieldContent('captcha'); ?>
    <!-- Scripts -->
    <script>
        window.Laravel = <?= json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top fondo-color">
        
        <div class="container">
            <div class="navbar-header">

                <!-- Branding Image -->
                <div class="col-md-12 col-sx-8">
                    <h4 class="centrar titulo"></h4>               
                </div>
            </div>
        </div>
    </nav>

    <?php echo $__env->yieldContent('content'); ?>

</body>
</html>
