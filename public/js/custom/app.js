$(function() {
    $(".navbar-expand-toggle").click(function() {
        $(".app-container").toggleClass("expanded");
        return $(".navbar-expand-toggle").toggleClass("fa-rotate-90");
    });

    return $(".navbar-right-expand-toggle").click(function() {
        $(".navbar-right").toggleClass("expanded");
        return $(".navbar-right-expand-toggle").toggleClass("fa-rotate-90");
    });
});

$(function() {
    return $.fn.modal.Constructor.prototype.enforceFocus = function() {};
});  


$(function() {
    return $('.toggle-checkbox').bootstrapSwitch({
        size: "small"
    });
});

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    statusCode : {
        403: function() {
            bootbox.hideAll()
            AlertMessage.printError('.side-body', 'No tiene permitido realizar esta acción o ver parte de este contenido.')
        },
        404: function() {
            bootbox.hideAll()
            AlertMessage.printError('.side-body', 'El registro no existe o ha sido eliminado.')
        },
        417: function() {
            $('#grid tbody').html('<tr class="text-muted"><td>No hay registros en la base de datos.</td></tr>');
            $('.btn_export').attr('disabled', true);
        },
        422: function(jqXHR) {
            console.log(jqXHR.responseJSON);
            console.log(elementForMessage());
            AlertMessage.printError(elementForMessage(), jqXHR.responseJSON)
        },
        500: function() {
            AlertMessage.printError(elementForMessage(), 'Error interno del servidor')
        },
    }
});

function elementForMessage()
{
    var element = '.side-body'

    if ( $(".modal-form").data('bs.modal') )
    {
        element = '.modal-body'
    }

    return element
}

$('#show-profile').on('click', function(){
    var url_show_profile = "/profile"
    $.get(url_show_profile).done(function (data) {

        bootbox.dialog({
            className: 'modal-primary',
            closeButton: false,
            message: data,
            title: "MI PERFIL",
            buttons: {
                default: {
                    label: "CERRAR",
                    className: "btn-default",
                    callback: function() {
                        
                    }
                },
            }
        });
    })

});



$(document).on('click', '.modal-success', function (event) {
    bootbox.hideAll()
});

//Esta en la cadena de eventos click pero no es determinante para
//el funcionamiento del modal
/*
$(document).on('click', '.kendo-buttons, .card .btn', function(){
	//alert('WSP');
    AlertMessage.removeCurrentAlerts()
})
*/

$(document).on("keypress", ":input:not(textarea)", function(event) {
	
    if (event.keyCode == 13) {
        event.preventDefault();

        var index = $('input, textarea').index(this) + 1;
        $('input, textarea').eq(index).focus();
    }
});