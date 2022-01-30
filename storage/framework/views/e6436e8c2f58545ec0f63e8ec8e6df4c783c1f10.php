<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
            <div class="card-body">
                <div class="form-horizontal form-modal-left">
                
                    <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">NOMBRES Y APELLIDOS</label>
                        <div class="col-sm-6 control-div">
                            <?php echo e($user->fullname); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-6 control-label">NOMBRE DE USUARIO</label>
                        <div class="col-sm-6 control-div">
                            <?php echo e($user->username); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-6 control-label">CORREO PERSONAL</label>
                        <div class="col-sm-6 control-div">
                            <?php echo e($user->email); ?>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="roles" class="col-sm-6 control-label">PERFILES</label>
                        <div class="col-sm-6 control-div">
                            <ul>
                                <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($role->display_name); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
