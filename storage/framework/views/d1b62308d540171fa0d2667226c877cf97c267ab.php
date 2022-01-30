<?php $__env->startSection('breadcrumb'); ?>
<li>TRAFICO INTERNET</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <span class="title">TRAFICO INTERNET</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">

                        <form class="form-inline" id="form-search">

                            <?php if (\Entrust::can('module_trafico_search') || \Entrust::hasRole('superuser')) : ?>
                            <?php echo $__env->make('Ubigeo::filter_ubigeo',['f_i'=>$f_i,'f_f'=>$f_f], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; // Entrust::can ?>
                            <a href="<?php echo e(route('exporting.trafico_csv')); ?>"
                                class="btn btn-default pull-right button-rigth export_  <?php echo e(icon_permission('module_trafico_export')); ?>" disabled="true" style="pointer-events: none;" >CSV</a>
                            <a href="<?php echo e(route('exporting.trafico')); ?>"
                                class="btn btn-default pull-right button-rigth export_  <?php echo e(icon_permission('module_trafico_export')); ?>" id="export_xlsx" disabled="true" style="pointer-events: none;" >XLSX</a>
                            <label for="export_" style="padding-top: 22px;"
                                class="pull-right <?php echo e(icon_permission('module_trafico_export')); ?>">Exportar : </label>
                            <a href="#"
                                class="btn btn-default pull-right button-rigth <?php echo e(icon_permission('module_trafico_search')); ?>"
                                id="btn_consultar">Consultar
                            </a>
                            <div class="filter_dato" style="padding-top: 20px;margin-left: -10px;display: none">
                                <label for="chk_data">Visualizar : </label>
                                <input name="chk_data" class="filter_data" value="dia" type="radio" checked="">Por día
                                <input name="chk_data" class="filter_data" value="hora" type="radio">Por Hora        
                                <input name="chk_data" class="filter_data" value="minuto" type="radio">Por minuto      
                            </div>
                        </form>

                    </div>
                    
                       
                    
                </div>
                <br>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col-md-11">
                        <div class="content-kendo" style="text-align: center;"></div>
                    </div>
                    <div class="col-md-1">
                         <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                            <?php if (\Entrust::can('module_trafico_datos') || \Entrust::hasRole('superuser')) : ?>
                            <a href="#"
                                class="btn btn-default"
                                id="btn_datos" style="text-align: center;"><i class="fa fa-search-plus" aria-hidden="true"></i>Ver Datos</a>
                            <?php endif; // Entrust::can ?>
                        </div>
                    </div>     
                </div>
                <p id="aviso_export" style="display: none;color: #a8a8a8;margin: 0px;padding: 0px;">(*) La funcion de exportar resultados a Excel y CSV podria sufrir lentitud para consultas con resultados superiores a 100 mil registros.</p>
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
    var permission_search_ticket ="<?php echo e(icon_permission('module_trafico_search')); ?>"
    var load_graphic_url = "<?php echo e(route('module.trafico.load.graphic')); ?>";
    var permissions_datos="<?php echo e(icon_permission('module_trafico_datos')); ?>"
    var url_images = "<?php echo e(url('/images/trafico/')); ?>";
    var id = <?php echo json_encode($id, 15, 512) ?>;
    var bandwidth = <?php echo json_encode($bandwidth, 15, 512) ?>;
    $.datetimepicker.setLocale('es');
    $('#fecha_ini').datetimepicker({
        timepicker: true,
        format: 'd/m/Y H:i' ,
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
        timepicker: true,
        format: 'd/m/Y H:i' ,
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

        $(".export_").click(function (e) {
            e.preventDefault();
            const url = $(this).prop('href');
            grid = $('.content-kendo').data('kendoGrid').dataSource;
            let json ='';
            if (grid.filter() != undefined)
                json = 'json=' + decodeURIComponent(JSON.stringify(grid.filter()));

            //location.href = url + '?'  + json;
            window.open(url + '?' + json, '_blank');
        });


        var url_load_data = "<?php echo e(route('module.trafico.load')); ?>";

      

</script>
<script src="<?php echo e(asset('js/modules/ubigeo/index.js')); ?>"></script>
<script src="<?php echo e(asset('js/modules/trafico/index.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $('select').select2({allowClear:true});
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>