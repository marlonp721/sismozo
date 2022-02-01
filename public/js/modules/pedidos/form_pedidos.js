$( "#cmb_fecha" ).hide();
$( "#cod_id" ).hide();
$( ".valpedido" ).hide();

var num_mesa;
function obtenerid(id){
    num_mesa = id;
}
switch (num_mesa) {
    case 'num_mesa1':
        $("#cmb_mesa").val('MESA 1').trigger("change", ["llenar"]);
        break;
    case 'num_mesa2':
        $("#cmb_mesa").val('MESA 2').trigger("change", ["llenar"]);
        break;
    case 'num_mesa3':
        $("#cmb_mesa").val('MESA 3').trigger("change", ["llenar"]);
        break;
    case 'num_mesa4':
        $("#cmb_mesa").val('MESA 4').trigger("change", ["llenar"]);
        break;
    case 'num_mesa5':
        $("#cmb_mesa").val('MESA 5').trigger("change", ["llenar"]);
        break;
    case 'num_mesa6':
        $("#cmb_mesa").val('MESA 6').trigger("change", ["llenar"]);
        break;
    default:
        $("#cmb_mesa").val('MESA 1').trigger("change", ["llenar"]);
        break;
    }

function modal_cliente(){
        bootbox.dialog({
            className: 'modal-danger',
            closeButton: false,
            message: "INTRODUCIR NOMBRE DE CLIENTE",
            title: "VALIDACION",
            buttons: {
                default: {
                    label: "CERRAR",
                    className: "btn-danger pr",
                    callback: function() {
                        
                    }
                },
            }
        });
    }

    function validacion_cantidades(){
        $v_ajidegallina = $('#cmb_ajidegallina').val();
        $v_tallarinconpollo = $('#cmb_tallarinconpollo').val();
        $v_lomosaltado = $('#cmb_lomosaltado').val();
        $v_estofadodepollo = $('#cmb_estofadodepollo').val();
        $v_tacutacu = $('#cmb_tacutacu').val();
        $v_chicharron = $('#cmb_chicharron').val();
        if( isNaN($v_ajidegallina) || isNaN($v_tallarinconpollo) || isNaN($v_lomosaltado) || isNaN($v_estofadodepollo) || isNaN($v_tacutacu) || isNaN($v_chicharron) ){
        bootbox.dialog({
            className: 'modal-danger',
            closeButton: false,
            message: "INTRODUCIR SOLO NUMEROS EN LAS CANTIDADES",
            title: "VALIDACION",
            buttons: {
                default: {
                    label: "CERRAR",
                    className: "btn-danger",
                    callback: function() {
                        
                    }
                },
            }
        });
        }
        else
        {
        if($v_ajidegallina==''){ $v_ajidegallina=0; }
        $monto_ajidegallina = 10.0 * $v_ajidegallina;
        $('#monto_ajidegallina').html($monto_ajidegallina.toFixed(2));
    
    
        if($v_tallarinconpollo==''){ $v_tallarinconpollo=0; }
        $monto_tallarinconpollo = 10.0 * $v_tallarinconpollo;
        $('#monto_tallarinconpollo').html($monto_tallarinconpollo.toFixed(2));
    
        
        if($v_lomosaltado==''){ $v_lomosaltado=0; }
        $monto_lomosaltado = 10.0 * $v_lomosaltado;
        $('#monto_lomosaltado').html($monto_lomosaltado.toFixed(2));
    
        
        if($v_estofadodepollo==''){ $v_estofadodepollo=0; }
        $monto_estofadodepollo = 10.0 * $v_estofadodepollo;
        $('#monto_estofadodepollo').html($monto_estofadodepollo.toFixed(2));
    
        
        if($v_tacutacu==''){ $v_tacutacu=0; }
        $monto_tacutacu = 10.0 * $v_tacutacu;
        $('#monto_tacutacu').html($monto_tacutacu.toFixed(2));
    
        
        if($v_chicharron==''){ $v_chicharron=0; }
        $monto_chicharron = 10.0 * $v_chicharron;
        $('#monto_chicharron').html($monto_chicharron.toFixed(2));
        $( ".valpedido" ).show();
        $monto_total = $monto_ajidegallina + $monto_tallarinconpollo + $monto_lomosaltado + $monto_estofadodepollo + $monto_tacutacu + $monto_chicharron ;
        $('#resultmontototal').html("<b>"+$monto_total.toFixed(2)+"</b>");
        }
    }
    
    function validacion_pedidos(){
        $name_client = $('#cmb_cliente').val();
        if( $name_client == ""){
            modal_cliente();
        }
        else{
            validacion_cantidades();
        }
    }
    function botoncalcularmonto(){
    $("#calcularmonto").on("click",function(){
        validacion_pedidos();
    }); 
    }

botoncalcularmonto();

$(document).on('change','input[type="checkbox"]' ,function(e) {
if(this.id=="c_ajidegallina") {
    if(this.checked) {
        $('#cmb_ajidegallina').prop('disabled', false);
    }
    else{
        $('#cmb_ajidegallina').prop('disabled', true);
        $('#cmb_ajidegallina').val('');
        $('#monto_ajidegallina').html('');
        $('#resultmontototal').html('');
    };
}
if(this.id=="c_tallarinconpollo") {
    if(this.checked) {
        $('#cmb_tallarinconpollo').prop('disabled', false);
    }
    else{
        $('#cmb_tallarinconpollo').prop('disabled', true);
        $('#cmb_tallarinconpollo').val('');
        $('#monto_tallarinconpollo').html('');
        $('#resultmontototal').html('');
    };
}
if(this.id=="c_lomosaltado") {
    if(this.checked) {
        $('#cmb_lomosaltado').prop('disabled', false);
    }
    else{
        $('#cmb_lomosaltado').prop('disabled', true);
        $('#cmb_lomosaltado').val('');
        $('#monto_lomosaltado').html('');
        $('#resultmontototal').html('');
    };
}
if(this.id=="c_estofadodepollo") {
    if(this.checked) {
        $('#cmb_estofadodepollo').prop('disabled', false);
    }
    else{
        $('#cmb_estofadodepollo').prop('disabled', true);
        $('#cmb_estofadodepollo').val('');
        $('#monto_estofadodepollo').html('');
        $('#resultmontototal').html('');
    };
}
if(this.id=="c_tacutacu") {
    if(this.checked) {
        $('#cmb_tacutacu').prop('disabled', false);
    }
    else{
        $('#cmb_tacutacu').prop('disabled', true);
        $('#cmb_tacutacu').val('');
        $('#monto_tacutacu').html('');
        $('#resultmontototal').html('');
    };
}
if(this.id=="c_chicharron") {
    if(this.checked) {
        $('#cmb_chicharron').prop('disabled', false);
    }
    else{
        $('#cmb_chicharron').prop('disabled', true);
        $('#cmb_chicharron').val('');
        $('#monto_chicharron').html('');
        $('#resultmontototal').html('');
    };
}
});