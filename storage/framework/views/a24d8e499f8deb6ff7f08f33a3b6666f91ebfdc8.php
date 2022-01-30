<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
			<div class="card-body">

			    <?php echo Form::model($pedidos, [ 'route' => ['pedidos.update', $pedidos->id], 'class' => 'form-horizontal form-modal-left' , 'id' => 'form-pedido-update', 'method' => 'PATCH']); ?>


			        <?php echo $__env->make('Pedidos::partials.form-pedidos', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

			    <?php echo Form::close(); ?>


			</div>
		</div>
	</div>
</div>

<script>
const info_pedido = <?php echo json_encode($pedidos); ?>;
const info_detalle = <?php echo json_encode($detalle); ?>;
$('#cmb_mesa').val(info_pedido.mesa).trigger("change", ["llenar"]);
$('#cmb_fecha').val(info_pedido.date).trigger("change", ["llenar"]);
var monto_total=0;
for (var i = 0; i < info_detalle.length; i++) {
	switch (info_detalle[i].plato_id) {
		case 1:
			$('input:checkbox[name=c_ajidegallina]').attr('checked',true);
			$('#cmb_ajidegallina').prop('disabled', false);
			$('#cmb_ajidegallina').val(info_detalle[i].cantidad);
			monto = 10.0 * info_detalle[i].cantidad;
        	$('#monto_ajidegallina').html(monto.toFixed(2));
			break;
		case 2:
			$('input:checkbox[name=c_tallarinconpollo]').attr('checked',true);
			$('#cmb_tallarinconpollo').prop('disabled', false);
			$('#cmb_tallarinconpollo').val(info_detalle[i].cantidad);
			monto = 10.0 * info_detalle[i].cantidad;
        	$('#monto_tallarinconpollo').html(monto.toFixed(2));
			break;
		case 3:
			$('input:checkbox[name=c_lomosaltado]').attr('checked',true);
			$('#cmb_lomosaltado').prop('disabled', false);
			$('#cmb_lomosaltado').val(info_detalle[i].cantidad);
			monto = 10.0 * info_detalle[i].cantidad;
        	$('#monto_lomosaltado').html(monto.toFixed(2));
			break;
		case 4:
			$('input:checkbox[name=c_estofadodepollo]').attr('checked',true);
			$('#cmb_estofadodepollo').prop('disabled', false);
			$('#cmb_estofadodepollo').val(info_detalle[i].cantidad);
			monto = 10.0 * info_detalle[i].cantidad;
        	$('#monto_estofadodepollo').html(monto.toFixed(2));
			break;
		case 5:
			$('input:checkbox[name=c_tacutacu]').attr('checked',true);
			$('#cmb_tacutacu').prop('disabled', false);
			$('#cmb_tacutacu').val(info_detalle[i].cantidad);
			monto = 10.0 * info_detalle[i].cantidad;
        	$('#monto_tacutacu').html(monto.toFixed(2));
			break;
		case 6:
			$('input:checkbox[name=c_chicharron]').attr('checked',true);
			$('#cmb_chicharron').prop('disabled', false);
			$('#cmb_chicharron').val(info_detalle[i].cantidad);
			monto = 10.0 * info_detalle[i].cantidad;
        	$('#monto_chicharron').html(monto.toFixed(2));
			break;
	  default:
	}
	monto_total = monto_total+monto;
}
$('#resultmontototal').html("<b>"+monto_total.toFixed(2)+"</b>");
</script>

