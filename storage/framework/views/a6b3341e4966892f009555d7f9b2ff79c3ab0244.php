<div class="row" style="">
    <div class="row">
        <label style="padding-top: 5px;" for="cmb_elementos" class="col-sm-1 control-label">
            Dispositivo:
        </label>
        <div class="col-md-2">
            <?php echo e(Form::select('cmb_elementos', $elementos, null, ['id' => 'cmb_elementos', 'class' => 'form-control select2 ', 'data-placeholder' => 'Seleccione Dispositivo'])); ?>

        </div>
        <div class="col-sm-3">

        </div>
        <label style="padding-top: 5px;" for="fecha_ini" class="col-sm-1 control-label">
        </label>
        <div class="col-md-2">
        </div>
        <label style="padding-top: 5px;" for="fecha_fin" class="col-sm-1 control-label">
            Mes:
        </label>
        <div class="col-md-2">
            <input style="width: 100%" autocomplete="off" type="text" class="form-control" id="fecha" />
        </div>
    </div>

    <div class="row">
        <label style="padding-top: 5px;" for="cmb_region" class="col-sm-1 control-label">
            Región:
        </label>
        <div class="col-md-2">
            <?php echo e(Form::select('cmb_region', $region, null, ['id' => 'cmb_region', 'class' => 'form-control select2 selectUbi', 'data-placeholder' => 'Seleccione Región'])); ?>

        </div>
        <label style="padding-top: 5px;" for="cmb_province" class="col-sm-1 control-label">
            Provincia:
        </label>
        <div class="col-md-2">
            <?php echo e(Form::select('cmb_province', $provincia, null, ['id' => 'cmb_province', 'class' => 'form-control select2 selectUbi', 'data-placeholder' => 'Seleccione Provincia'])); ?>

        </div>
        <label style="padding-top: 5px;" for="cmb_distrito" class="col-sm-1 control-label">
            Distrito:
        </label>
        <div class="col-md-2">
            <?php echo e(Form::select('cmb_distrito', $distrito, null, ['id' => 'cmb_distrito', 'class' => 'form-control select2 selectUbi', 'data-placeholder' => 'Seleccione Distrito'])); ?>

        </div>
        <label style="padding-top: 5px;" for="cmb_localidad" class="col-sm-1 control-label">
            Localidad:
        </label>
        <div class="col-md-2">
            <?php echo e(Form::select('cmb_localidad', [], null, ['id' => 'cmb_localidad', 'class' => 'form-control select2 selectUbi', 'data-placeholder' => 'Seleccione Localidad','disabled'=>true])); ?>

        </div>

    </div>


</div>


<script type="text/javascript">
    var url_getElemProDisLocByRegion="<?php echo e(route('ubigeo.getElemProDisLocByRegion')); ?>";
    var url_getElemProDisLoc="<?php echo e(route('ubigeo.getElemProDisLoc')); ?>";
    var url_getElemDisLocByProvincia="<?php echo e(route('ubigeo.getElemDisLocByProvincia')); ?>";
    var url_getElemLocByDistrito="<?php echo e(route('ubigeo.getElemLocByDistrito')); ?>";
    var url_getElemByLocalidad="<?php echo e(route('ubigeo.getElemByLocalidad')); ?>";
    var url_getLocationsByElement="<?php echo e(route('ubigeo.getLocationsByElement')); ?>";
</script>