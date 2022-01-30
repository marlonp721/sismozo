var default_grid = "{{ route('default') }}"
var current_url  = "{{ Request::url() }}"
var url_show_profile = "{{ route('profile') }}"

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