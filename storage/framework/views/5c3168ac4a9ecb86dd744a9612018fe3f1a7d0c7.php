 <div class="form-group">
    <label for="mesa" class="col-sm-3 control-label"> NUMERO DE MESA :</label>
    <div class="col-sm-4">
        <?php echo e(Form::select('mesa', [""=>"","MESA 1"=>"MESA 1", "MESA 2"=>"MESA 2", "MESA 3"=>"MESA 3","MESA 4"=>"MESA 4","MESA 5"=>"MESA 5","MESA 6"=>"MESA 6"], null, ['id'=>'cmb_mesa', 'class'=>'form-control select2', 'maxlength'=>'10', 'data-placeholder'=>'Seleccione número de mesa'])); ?>

    </div>
        <label for="date" class="col-sm-2 control-label" id="txt_fecha">FECHA :</label>
    <div class="col-sm-3">
    <?php echo e(Form::text('date', $fecha_actual ?? "", ['id'=>'cmb_fecha', 'class'=>'form-control', 'placeholder'=>'Ingrese Fecha', 'style'=>"", 'autocomplete'=>'off'])); ?>

    </div>
</div>
<div class="form-group">
    <label for="cliente" class="col-sm-3 control-label"> NOMBRE DE CLIENTE :</label>
    <div class="col-sm-5">
        <?php echo e(Form::text('client', null, ['class' => 'form-control', 'placeholder' => 'Ingrese nombre de cliente', 'maxlength' => 45 ,'autocomplete'=>'nope','id'=>'cmb_cliente'])); ?>

    </div>
    <div class="col-sm-4" id="cod_id">
        <?php echo e(Form::text('id', null, ['class' => 'form-control', 'placeholder' => 'Ingrese codigo de pedido', 'maxlength' => 15 ,'autocomplete'=>'nope','id'=>'cmb_id'])); ?>

    </div>
</div>
<div class="form-group">
    <div class="col-sm-12 text-center"><H4>CARTA DE PLATOS</H4></div>
</div>
<div class="form-group">
    <div class="col-sm-3 text-center"><strong>PLATOS</strong></div>
    <div class="col-sm-3 text-center"><strong>PRECIO</strong></div>
    <div class="col-sm-3 text-center"><strong>CANTIDAD</strong></div>
    <div class="col-sm-3 text-center"><strong>MONTO</strong></div>
