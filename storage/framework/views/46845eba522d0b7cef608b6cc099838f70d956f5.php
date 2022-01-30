<?php $__env->startPush('scripts'); ?>
<script id="command-template" type="text/x-kendo-template">
    <a title="Editar"   href="\#" class="edit-pedido-entity kendo-buttons">
        <i class="fa fa-lg fa-pencil"></i>
    </a>
    <a title="Eliminar" href="\#" class="delete-pedido-entity">
        <i class="fa fa-lg fa-trash"></i>
    </a>
</script>

<script type="text/javascript">
    var permission_search_role = "";
    var pedidos_url = "<?php echo e(route('pedidos.load')); ?>";
    var PedidosSettings = newModalSettings();
    var PedidoCRUD = newModalCRUD();
    PedidosSettings.entity     = 'PEDIDO';
    PedidosSettings.selector   = 'pedido';
    PedidosSettings.edit.url   = "<?php echo e(route('pedidos.edit', ':ROW_ID')); ?>";
    PedidosSettings.create.url = "<?php echo e(route('pedidos.create')); ?>";
    PedidosSettings.delete.url = "<?php echo e(route('pedidos.delete', ':ROW_ID')); ?>";
    PedidoCRUD.init(PedidosSettings);
</script>
<?php $__env->stopPush(); ?>