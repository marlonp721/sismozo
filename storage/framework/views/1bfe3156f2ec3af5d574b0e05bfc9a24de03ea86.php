<?php $__env->startSection('breadcrumb'); ?>
<li>Reporte de Aplicaciones más usadas</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <span class="title">Reporte de Aplicaciones más usadas</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">

                        <form class="form-inline" id="form-search">

                            <?php if (\Entrust::can('module_report_app_most_used_search') || \Entrust::hasRole('superuser')) : ?>
                            <?php echo $__env->make('Ubigeo::filter_ubigeo',['f_i'=>$f_i,'f_f'=>$f_f], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; // Entrust::can ?>
                            <a href="<?php echo e(route('exporting.app.most.used.csv')); ?>"
                                class="btn btn-default pull-right button-rigth export_  <?php echo e(icon_permission('module_report_app_most_used_export')); ?>" >CSV</a>
                            <a href="<?php echo e(route('exporting.app.most.used')); ?>"
                                class="btn btn-default pull-right button-rigth export_  <?php echo e(icon_permission('module_report_app_most_used_export')); ?>" id="export_xlsx">XLSX</a>
                            <label for="export_" style="padding-top: 22px;"
                                class="pull-right <?php echo e(icon_permission('module_report_app_most_used_export')); ?>">Exportar : </label>
                            <a href="#"
                                class="btn btn-default pull-right button-rigth <?php echo e(icon_permission('module_report_app_most_used_search')); ?>"
                                id="btn_consultar">Consultar
                            </a>
                          
                        </form>

                    </div>
                    
                       
                    
                </div>
                <br>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-11">
                        <div class="content-kendo" id="content-kendo" style="text-align: center;"></div>
                    </div>
                    <div class="col-md-1">
                         <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                            <?php if (\Entrust::can('module_report_app_most_used_datos') || \Entrust::hasRole('superuser')) : ?>
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
    var permission_search_app_most_used ="<?php echo e(icon_permission('module_report_app_most_used_search')); ?>"
    var url_graphics = "<?php echo e(route('module.report.app.most.used.load.graphic')); ?>";
    var permissions_datos="<?php echo e(icon_permission('module_report_app_most_used_datos')); ?>"
    var data = <?php echo json_encode($data, 15, 512) ?>;
    var id = <?php echo json_encode($id, 15, 512) ?>;
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
            var type=$("#btn_datos").text();

             //valores
            var dispo=$("#cmb_elementos").val();
            var f_i=$("#fecha_ini").val();
            var f_f=$("#fecha_fin").val();

            let region=$('#cmb_region').val();
            let provincia=$('#cmb_province').val();
            let distrito=$('#cmb_distrito').val();
            let localidad='';
            let estatus_localidad=$('#cmb_localidad').attr('disabled');
              if(estatus_localidad=='disabled')
              {
                  localidad='';
              }else{
                  localidad=$('#cmb_localidad').val();
              }
            
           
            var json='';
            var export_url=url;

          
            /*export_url=url+'?cpe_id='+dispo;
            if(f_i!='')
            {
                export_url+='&f_i='+f_i+'&f_f='+f_f;
            }

            if(type=='Datos')
            {
                export_url+='&type=datos';
            }else{
                export_url+='&type=grafica&granularidad='+value_chk;
            }
            window.open(export_url,'_blank');*/
           /* grid = $('.content-kendo').data('kendoGrid').dataSource;
            let json ='';
            if (grid.filter() != undefined)
                json = 'json=' + decodeURIComponent(JSON.stringify(grid.filter()));

            
            window.open(url + '?' + json, '_blank');*/
            if(type=='Ver Datos')
            {
                /*if(dispo=='' || dispo=== undefined)
                {
                         AlertMessage.printError('.side-body', 'Seleccione un dispositivo');
                         return false;
                }*/

               
                if($("#fecha_ini").val()=='' || $("#fecha_fin").val()=='')
                {
                  AlertMessage.printError('.side-body', 'Seleccione rango de fechas');
                  return false;
                }

                if(f_i!='')
                {
                    export_url+='?cpe_id='+dispo+'&date_start='+f_i+'&date_end='+f_f+'&type='+type+'&region='+region+'&provincia='+provincia+'&distrito='+distrito+'&localidad='+localidad;
                }else{
                    export_url+='?cpe_id='+dispo+'&type='+type;
                }
                window.open(export_url,'_blank');
               
            }else{
                if($("#fecha_ini").val()=='' || $("#fecha_fin").val()=='')
                {
                  AlertMessage.printError('.side-body', 'Seleccione rango de fechas');
                  return false;
                }
                grid = $('.content-kendo').data('kendoGrid').dataSource;
                let json ='';
                if (grid.filter() != undefined)
                    json = 'json=' + decodeURIComponent(JSON.stringify(grid.filter()));


                //location.href = url + '?'  + json;
                window.open(export_url + '?' + json+'&type='+type, '_blank');
                
            }
        
        });


        var url_load_data = "<?php echo e(route('module.report.app.most.used.load')); ?>";

      

</script>
<script src="<?php echo e(asset('libraries/highcharts/highcharts-v9.1.2.js')); ?>"></script>
<script src="<?php echo e(asset('libraries/highcharts/valid.js')); ?>"></script>
<script src="<?php echo e(asset('js/modules/ubigeo/index.js')); ?>"></script>
<script src="<?php echo e(asset('js/modules/report/AppMostUsed/index.js')); ?>"></script>
<script>
    var url_images = "<?php echo e(url('/images/trafico/')); ?>";
    $(document).ready(function() {
        $('select').select2({allowClear:true});
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>