$(document).on('ready', function () {

    // KENDO GRID

    var col = [
        {field: 'id', title: 'ID', width: 30, type: 'string',attributes:{'class':'text-center'}},
        {field: 'mesa', title: 'MESA', width: 30, type: 'string' , attributes:{'class':'text-center'}},
        {field: 'client', title: 'CLIENT', width: 30, type: 'string' , attributes:{'class':'text-center'}},
        {field: 'monto', title: 'MONTO', width: 30, type: 'string' , attributes:{'class':'text-center'}},
        {field: 'date', title: 'FECHA REGISTRO', width: 30, type: 'string' , attributes:{'class':'text-center'}},
        {field: 'updated_at', title: 'FECHA MODIFICACION', width: 30, type: 'string' , attributes:{'class':'text-center'}},

        {title: 'OPCIONES', template: kendo.template($("#command-template").html()),
            attributes: {'class': 'text-center', 'data-id': "#: id #", 'data-name': '#: id #'},
            width: 30}

    ];
    var active_filter = true;

    if (permission_search_role == "not-active") {

        active_filter = false;
    }

    new KendoSettings()
            .setUrl(pedidos_url)
            .setWrapper(".content-kendo")
            .setPage(10)
            .setcolumns(col)
            .setFilterable(active_filter)
            .render();
    // KENDO SEARCH



})
