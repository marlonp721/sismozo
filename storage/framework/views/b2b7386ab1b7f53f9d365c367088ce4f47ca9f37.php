

<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">

        	   <div class="card-header">

                    <div class="card-title">
                        <span class="title">NUEVO USUARIO</span>
                       
                    </div>

                </div>
			<div class="card-body">



			    <?php echo Form::open([ 'route' => ['security.users.store'], 'class' => 'form-horizontal form-modal-left', 'id' => 'form-user-create' ]); ?>


			        <?php echo $__env->make('Security::users.partials.modals.form-user', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			        <?php echo $__env->make('Security::users.partials.modals.form-role', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			    <?php echo Form::close(); ?>

			</div>
		</div>
	</div>
</div>
