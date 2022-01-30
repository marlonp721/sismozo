<?php $__env->startSection('breadcrumb'); ?>
<li>ESTADISTICA DE TRAFICO DE SUBIDA Y BAJADA DEL SERVICIO DE WIFI</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <span class="title">TRAFICO DE SUBIDA Y BAJADA DEL SERVICIO DE WIFI</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                        <form class="form-inline" id="form-search">
                            <?php if (\Entrust::can('module_wifi_graphic_search') || \Entrust::hasRole('superuser')) : ?>
                            <?php echo $__env->make('Ubigeo::filter_wifi_graphic',['f_i'=>$f_i,'f_f'=>$f_f], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; // Entrust::can ?>
                            <a href="#"
                                class="btn btn-default pull-right button-rigth <?php echo e(icon_permission('module_wifi_graphic_search')); ?>"
                                id="btn_consultar">Consultar
                            </a>
                            <?php if (\Entrust::can('module_wifi_graphic_search') || \Entrust::hasRole('superuser')) : ?>
                              <div class="filter_dato" style="padding-top: 20px;margin-left: -10px;">
                                <label for="chk_data">Visualizar: </label>
                                <input name="chk_data" class="filter_data" value="dia" type="radio" checked="">Por día
                                <input name="chk_data" class="filter_data" value="hora" type="radio">Por Hora        
                            </div>
                            <?php endif; // Entrust::can ?>
                        </form>
                    </div>
                </div>
                <br>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12" id="CBcontainer1" style="display: none;">
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-12" id="CBcontainer2" style="display: none;">
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-12" id="CBcontainer3" style="display: none;">
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.kendo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.jquery-validation', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.checkbox', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.select2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.datetime', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    var load_graphic_url = "<?php echo e(route('module.wifi.loadgraphic')); ?>";
    var id = <?php echo json_encode($id, 15, 512) ?>;
    $.datetimepicker.setLocale('es');
    $('#fecha_ini').datetimepicker({
        timepicker: false,
        format: 'd/m/Y' ,
        step: 5,
        onShow:function( ct ){
            let d,m,y;
            if ($('#fecha_fin').val()) {
                [d, m, y] = $('#fecha_fin').val().split('/');
                y = y.split(' ')[0];
            }
            this.setOptions({
                maxDate:$('#fecha_fin').val()?y + '/' + m + '/' + d:false   
            })
        }
    });
    $('#fecha_fin').datetimepicker({
        timepicker: false,
        format: 'd/m/Y' ,
        step: 5,
        onShow: function( ct ) {   
            let d,m,y;
            if ($('#fecha_ini').val()) {
                [d, m, y] = $('#fecha_ini').val().split('/');
                y = y.split(' ')[0];
            }         
            this.setOptions({
                minDate:$('#fecha_ini').val()?new Date( y + '/' + m + '/' + d):false
            })
        },
    });

</script>
<script src="<?php echo e(asset('js/modules/ubigeo/index.js')); ?>"></script>
<script src="<?php echo e(asset('js/modules/wifi/graphic/index.js')); ?>"></script>
<script src="<?php echo e(asset('libraries/highcharts/highcharts-v9.1.2.js')); ?>"></script>
<script src="<?php echo e(asset('libraries/highcharts/valid.js')); ?>"></script>
<script src="<?php echo e(asset('libraries/highcharts/exporting_v9.2.js')); ?>"></script>
<script src="<?php echo e(asset('libraries/highcharts/export-data.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $('select').select2({allowClear:true});
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>