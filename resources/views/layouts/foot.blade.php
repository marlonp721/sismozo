@push('scripts')
<script id="command-template" type="text/x-kendo-template">
    <a title="Editar"   href="\#" class="edit-pedido-entity kendo-buttons">
        <i class="fa fa-lg fa-pencil"></i>
    </a>
    <a title="Eliminar" href="\#" class="delete-pedido-entity">
        <i class="fa fa-lg fa-trash"></i>
    </a>
</script>

<script type="text/javascript">
    var permission_search_role = "{{-- icon_permission('ir21_search') --}}";
    var pedidos_url = "{{ route('pedidos.load') }}";
    var PedidosSettings = newModalSettings();
    var PedidoCRUD = newModalCRUD();
    PedidosSettings.entity     = 'PEDIDO';
    PedidosSettings.selector   = 'pedido';
    PedidosSettings.edit.url   = "{{ route('pedidos.edit', ':ROW_ID') }}";
    PedidosSettings.create.url = "{{ route('pedidos.create') }}";
    PedidosSettings.delete.url = "{{ route('pedidos.delete', ':ROW_ID') }}";
    PedidoCRUD.init(PedidosSettings);
</script>
@endpush