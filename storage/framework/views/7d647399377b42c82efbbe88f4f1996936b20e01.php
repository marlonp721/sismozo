<?php $__env->startSection('breadcrumb'); ?>
<li>Reporte de Aplicaciones Wifi más Utilizadas</li>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('./libraries/bootstrap-datepicker/css/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <span class="title">Aplicaciones Wifi utilizadas – Datos Históricos</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                        <form class="form-inline" id="form-search">

                            <?php if (\Entrust::can('module_wifi_appwirelesshistorical_search') || \Entrust::hasRole('superuser')) : ?>
                            <?php echo $__env->make('Ubigeo::filter_wificonnected',['f_i'=>$f_i,'f_f'=>$f_f], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; // Entrust::can ?>
                            
                                <a href="#"
                                class="btn btn-default pull-right button-rigth <?php echo e(icon_permission('module_wifi_appwirelesshistorical_search')); ?>"
                                id="btn_consultar">Consultar
                            </a>
                        </form>
                    </div>
                </div>
                <br>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col-md-12">
                        <div id="app-graph" style="text-align: center;"></div>
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
<script id="command-template" type="text/x-kendo-template">
        <a title ="descarga" href="#" download="#">Descarga</a>
    </script>

<script src="<?php echo e(asset('./libraries/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('./libraries/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js')); ?>"></script>

<script type="text/javascript">
    
    $("#app-graph").hide();
    
    // var permission_trafico_search ="<?php echo e(icon_permission('module_trafico_search')); ?>"
    // var load_graphic_url = "<?php echo e(route('module.trafico.load.graphic')); ?>";
    // var permissions_datos="<?php echo e(icon_permission('module_trafico_datos')); ?>"
    // var url_images = "<?php echo e(url('/images/trafico/')); ?>";
    var url_graph = "<?php echo e(route('module.wifi.getappgraph')); ?>";
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

</script>
<!-- <script src="<?php echo e(asset('js/modules/wifi/wificonnected/index.js')); ?>"></script> -->
<script src="<?php echo e(asset('libraries/highcharts/highcharts-v9.1.2.js')); ?>"></script>
<script src="<?php echo e(asset('libraries/highcharts/valid.js')); ?>"></script>
<script src="<?php echo e(asset('libraries/highcharts/exporting_v9.2.js')); ?>"></script>
<script src="<?php echo e(asset('js/modules/ubigeo/index_apname.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $('select').select2({allowClear:true});
    });
</script>
<script>
    $(document).ready(function() {
        app_graph = new Highcharts.Chart('app-graph', {
                chart: {
                },
                legend: {
                    title: {
                        text: '<span style="background-color:gray">Aplicaciones<span><br/>',
                        style: {
                            fontStyle: 'italic'
                        }
                    },
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                title: {
                    text: null
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        }
                    }
                },
                xAxis: {
                    title: {
                        text: null
                    },
                    categories: []
                },

                yAxis: {
                    allowDecimals: false,
                    min: 0,
                    title: {
                        text: 'Suma de bytes'
                    }
                },
                exporting: {
                  buttons: {
                    contextButton: {
                      menuItems:[{
                                textKey:"downloadPNG",
                                text:"Exportar PNG",
                                onclick: function() {
                                    this.exportChart();
                                  }
                              },
                              {
                                textKey:"downloadJPEG",
                                text:"Exportar JPEG",
                                onclick: function() {
                                    this.exportChart({
                                      type: 'image/jpeg'
                                    });
                                  }
                              },
                              {
                                textKey:"downloadPDF",
                                text:"Exportar PDF",
                                onclick: function() {
                                    this.exportChart({
                                    type: 'application/pdf'
                                  });
                                  }
                              },
                          ],

                    }
                  }
                },
                tooltip: {
                    formatter: function () {
                        return '<b>Día : </b>'+this.key+"<br><b>Bytes : </b>" + this.y.toFixed(2);
                    }
                },

                 series: [{
                        name: 'Installation',
                        data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
                    }, {
                        name: 'Manufacturing',
                        data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
                    }]
            }, 	function (e) {
                e.series[0].setVisible(true);
            })
        
        $("#cmb_periodo").on('change',function(){
           var v = $('#cmb_periodo').val()

           if(v==1){
            //esto es mensual
            $("#fecham").removeClass('hidden')
            $("#fechaa").addClass('hidden')
            $('#labelDate').text('MES:')
           }
           else
           {
            //es anual
            $("#fechaa").removeClass('hidden')
            $("#fecham").addClass('hidden')
            $('#labelDate').text('AÑO:')
           }
        })

        $('select').select2({allowClear:true});
        $('#fechaa').datepicker({
                format: "yyyy",
                viewMode: "years", 
                minViewMode: "years",
                autoclose:true
            });
        $('#fecham').datepicker({
                format: "mm-yyyy",
                viewMode: "months", 
                minViewMode: "months"
            });


        $('#btn_consultar').on('click', function (e) {
            
            e.preventDefault();
            let device = $('#cmb_apname').val();
            let region = $('#cmb_region').val();
            let periodo = $('#cmb_periodo').val();
            let anio = $('#fechaa').val();
            let mes = $('#fecham').val();

            if(periodo==''){
                $("#cmb_periodo.select2")
                .val('1')
                .trigger("change", ["llenar"]);
            }
            if(anio=='' && mes=='')
            {
                AlertMessage.printError('.side-body', 'Debe seleccionar una fecha');
                return false;
            }
            $("#app-graph").show();
            AlertMessage.removeCurrentAlerts();
            if (periodo=='1') {
                mes_div  = mes.split('-');
                mes    = mes_div[0];
                anio   = mes_div[1];
            }
            
            var all_data = {};
            var index_app = [];
            
            var index = 12;
            
            if (periodo == 1 ) {//mes
                index = new Date(anio, mes, 0).getDate();
            } 
            
            if (index == 12)
                app_graph.xAxis[0].setCategories(['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic']);
            else {
                var cate = [];
                for (var i = 1; i <= index; i++)
                    cate.push(i);
                app_graph.xAxis[0].setCategories(cate);
            }
            
            while(app_graph.series.length > 0)
                app_graph.series[0].remove(true);
                
            $.post(url_graph,
                    {
                        device:      device,
                        anio:    anio,
                        mes:    mes,
                        region:    region,
                        periodo:  periodo,                        
                    }
                )
            .done( function(data_) {
                console.log(data_);
                $.each( data_, function(i, obj) {
                    var app_name = obj.application_name;
                    var bytes   = obj.sum_byte_count;
                    var year    = obj.year;
                    var month   = obj.month;
                    var day     = obj.day;
                    if (all_data[app_name] == undefined)
                        all_data[app_name] = {};
                    
                    if (all_data[app_name].serie == undefined )
                        all_data[app_name].serie = new Array(index).fill(null);
                    
                    if (periodo == 1) //mes
                        all_data[app_name].serie[day] = +bytes;
                    else //anio
                        all_data[app_name].serie[month] = +bytes;
                });
                
                Object.keys( all_data ).forEach( function( app_name ) {
                    
                    app_graph.addSeries({data:all_data[app_name].serie});
                    
                    app_graph.legend.allItems[app_graph.series.length - 1].update({name:app_name});
                } );
            });
        });
    });

    var url_load_wireless = "<?php echo e(route('module.wifi.loadappwirelesshistorical')); ?>";
</script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>