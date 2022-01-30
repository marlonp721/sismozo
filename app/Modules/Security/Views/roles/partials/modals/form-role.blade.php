<div class="form-group">
    <label for="name" class="col-sm-4 control-label">NOMBRE DEL PERFIL</label>
    <div class="col-sm-8">
        {{ Form::text('display_name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del perfil', 'maxlength'=>255, 'autocomplete'=>'off']) }}
    </div>
</div>

<div class="form-group">
    <label for="name" class="col-sm-4 control-label">DESCRIPCIÓN</label>
    <div class="col-sm-8">
        {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Descripción del Perfil', 'maxlength' => 255, 'rows' => 5]) }}
    </div>
</div>

<div class="form-group">
    {{Form::label('permisos','PERMISOS',['class'=>'col-sm-4 control-label'])}}
</div>

<div id="tree_menu">

</div>

{{ Form::hidden('permissions') }}