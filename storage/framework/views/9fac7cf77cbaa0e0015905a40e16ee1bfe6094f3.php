<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
			<div class="card-body">

			    <?php echo Form::model($user, [ 'route' => ['security.users.update', $user->id], 'class' => 'form-horizontal form-modal-left' , 'id' => 'form-user-update', 'method' => 'PATCH']); ?>


			        <?php echo $__env->make('Security::users.partials.modals.form-user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			        <?php if( ! $user->isSuperUser() ): ?>
			        
			        	<?php echo $__env->make('Security::users.partials.modals.form-role', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			        <?php endif; ?>

			    <?php echo Form::close(); ?>


			</div>
		</div>
	</div>
</div>



