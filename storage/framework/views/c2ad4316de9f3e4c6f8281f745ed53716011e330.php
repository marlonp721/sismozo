<?php $__env->startSection('breadcrumb'); ?>
<li>Estadística de Aplicaciones por Access Point</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card">
                <div class="card-header">

                    <div class="card-title">
                        <span class="title">Estadística de Aplicaciones por Access Point</span>
                    </div>
                    <div class="clearfix"></div>

                </div>

                <div class="card-body">
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                        <form class="form-inline" id="form-search">
                            <?php if (\Entrust::can('module_wifi_appap_search') || \Entrust::hasRole('superuser')) : ?>
                            <?php echo $__env->make('Ubigeo::filter_appap',['f_i'=>$f_i,'f_f'=>$f_f], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; // Entrust::can ?>
                            
                            <a href="#"
                                class="btn btn-default pull-right button-rigth <?php echo e(icon_permission('module_wifi_appap_search')); ?>"
                                id="btn_consultar">Consultar
                            </a>
                            <a href="<?php echo e(url('wifi/appwirelesshistorical')); ?>"
                                class="btn btn-default pull-right button-rigth <?php echo e(icon_permission('module_wifi_appap_search')); ?>"
                                id="#datos_historicos">Ver datos historicos...
                            </a>
                            <?php if (\Entrust::can('module_wifi_appap_search') || \Entrust::hasRole('superuser')) : ?>
                              
                            <?php endif; // Entrust::can ?>

                        </form>
                    </div>
                </div>
                
                <br>
            
            
            </div>
          
        <div class="content_graph" style="display: block;">
            <div class="card-body"> 
                <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                    <div id="app-graph"></div>
                </div>
            </div>
        </div>
        </div>
        
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.assets.libraries.kendo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.jquery-validation', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.checkbox', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.select2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.datetime', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startPush('scripts'); ?>


<script type="text/javascript">
    $("#app-graph").hide();
    var id = <?php echo json_encode($id, 15, 512) ?>;
    
    $.datetimepicker.setLocale('es');
    
    var today = new Date();
    var today_30 = new Date(today - 1000*24*3600*30);
    
    $('#fecha_ini').datetimepicker({
        timepicker: true,
        format: 'd/m/Y H:i' ,
        step: 5,
        onShow:function( ct ){
            let d,m,y;
            let d_30, m_30, y_30;
            y_30 = today_30.getFullYear();
            m_30 = today_30.getMonth() + 1;
            d_30 = today_30.getDate();
            if ($('#fecha_fin').val()) {
                [d, m, y] = $('#fecha_fin').val().split('/');
                y = y.split(' ')[0];
            } else {
                y = today.getFullYear();
                m = today.getMonth() + 1;
                d = today.getDate();
            }            
            this.setOptions({
                maxDate:y + '/' + m + '/' + d   
            })
            this.setOptions({
                minDate:y_30 + '/' + m_30 + '/' + d_30   
            })
        }
    });
    $('#fecha_fin').datetimepicker({
        timepicker: true,
        format: 'd/m/Y H:i' ,
        step: 5,
        onShow: function( ct ) {
            let d_30,m_30,y_30;
            let d,m,y;
            y = today.getFullYear();
            m = today.getMonth() + 1;
            d = today.getDate();
            if ($('#fecha_ini').val()) {
                [d_30, m_30, y_30] = $('#fecha_ini').val().split('/');
                y_30 = y_30.split(' ')[0];
            } else {
                y_30 = today_30.getFullYear();
                m_30 = today_30.getMonth() + 1;
                d_30 = today_30.getDate();
            }             
            this.setOptions({
                minDate:y_30 + '/' + m_30 + '/' + d_30
            })
            this.setOptions({
                maxDate:y + '/' + m + '/' + d   
            })
        },
    });
    
        
    $(".export_").click(function (e) {
        e.preventDefault();
        //~ console.log('asdas');
         if(typeof $('#fecha_ini').val()==='undefined' || typeof $('#fecha_fin').val()==='undefined')
        {
           AlertMessage.printError('.side-body', 'Seleccione rango de fechas');
               return false;
        }


        const url = $(this).prop('href');
        //~ console.log(url);
        grid = $('.content-kendo').data('kendoGrid').dataSource;
        let json ='';
        if (grid.filter() != undefined)
            json = 'json=' + decodeURIComponent(JSON.stringify(grid.filter()));


        //location.href = url + '?'  + json;
        window.open(url + '?' + json, '_blank');
    });
    var url_load_speed = "<?php echo e(route('module.wifi.app_ap.load')); ?>";
    var url_graph = "<?php echo e(route('module.wifi.app_ap.getappgraph')); ?>";
    
    
       
</script>
<script src="<?php echo e(asset('libraries/highcharts/highcharts-v9.1.2.js')); ?>"></script>
<script src="<?php echo e(asset('libraries/highcharts/valid.js')); ?>"></script>
<script src="<?php echo e(asset('libraries/highcharts/exporting_v9.2.js')); ?>"></script>
<script src="<?php echo e(asset('js/modules/ubigeo/index_apname.js')); ?>"></script>
<script src="<?php echo e(asset('js/modules/wifi/appap/index.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $('select').select2({allowClear:true});
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>