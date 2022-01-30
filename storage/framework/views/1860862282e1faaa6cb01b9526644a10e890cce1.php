<?php $params = app('App\Repositories\ParamsDAO'); ?>
<?php $__env->startSection('captcha'); ?>
<?php echo htmlScriptTagJsApi(); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Sistema de Monitoreo Remoto</h1>            
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                      <div class="panel panel-default">
                        <div class="panel-body" style="height: 140px">
                            <span ><img width="100%" height="100%" src="<?php echo e(asset('img/img_referencial.jpg')); ?>" alt=""></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12" align="center">
                                    <span class="icon fa fa-wifi fa-3x"></span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-11 col-md-offset-1"  style="text-align: left;padding-left: 30px;">
                                    
                                    <?php $__currentLoopData = $params->getParams('url_externa'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($k!='url'): ?>
                                            <a  href="<?php echo e($url); ?>"><h4>- <?php echo e($k); ?></h4></a>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
   
        <div class="col-md-6">
            <div class="panel panel-default">
                <br>
                <div class="row">
                        <div class="col-md-12" align="center">
                            <span class="fa fa-bar-chart fa-3x"></span>
                        </div>
                </div>
                <div class="row">
                        <div class="col-md-12" align="center">
                            <h4>Herramienta de Monitoreo y Ticket</h4>
                        </div>
                </div>
                <br>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?>">
                            <label for="username" class="col-md-4 control-label">Usuario</label>

                            <div class="col-md-7">
                                <input id="username" type="text" class="form-control" name="username" value="<?php echo e(old('username')); ?>" required autofocus>

                                <?php if($errors->has('username')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                       
                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <?php echo htmlFormSnippet(); ?>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-4" style="text-align: right;">
                                <button type="submit" class="btn btn-primary">
                                    INGRESAR
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>