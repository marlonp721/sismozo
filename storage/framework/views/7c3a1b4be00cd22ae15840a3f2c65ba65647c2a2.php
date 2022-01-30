<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
            <div class="card-body">
                <?php echo Form::open(['route'=>'security.roles.store','class'=>'form-horizontal form-modal-left','id'=>'form-role-create']); ?>

                    <?php echo $__env->make('Security::roles.partials.modals.form-role', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('js/modules/security/roles/tree.js')); ?>"></script>

<script>
    var url_view_menu = "<?php echo e(route('security.roles.tree')); ?>";

    $.get(url_view_menu).done(function (data) {

        showTree(data)
    });
</script>