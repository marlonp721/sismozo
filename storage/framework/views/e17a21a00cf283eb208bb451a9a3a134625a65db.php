<?php $params = app('App\Modules\Security\Entities\Params'); ?>
<fieldset class="col-sm-12">
    <legend>Comentario</legend>
    <div class="form-group">
    <div class="col-sm-12">
    <?php echo e(Form::textarea('comment_user', null, ['id'=>'comment_user','class' => 'form-control', 'placeholder' => 'Comentario','rows'=>2])); ?>

    </div>
    </div>
</fieldset>
<div class="form-group">
    <label for="status" class="col-sm-2 control-label">Estado <span class="span-rojo"> (*)</span></label>
    <div class="col-sm-4">
        <?php echo e(Form::select('status', ['' => 'Seleccione Estado','1'=>'Activo','0'=>'Inactivo'], null, ['id'=>'status', 'class'=>'form-control select2', 'maxlength'=>'10', 'data-placeholder'=>'Seleccione Estado'])); ?>

    </div>

</div>
