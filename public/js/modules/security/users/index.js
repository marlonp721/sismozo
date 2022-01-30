// VALIDATION
UserSettings.create.conditions.validation =
UserSettings.edit.conditions.validation   = {
    rules:{
      fullname: {required: true, maxlength: 100},
      username: {required: true, maxlength: 100},
      status: {required: true},
        password: {
            required: { 
                depends: function(element) {

                    var form = $(element).closest("form")

                    if ( $('input[name=_method]', form).val() == 'PATCH' )
                    {
                        return false;
                    }

                    return true;
                },
            },
            minlength: 1,
            maxlength: 15
        },
      password_repeat: {required: false,equalTo: "#passwordu"},
      email: {required: true, email: true},
      "roles[]": {digits: true,required:true}
    },
    messages: {
      "roles[]": "Seleccione al menos un perfil.",
    },
    ignore: ".ignore",
    errorPlacement: function (error, element) {
        if( $(element).hasClass("select2-hidden-accessible") )
        {
            $(element).next().find(".select2-selection").addClass('error');
        }

          if (element.attr("type") == "checkbox") {
            error.insertAfter('.table-container');
          }
    },
};

$(document).on('ready', function(){

  // KENDO GRID

    var col = [
      {field:'username',sortable:false, title:'NOMBRE DE USUARIO', width: 100},
      {field:'fullname',sortable:false,     title:'NOMBRES', width: 100},
        {field:'email',sortable:false,    title:'EMAIL', width: 100},
        {field:'cellphone',sortable:false,    title:'CELULAR', width: 100},
        {field:'created_at',sortable:false,   title:'FECHA DE ALTA', attributes:{'class':'text-center'}, width: 100},
        {field:'status',sortable:false,   title:'ESTADO', template:kendo.template( $("#estado-template").html() ),attributes:{'class':'text-center'}, width: 100},
        {title:'OPCIONES', template:kendo.template( $("#command-template").html() ),
                           attributes:{ 'class' : 'text-center', 'data-id' : "#: id #", 'data-name' : '#: username #' },
                           width: 100 }
    ];
  var active_filter = true;

  if(permission_search_user == "not-active"){

    active_filter = false;
  } 
    (new KendoSettings())
        .setUrl(url_load_users)
        .setWrapper('.content-kendo')
        .setPage(10)
        .setcolumns(col)
        .setFilterable(active_filter)
        .render();

    // KENDO SEARCH

    $("#button-search").on('click',function(e){

        where = {
            fullname:     $("#fullname").val(),
            username: $("#username").val(),
            email:    $("#email").val(),
        };

        var grid = $('.content-kendo').data("kendoGrid");

        grid.dataSource.filter([
            {field:'fullname',     value:where.fullname},
            {field:'username', value:where.username},
            {field:'email',    value:where.email},
        ]);
        
        e.preventDefault();
    });


})
