<?php $__env->startSection('breadcrumb'); ?>
<li>Wireless Client Session</li>

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
                        <span class="title">Wireless Client Session</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                        <form class="form-inline" id="form-search">

                            <?php if (\Entrust::can('module_wifi_wirelessclientsession_search') || \Entrust::hasRole('superuser')) : ?>
                            <?php echo $__env->make('Ubigeo::filter_wirelessclientsession',['f_i'=>$f_i,'f_f'=>$f_f], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; // Entrust::can ?>
                            <!-- <a href="<?php echo e(route('module.wifi.wirelessclient.export.csv')); ?>"
                                class="btn btn-default pull-right button-rigth export_ disabled <?php echo e(icon_permission('module_wifi_wirelessclient_export')); ?>" id="w_csv">CSV</a>
                            <a href="<?php echo e(route('module.wifi.wirelessclient.export')); ?>"
                                class="btn btn-default pull-right button-rigth export_ disabled <?php echo e(icon_permission('module_wifi_wirelessclient_export')); ?>" id="w">XLSX</a>
                            <label for="export_" style="padding-top: 22px;"
                                class="pull-right <?php echo e(icon_permission('module_wifi_wirelessclient_export')); ?>">Exportar : </label> -->
                            <a href="#"
                                class="btn btn-default pull-right button-rigth <?php echo e(icon_permission('module_wifi_wirelessclientsession_search')); ?>"
                                id="btn_consultar">Consultar
                            </a>
                            <a href="<?php echo e(url('wifi/wirelessclienthistorical')); ?>"
                                class="btn btn-default pull-right button-rigth <?php echo e(icon_permission('module_wifi_wirelessclientsession_search')); ?>"
                                id="#datos_historicos">Ver datos historicos...
                            </a>
                        </form>
                    </div>
                </div>
                <br>
            </div>
            <div class="card-body">
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="content-kendo" style="text-align: left;"></div>
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
<script id="command-template" type="text/x-kendo-template">
        <a title ="descarga" href="#" download="#">Descarga</a>
    </script>

<script src="<?php echo e(asset('./libraries/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('./libraries/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js')); ?>"></script>

<script type="text/javascript">
    // var permission_trafico_search ="<?php echo e(icon_permission('module_trafico_search')); ?>"
    // var load_graphic_url = "<?php echo e(route('module.trafico.load.graphic')); ?>";
    // var permissions_datos="<?php echo e(icon_permission('module_trafico_datos')); ?>"
    // var url_images = "<?php echo e(url('/images/trafico/')); ?>";
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
            grid = $('.content-kendo').data('kendoGrid').dataSource;
            let json ='';
            if (grid.filter() != undefined)
                json = 'json=' + decodeURIComponent(JSON.stringify(grid.filter()));

            window.open(url + '?' + json, '_blank');
        });

        
</script>
<script src="<?php echo e(asset('js/modules/ubigeo/index_apname.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $('select').select2({allowClear:true});
    });
</script>
<script>
    $(document).ready(function() {
        $('.content-kendo').hide();


        $('select').select2({allowClear:true});
        
        $('#btn_consultar').on('click', function (e) {

            e.preventDefault();
            let device = $("#cmb_apname").val();
            let region = $('#cmb_region').val();
            let provincia = $('#cmb_province').val();
            let distrito = $('#cmb_distrito').val();
            let startDate = $('#fecha_ini').val();
            let endDate = $('#fecha_fin').val();

            let r_startDate = startDate.split(" ");
            let r_endDate = endDate.split(" ");

            let s_startDate = r_startDate[0].split("/");
            let s_endDate = r_endDate[0].split("/");
            var day1 = new Date(s_startDate[1]+"/"+s_startDate[0]+"/"+s_startDate[2]);
            var day2 = new Date(s_endDate[1]+"/"+s_endDate[0]+"/"+s_endDate[2]);
            var difference= Math.abs(day2-day1);
            days = difference/(1000 * 3600 * 24)
            if(days>30){
                AlertMessage.printError('.side-body', 'Debe seleccionar fechas en un rango menor a 30 días');
                   return false;
            }
            AlertMessage.removeCurrentAlerts();

            $("#w").removeClass('disabled');
            $("#w_csv").removeClass('disabled');

            let filters = $('.content-kendo').data('kendoGrid').dataSource;

            if(startDate=='' || endDate=='')
            {
               AlertMessage.printError('.side-body', 'Debe seleccionar una fecha');
                   return false;
            }
            AlertMessage.removeCurrentAlerts();

            $('.content-kendo').show();            
            let between = [];
            if(device!=0){
                between.push({"field": 'cpe_id',"operator": "eq","value": device})
            }

            between.push({
                    "field": 'date',"operator": "gte","value": startDate+':00',
                });

            between.push({
                    "field": 'date', "operator": "lte","value": endDate+':00',
                });

            if(region != '')
            {
                between.push({"field": 'region',"operator": "eq", "value": region})
            }
            if(provincia != '')
            {
                between.push({"field": 'provincia', "operator": "eq", "value": provincia
                })
            }
            if(distrito != '')
            {
                between.push({"field": 'distrito', "operator": "eq", "value": distrito
                })
            }

                
            let contarFilter = [];
            if (filters.filter() === undefined) {
                    
                filters.filter(between);
            } else {
                filters_ = Array.from(filters.filter().filters).filter(i => (Array.isArray(i.filters) && i.filters[0].field!=='cpe_id' && i.filters[0].field!=='date' && i.filters[0].field!=='region' && i.filters[0].field!=='provincia' && i.filters[0].field!=='distrito') || ( i.field!='cpe_id' && i.field!='date' &&  i.field!='region' && i.field!='provincia' && i.field!='distrito'));
                filters.filter(filters_.concat(between));
            }

        });
    });
    var url_load_wireless = "<?php echo e(route('module.wifi.loadwireless')); ?>";
