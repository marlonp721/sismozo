<!-- DELETE FORM -->

{!! Form::open([ 'route' => ['pedidos.destroy', ':ROW_ID'], 'method' => 'DELETE', 'id' => 'form-pedido-delete']) !!}

{!! Form::close() !!}

<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
			    Se eliminará el pedido número {{ $pedidos->id }}. ¿Está seguro de realizar esta acción?
		</div>
	</div>
</div>

<script>
	var cont=1;
</script>
