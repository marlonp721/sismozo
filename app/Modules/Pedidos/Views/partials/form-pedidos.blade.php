 <div class="form-group">
    <label for="mesa" class="col-sm-3 control-label"> NUMERO DE MESA :</label>
    <div class="col-sm-4">
        {{ Form::select('mesa', ["MESA 1"=>"MESA 1", "MESA 2"=>"MESA 2", "MESA 3"=>"MESA 3","MESA 4"=>"MESA 4","MESA 5"=>"MESA 5","MESA 6"=>"MESA 6"], null, ['id'=>'cmb_mesa', 'class'=>'form-control select2', 'maxlength'=>'10', 'data-placeholder'=>'Seleccione número de mesa']) }}
    </div>
        <label for="date" class="col-sm-2 control-label" id="txt_fecha">FECHA :</label>
    <div class="col-sm-3">
        {{ Form::label('date', $fecha_actual ?? "", ['id'=>'cmb_fecha2', 'class'=>'form-control', 'placeholder'=>'Ingrese Fecha', 'style'=>"", 'autocomplete'=>'off']) }}
        {{ Form::text('date', $fecha_actual ?? "", ['id'=>'cmb_fecha', 'class'=>'form-control', 'placeholder'=>'Ingrese Fecha', 'style'=>"", 'autocomplete'=>'off']) }}
    </div>
</div>
<div class="form-group">
    <label for="cliente" class="col-sm-3 control-label"> NOMBRE DE CLIENTE :</label>
    <div class="col-sm-5">
        {{ Form::text('client', null, ['id'=>'cmb_cliente','class' => 'form-control', 'placeholder' => 'Ingrese nombre de cliente','autocomplete'=>'off']) }}
    </div>
    <div class="col-sm-4" id="cod_id">
        {{ Form::text('id', null, ['class' => 'form-control', 'placeholder' => 'Ingrese codigo de pedido', 'maxlength' => 15 ,'autocomplete'=>'nope','id'=>'cmb_id']) }}
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
    <div class="col-sm-1 text-right">{{ Form::checkbox('c_ajidegallina', 'true',null, array('id'=>'c_ajidegallina')) }}</div>
    <div class="col-sm-2 text-left" style="padding-top: 3.5px">Aji de Gallina</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px">10.00</div>
    <div class="col-sm-3 text-center">{{ Form::text('r_ajidegallina', null, ['id'=>'cmb_ajidegallina', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off','disabled']) }}</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px" id="monto_ajidegallina"></div>
</div>
<div class="form-group">
    <div class="col-sm-1 text-right">{{ Form::checkbox('c_tallarinconpollo', 'true',null, array('id'=>'c_tallarinconpollo')) }}</div>
    <div class="col-sm-2 text-left" style="padding-top: 3.5px">Tallarin con pollo</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px">10.00</div>
    <div class="col-sm-3 text-center">{{ Form::text('r_tallarinconpollo', null, ['id'=>'cmb_tallarinconpollo', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off','disabled']) }}</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px" id="monto_tallarinconpollo"></div>
</div>
<div class="form-group">
    <div class="col-sm-1 text-right">{{ Form::checkbox('c_lomosaltado', 'true',null, array('id'=>'c_lomosaltado')) }}</div>
    <div class="col-sm-2 text-left" style="padding-top: 3.5px">Lomo Saltado</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px">10.00</div>
    <div class="col-sm-3 text-center">{{ Form::text('r_lomosaltado', null, ['id'=>'cmb_lomosaltado', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off','disabled']) }}</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px" id="monto_lomosaltado"></div>
</div>
<div class="form-group">
    <div class="col-sm-1 text-right">{{ Form::checkbox('c_estofadodepollo', 'true',null, array('id'=>'c_estofadodepollo')) }}</div>
    <div class="col-sm-2 text-left" style="padding-top: 3.5px">Estofado de pollo</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px">10.00</div>
    <div class="col-sm-3 text-center">{{ Form::text('r_estofadodepollo', null, ['id'=>'cmb_estofadodepollo', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off','disabled']) }}</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px" id="monto_estofadodepollo"></div>
</div>
<div class="form-group">
    <div class="col-sm-1 text-right">{{ Form::checkbox('c_tacutacu', 'true',null, array('id'=>'c_tacutacu')) }}</div>
    <div class="col-sm-2 text-left" style="padding-top: 3.5px">Tacu Tacu</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px">10.00</div>
    <div class="col-sm-3 text-center">{{ Form::text('r_tacutacu', null, ['id'=>'cmb_tacutacu', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off','disabled']) }}</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px" id="monto_tacutacu"></div>
</div>
<div class="form-group">
    <div class="col-sm-1 text-right">{{ Form::checkbox('c_chicharron', 'true',null, array('id'=>'c_chicharron')) }}</div>
    <div class="col-sm-2 text-left" style="padding-top: 3.5px">Chicharron</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px">10.00</div>
    <div class="col-sm-3 text-center">{{ Form::text('r_chicharron', null, ['id'=>'cmb_chicharron', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off','disabled']) }}</div>
    <div class="col-sm-3 text-center" style="padding-top: 3.5px" id="monto_chicharron"></div>
</div>
<div class="form-group">
<div class="col-sm-1 text-center"></div>
<div class="col-sm-2 text-center"></div>        
<div class="col-sm-3 text-center"><button data-bb-handler="main" type="button" class="btn btn-primary" id="calcularmonto" >CALCULAR PEDIDO</button></div>
<div class="col-sm-3 text-center" style="padding-top: 12px"><strong>MONTO TOTAL: </strong></div>
<div class="col-sm-3 text-center" style="padding-top: 12px" id="resultmontototal"></div>
</div>

<script src="{{ asset('js/modules/pedidos/form_pedidos.js') }}"></script>