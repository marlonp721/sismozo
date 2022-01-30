<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
            <div class="card-body">
                <?php echo Form::model($role, ['route'=> ['security.roles.update', $role->id], 'class'=>'form-horizontal form-modal-left', 'id'=>'form-role-update', 'method'=>'PATCH']); ?>

                    <?php echo $__env->make('Security::roles.partials.modals.form-role', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('js/modules/security/roles/tree.js')); ?>"></script>

<script>
    $(document).ready(function() {

        var data = <?php echo $permissions_role; ?>


        showTree(data)

    });
</script>