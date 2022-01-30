var current_grid_total = 0;
var sort_dir, sort_field, sorter;

function KendoSettings() {
    this.url = '';
    this.height = '';
    this.rowTemplate = '';
    this.columns = '';
    this.filter = '';
    this.pageable = true;
    this.page = 10;
    this.wrapper = '#grid';
    this.filterable = false;
    this.serverPaging = true;
    this.serverFiltering = true;
    this.serverSorting = true;
    this.data = {};
    this.dataBound = function (e) {
        showMessage(e);
        getSort(e);
        resize(this.wrapper);
    };
}

KendoSettings.prototype.setUrl = function (url) {
    this.url = url;
    return this;
};

KendoSettings.prototype.setHeight = function (height) {
    this.height = height;
    return this;
};

KendoSettings.prototype.setRowTemplate = function (template) {
    this.rowTemplate = template;
    return this;
};

KendoSettings.prototype.setcolumns = function (columns) {
    this.columns = columns;
    return this;
};

KendoSettings.prototype.setPage = function (page) {
    this.page = page;
    return this;
};

KendoSettings.prototype.setPageable = function (pageable) {
    this.pageable = pageable;
    return this;
};

KendoSettings.prototype.setWrapper = function (wrapper) {
    this.wrapper = wrapper;
    return this;
};

KendoSettings.prototype.setData = function (data) {
    this.data = data;
    return this;
};

KendoSettings.prototype.setDataBound = function (fnc) {
    this.dataBound = fnc;
    return this;
};

KendoSettings.prototype.filterable = function (fnc) {
    this.filterable = fnc;
    return this;
};

KendoSettings.prototype.setFilter = function (filter) {
    this.filter = filter;
    return this;
};

KendoSettings.prototype.setFilterable = function (filterable) {
    this.filterable = filterable;
    return this;
};

KendoSettings.prototype.setserverPaging = function (serverPaging) {
    this.serverPaging = serverPaging;
    return this;
}

KendoSettings.prototype.setserverFiltering = function (serverFiltering) {
    this.serverFiltering = serverFiltering;
    return this;
}

KendoSettings.prototype.setserverSorting = function (serverSorting) {
    this.serverSorting = serverSorting;
    return this;
}

KendoSettings.prototype.render = function () {



    if (typeof window.kendo !== 'object') {
        alert('Kendo no ha sigo cargado aún');
        return;
    }

    if (!this.pageable) {
        var pageable = false;
    }
    else {
        var pageable = {
            pageSize: this.page, refresh: true, pageSizes: true, messages: {
                display: "{0} - {1} de {2} registros",
                empty: "No se encontraron registros",
                page: "Página",
                of: "of {0}",
                itemsPerPage: "registros por página",
                first: "Ir a la primera página",
                previous: "Ir a la página anterior",
                next: "Ir a la página siguiente",
                last: "Ir a la última página",
                refresh: "Refrescar"
            }
        };
    }

    var settings = {
        dataSource: {
            transport: {
                read: { url: this.url, dataType: 'json', type: 'GET', data: this.data }
            },
            schema: { data: 'data', total: 'total' },
            serverPaging: this.serverPaging,
            serverFiltering: this.serverFiltering,
            serverSorting: this.serverSorting,
        },
        scrollable: true,
        resizable: true,
        dataBound: this.dataBound,
        filterable: this.filterable,
        sortable: true,
        height: this.height,
        pageable: pageable,
        columns: this.columns,
        filter: function(e) {
            e.preventDefault();
            console.log(e.filter);
        }
    };


    if (this.filterable) {
        settings.filterable = {

            messages: {
                info: "Filtros:",
                filter: "Aceptar",
                clear: "Limpiar",
                isTrue: "true",
                isFalse: "false",
                and: "And",
                or: "Or"
            },
            operators: {
                string: {
                    eq: "Es igual",
                    neq: "No es igual",
                    startswith: "Empieza por",
                    contains: "Contiene",
                    endswith: "Termina por",
                },
                number: {
                    eq: "Es igual a",
                    gte: "Mayor o igual que ",
                    gt: "Mayor que",
                    lte: "Es menor o igual",
                    lt: "Es menor que"
                }
            }
        }

    }

    if (this.filter !== '') {
        settings.dataSource.filter = this.filter;
    }

    if (this.rowTemplate !== '') {
        settings.rowTemplate = kendo.template(this.rowTemplate);
    }

    $(this.wrapper).kendoGrid(settings);

    var gridElement = $(this.wrapper),
        dataArea = gridElement.find(".k-grid-content");
                
    dataArea.height('60px');

};

function showMessage(e) {
     
    var grid = e.sender;

    current_grid_total = grid.dataSource.total()

    if (current_grid_total == 0) {
        var colCount = grid.columns.length;

        $(e.sender.wrapper)
            .find('tbody')
            .append('<tr><td colspan="' + (colCount) + '" class="text-muted">No se encontraron registros para el dispositivo y/o rango de fecha seleccionado.</td></tr>');
        $('.btn_export').attr('disabled', true);
    }
    else {
        $('.btn_export').attr('disabled', false);
    }

    if(current_grid_total>2000000)
    {
        $('#export_xlsx').attr('disabled', true);
        $('#export_xlsx').css('pointer-events', 'none');
    }else
    {
        $('#export_xlsx').attr('disabled', false);
        $('#export_xlsx').css('pointer-events', 'all');
    }
}

function getSort(e) {
   
    var sort = e.sender.dataSource._sort

    if (sort && sort[0]) {
        sort_dir = sort[0].dir;
        sort_field = sort[0].field;
    }

    sorter = [
        { field: sort_field, dir: sort_dir },
    ]
}

function refreshKendo(element) {
    if (!element) {
        element = '.content-kendo';
    }

    $(element).data('kendoGrid').dataSource.read();
    
}

function resize(element)
{   
  var gridElement = $(element),
      dataArea = gridElement.find(".k-grid-content");
            
  dataArea.height('100%');
}