<?php $__env->startSection('breadcrumb'); ?>
<li>CLIENTES WIFI CONECTADOS - DATOS HISTORICOS</li>

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
                        <span class="title">CLIENTES CONECTADOS A ACCESS POINT - DATOS HISTORICOS</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                        <form class="form-inline" id="form-search">

                            <?php if (\Entrust::can('module_wifi_wifi_connected_search') || \Entrust::hasRole('superuser')) : ?>
                            <?php echo $__env->make('Ubigeo::filter_wificonnected',['f_i'=>$f_i,'f_f'=>$f_f], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; // Entrust::can ?>
                                <a href="#"
                                class="btn btn-default pull-right button-rigth <?php echo e(icon_permission('module_wifi_wifi_connected_search')); ?>"
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
                        <div class="content-kendo" style="text-align: center;"></div>
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
<!-- <script src="<?php echo e(asset('js/modules/wifi/wificonnected/index.js')); ?>"></script> -->
<script src="<?php echo e(asset('js/modules/ubigeo/index_apname.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $('select').select2({allowClear:true});
    });
</script>
<script>
    $(document).ready(function() {
        $('.content-kendo').hide();
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
            let device = $("#cmb_apname").val();
            let region = $('#cmb_region').val();
            let periodo = $('#cmb_periodo').val();
            let anio = $('#fechaa').val();
            let mes = $('#fecham').val();

            let filters = $('.content-kendo').data('kendoGrid').dataSource;
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
            AlertMessage.removeCurrentAlerts();
            $('.content-kendo').show();  
            if(periodo=='0'){
                mes='';
            }else{
            var se = mes.split("-");
            semes = se[0];
            seanio = se[1]; 
            }
                        
            let between = [];
            
            if(device!=0){
                between.push({"field": 'cpe_id',"operator": "eq","value": device})
            }
            if(region != '')
            {
                between.push({"field": 'region',"operator": "eq", "value": region})
            }
            /*if(periodo != '')
            {
                between.push({"field": 'periodo', "operator": "eq", "value": periodo})
            }*/
            if(anio != '')
            {
                between.push({"field": 'anio', "operator": "eq", "value": anio})
            }
            if(mes != '')
            {
                between.push({"field": 'mes', "operator": "eq", "value": mes})
            }
                
            let contarFilter = [];
            if (filters.filter() === undefined) {
                    
                filters.filter(between);
            } else {
                filters_ = Array.from(filters.filter().filters).filter(i => (Array.isArray(i.filters) && i.filters[0].field!=='cpe_id' && i.filters[0].field!=='region' && i.filters[0].field!=='anio' && i.filters[0].field!=='mes') || ( i.field!='cpe_id' && i.field!='region' && i.field!='anio' && i.field!='mes'));
                filters.filter(filters_.concat(between));
            }

        });
    });

    var url_load_wifi = "<?php echo e(route('module.wifi.loadwifi')); ?>";
</script>
<script type="text/javascript">

    $(document).on('ready', function(){

    // KENDO GRID

    var col = [
        {field:'region',sortable:true,   title:'REGION', attributes:{'class':'text-center'}, width:50},
        {field:'ap_name',sortable:true,   title:'AP NAME', attributes:{'class':'text-center'}, width: 90},
        {field:'anio',sortable:true,   title:'AÑO', attributes:{'class':'text-center'}, width: 40},
        {field:'mes',sortable:true,   title:'MES', attributes:{'class':'text-center'}, width: 40},
        {field:'historico',sortable:true,   title:'ARCHIVO DATOS HISTORICOS', attributes:{'class':'text-center'}, width: 120},
        // {field:'accion_filewifi',sortable:true,   title:'ACCIÓN', template:kendo.template( "<a href='<?php echo e(url('files/#: historico #')); ?>' download='#: historico #'>Descargar</a>"), attributes:{'class':'text-center','data-id' : "#: id #"}, width: 100},
        {field:'accion_filewifi',sortable:true,   title:'ACCIÓN', template:kendo.template( "<a href='/SSRA_FileTransferDataEntries/DataEntry_Wifi_Client/procesados/#: historico #' download='#: historico #'>Descargar</a>"), attributes:{'class':'text-center','data-id' : "#: id #"}, width: 100},
    ];
    (new KendoSettings())
        .setUrl(url_load_wifi)
        .setWrapper('.content-kendo')
        .setPage(10)
        .setcolumns(col)
        .render();

})
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>