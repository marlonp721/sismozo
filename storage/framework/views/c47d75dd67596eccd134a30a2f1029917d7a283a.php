<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
        	   <div class="card-header">
                    <div class="card-title">
                        <span class="title">INGRESE NUEVO PEDIDO</span>
                    </div>
                </div>
			<div class="card-body">
			    <?php echo Form::open([ 'route' => ['pedidos.store'], 'class' => 'form-horizontal form-modal-left', 'id' => 'form-pedido-create' ]); ?>

                    
                    <?php echo $__env->make('Pedidos::partials.form-pedidos', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			    <?php echo Form::close(); ?>

			</div>
		</div>
	</div>
</div>