</script>
<script type="text/javascript">
    $(document).on('ready', function(){

    // KENDO GRID
    var col = [
        {field:'client_name',sortable:true,   title:'Client Name', attributes:{'class':'text-left'}, width: 150},
        {field:'group_name',sortable:true,   title:'Group Name', attributes:{'class':'text-left'}, width: 120},
        {field:'ap_name',sortable:true,   title:'AP Name', attributes:{'class':'text-left'}, width: 150},
        {field:'wifi_mac',sortable:true,   title:'AP Mac', attributes:{'class':'text-left'}, width: 120},
        {field:'associated_ssid',sortable:true,   title:'Associated SSID', attributes:{'class':'text-left'}, width: 160},
        {field:'working_mode',sortable:true,   title:'Working Mode', attributes:{'class':'text-left'}, width: 160},
        {field:'attached_band',sortable:true,   title:'Attached Band', attributes:{'class':'text-left'}, width: 160},
        {field:'client_mac',sortable:true,   title:'Client Mac', attributes:{'class':'text-left'}, width: 120},
        {field:'client_ipv4_address',sortable:true,   title:'Client Ipv4 Address', attributes:{'class':'text-left'}, width: 200},
        {field:'device_category',sortable:true,   title:'Device Category', attributes:{'class':'text-left'}, width: 160},
        {field:'device_os',sortable:true,   title:'Device OS', attributes:{'class':'text-left'}, width: 120},
        {field:'associate_time',sortable:true,   title:'Associated time', attributes:{'class':'text-left'}, width: 160},
        {field:'time_connected',sortable:true,   title:'Time Connected', attributes:{'class':'text-left'}, width: 160},
        {field:'channel',sortable:true,   title:'Channel', attributes:{'class':'text-left'}, width: 120},
        {field:'rx_total',sortable:true,   title:'Rx Total', attributes:{'class':'text-left'}, width: 120},
        {field:'tx_total',sortable:true,   title:'Tx Total', attributes:{'class':'text-left'}, width: 120},
        {field:'rx_rate',sortable:true,   title:'Rx Rate', attributes:{'class':'text-left'}, width: 120},
        {field:'tx_rate',sortable:true,   title:'Tx Rate', attributes:{'class':'text-left'}, width: 120},
        {field:'access_role_profile',sortable:true,   title:'Access Role Profile', attributes:{'class':'text-left'}, width: 200},
        {field:'vlan',sortable:true,   title:'Vlan', attributes:{'class':'text-left'}, width: 90},
        {field:'client_ipv6_address',sortable:true,   title:'Client Ipv6 Address', attributes:{'class':'text-left'}, width: 200},
        {field:'security_type',sortable:true,   title:'Security Type', attributes:{'class':'text-left'}, width: 160},
        {field:'location',sortable:true,   title:'Location', attributes:{'class':'text-left'}, width: 120},
        {field:'username',sortable:true,   title:'User Name', attributes:{'class':'text-left'}, width: 120},
        {field:'rssi',sortable:true,   title:'Rssi', attributes:{'class':'text-left'}, width: 100},
        {field:'phy_rx_rate',sortable:true,   title:'Phy Rx Rate', attributes:{'class':'text-left'}, width: 160},
        {field:'phy_tx_rate',sortable:true,   title:'Phy Tx Rate', attributes:{'class':'text-left'}, width: 160},
    ];
    (new KendoSettings())
        .setUrl(url_load_wireless)
        .setWrapper('.content-kendo')
        .setPage(10)
        .setcolumns(col)
        .render();

})
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>