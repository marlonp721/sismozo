<div class="row" style="">
    <div class="row">
        <label style="padding-top: 5px;" for="cmb_apname" class="col-sm-1 control-label">
            AP NAME:
        </label>
        <div class="col-md-2">
            <?php echo e(Form::select('cmb_apname', $ap_name, null, ['id' => 'cmb_apname', 'class' => 'form-control select2 selectUbi', 'data-placeholder' => 'Seleccione AP NAME'])); ?>

        </div>
        <label style="padding-top: 5px;" for="cmb_region" class="col-sm-1 control-label">
            REGION:
        </label>
        <div class="col-md-2">
            <?php echo e(Form::select('cmb_region', $region, null, ['id' => 'cmb_region', 'class' => 'form-control select2 selectUbi', 'data-placeholder' => 'Seleccione Región'])); ?>

        </div>
        <label style="padding-top: 5px;" for="cmb_periodo" class="col-sm-1 control-label">
            PERIODO:
        </label>
        <div class="col-md-2">
            <?php echo e(Form::select('cmb_periodo', [''=>'', '1'=>'Mensual','0'=>'Anual'], null, ['id' => 'cmb_periodo', 'class' => 'form-control select2 selectUbi', 'data-placeholder' => 'Seleccione Periodo'])); ?>


        </div>
        <label style="padding-top: 5px;" for="fecha_fin" class="col-sm-1 control-label" id='labelDate'>
            MES:
        </label>
        <div class="col-md-2">
            <input style="width: 100%" autocomplete="off" type="text" class="form-control" name='fecham' id='fecham'/>
            <input style="width: 100%" autocomplete="off" type="text" class="form-control hidden" name='fechaa' id='fechaa'/>
        </div>
    </div>
</div>


<script type="text/javascript">
    var url_getApnameByRegion="<?php echo e(route('ubigeo.getApnameByRegion')); ?>";
    var url_getRegionByApname="<?php echo e(route('ubigeo.getRegionByApname')); ?>";

</script>