</div>
<div class="form-group">
    <div class="col-sm-1 text-right"><?php echo e(Form::checkbox('c_ajidegallina', 'true',null, array('id'=>'c_ajidegallina'))); ?></div>
    <div class="col-sm-2 text-left" style="padding-top: 3.5px">Aji de Gallina</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px">10.00</div>
    <div class="col-sm-3 text-center"><?php echo e(Form::text('r_ajidegallina', null, ['id'=>'cmb_ajidegallina', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off','disabled'])); ?></div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px" id="monto_ajidegallina"></div>
</div>
<div class="form-group">
    <div class="col-sm-1 text-right"><?php echo e(Form::checkbox('c_tallarinconpollo', 'true',null, array('id'=>'c_tallarinconpollo'))); ?></div>
    <div class="col-sm-2 text-left" style="padding-top: 3.5px">Tallarin con pollo</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px">10.00</div>
    <div class="col-sm-3 text-center"><?php echo e(Form::text('r_tallarinconpollo', null, ['id'=>'cmb_tallarinconpollo', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off','disabled'])); ?></div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px" id="monto_tallarinconpollo"></div>
</div>
<div class="form-group">
    <div class="col-sm-1 text-right"><?php echo e(Form::checkbox('c_lomosaltado', 'true',null, array('id'=>'c_lomosaltado'))); ?></div>
    <div class="col-sm-2 text-left" style="padding-top: 3.5px">Lomo Saltado</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px">10.00</div>
    <div class="col-sm-3 text-center"><?php echo e(Form::text('r_lomosaltado', null, ['id'=>'cmb_lomosaltado', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off','disabled'])); ?></div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px" id="monto_lomosaltado"></div>
</div>
<div class="form-group">
    <div class="col-sm-1 text-right"><?php echo e(Form::checkbox('c_estofadodepollo', 'true',null, array('id'=>'c_estofadodepollo'))); ?></div>
    <div class="col-sm-2 text-left" style="padding-top: 3.5px">Estofado de pollo</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px">10.00</div>
    <div class="col-sm-3 text-center"><?php echo e(Form::text('r_estofadodepollo', null, ['id'=>'cmb_estofadodepollo', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off','disabled'])); ?></div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px" id="monto_estofadodepollo"></div>
</div>
<div class="form-group">
    <div class="col-sm-1 text-right"><?php echo e(Form::checkbox('c_tacutacu', 'true',null, array('id'=>'c_tacutacu'))); ?></div>
    <div class="col-sm-2 text-left" style="padding-top: 3.5px">Tacu Tacu</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px">10.00</div>
    <div class="col-sm-3 text-center"><?php echo e(Form::text('r_tacutacu', null, ['id'=>'cmb_tacutacu', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off','disabled'])); ?></div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px" id="monto_tacutacu"></div>
</div>
<div class="form-group">
    <div class="col-sm-1 text-right"><?php echo e(Form::checkbox('c_chicharron', 'true',null, array('id'=>'c_chicharron'))); ?></div>
    <div class="col-sm-2 text-left" style="padding-top: 3.5px">Chicharron</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px">10.00</div>
    <div class="col-sm-3 text-center"><?php echo e(Form::text('r_chicharron', null, ['id'=>'cmb_chicharron', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off','disabled'])); ?></div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px" id="monto_chicharron"></div>
</div>
<div class="form-group">
<div class="col-sm-1 text-center"></div>
<div class="col-sm-2 text-center"></div>        
<div class="col-sm-3 text-center"><button data-bb-handler="main" type="button" class="btn btn-primary" id="calcularmonto" >CALCULAR PEDIDO</button></div>
<div class="col-sm-3 text-center" style="padding-top: 12px"><strong>MONTO TOTAL: </strong></div>
<div class="col-sm-3 text-center" style="padding-top: 12px" id="resultmontototal"></div>
</div>

<script type="text/javascript">

$( "#cod_id" ).hide();
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


    $(document).ready(function() {
    $("#calcularmonto").click(function(){
        $v_ajidegallina = $('#cmb_ajidegallina').val();
        if($v_ajidegallina==''){ $v_ajidegallina=0; }
        $monto_ajidegallina = 10.0 * $v_ajidegallina;
        $('#monto_ajidegallina').html($monto_ajidegallina.toFixed(2));

        $v_tallarinconpollo = $('#cmb_tallarinconpollo').val();
        if($v_tallarinconpollo==''){ $v_tallarinconpollo=0; }
        $monto_tallarinconpollo = 10.0 * $v_tallarinconpollo;
        $('#monto_tallarinconpollo').html($monto_tallarinconpollo.toFixed(2));

        $v_lomosaltado = $('#cmb_lomosaltado').val();
        if($v_lomosaltado==''){ $v_lomosaltado=0; }
        $monto_lomosaltado = 10.0 * $v_lomosaltado;
        $('#monto_lomosaltado').html($monto_lomosaltado.toFixed(2));

        $v_estofadodepollo = $('#cmb_estofadodepollo').val();
        if($v_estofadodepollo==''){ $v_estofadodepollo=0; }
        $monto_estofadodepollo = 10.0 * $v_estofadodepollo;
        $('#monto_estofadodepollo').html($monto_estofadodepollo.toFixed(2));

        $v_tacutacu = $('#cmb_tacutacu').val();
        if($v_tacutacu==''){ $v_tacutacu=0; }
        $monto_tacutacu = 10.0 * $v_tacutacu;
        $('#monto_tacutacu').html($monto_tacutacu.toFixed(2));

        $v_chicharron = $('#cmb_chicharron').val();
        if($v_chicharron==''){ $v_chicharron=0; }
        $monto_chicharron = 10.0 * $v_chicharron;
        $('#monto_chicharron').html($monto_chicharron.toFixed(2));

        $monto_total = $monto_ajidegallina + $monto_tallarinconpollo + $monto_lomosaltado + $monto_estofadodepollo + $monto_tacutacu + $monto_chicharron ;
        $('#resultmontototal').html("<b>"+$monto_total.toFixed(2)+"</b>");

    }); 
});

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
</script>