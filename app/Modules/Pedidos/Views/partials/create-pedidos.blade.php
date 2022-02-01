<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
        	   <div class="card-header">
                    <div class="card-title">
                        <span class="title">INGRESE NUEVO PEDIDO</span>
                    </div>
                </div>
			<div class="card-body">
			    {!! Form::open([ 'route' => ['pedidos.store'], 'class' => 'form-horizontal form-modal-left', 'id' => 'form-pedido-create' ]) !!}
                    
                    @include('Pedidos::partials.form-pedidos')

			    {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<script type="application/javascript">
    var cont=2;
</script>