<div class="form-group">
    <label for="name" class="col-sm-4 control-label">Perfiles<span class="span-rojo">(*)</span></label>

    <div class="col-sm-8 form-role">

        <div class="table-container">
            
            <table class="table table-condensed table-role table-bordered">
                <tr>

                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos => $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <td>
                            <div class="checkbox3 checkbox-inline checkbox-check checkbox-light">
                                <?php echo e(Form::checkbox('roles[]', $role->id, in_array($role->id, $current_roles), ['id' => 'checkbox-fa-light-' . $role->id ])); ?>

                                <label for="checkbox-fa-light-<?php echo e($role->id); ?>"><?php echo e($role->display_name); ?></label>
                            </div>
                        </td>
                        
                        <?php if( ($pos + 1) % 2 == 0 ): ?>
                            </tr>
                            <tr>
                        <?php endif; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tr>
            </table>

        </div>
    </div>
</div>