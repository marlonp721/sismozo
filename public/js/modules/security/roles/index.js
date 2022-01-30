$(document).on('ready', function(){

    var col = [
        {field:'display_name',sortable:false, title:'PERFIL', width: 100},
        {field:'description',sortable:false, title:'DESCRIPCIÓN', width: 100},
        {field:'created_at',sortable:false,   title:'FECHA DE CREACIÓN', attributes:{'class':'text-center'}, width: 100},
        //{field:'deleted_at',   title:'ESTADO', template:kendo.template( $("#estado-template").html() ),attributes:{'class':'text-center'}, width: 100},
        {title:'OPCIONES',     template:kendo.template($("#command-template").html()),
                               attributes:{'class':'text-center','data-id':"#: id #",'data-name':'#:display_name#'},
                               width: 100 }
    ];
  var active_filter = true;

  if(permission_search_role == "not-active"){

    active_filter = false;
  }
    (new KendoSettings())
        .setUrl(url_load_roles)
        .setWrapper('.content-kendo')
        .setPage(10)
        .setcolumns(col)
        .setFilterable(active_filter)
        .render();

    $("#search-role").on('click',function(e){
        where = {
            display_name:$("#name").val()
        };

        var grid=$('.content-kendo').data("kendoGrid");
        grid.dataSource.filter([
            {field:'display_name', value:where.display_name}
        ]);

        e.preventDefault();
    });

    RoleSettings.create.conditions.validation =
    RoleSettings.edit.conditions.validation   =  {
        ignore: "not:hidden",
        rules:{
            display_name:{required:true, maxlength: 30},
            permissions:"required"
        },
        messages:{
            "permissions":{required:"Seleccione al menos un permiso"}
        }
    };

});