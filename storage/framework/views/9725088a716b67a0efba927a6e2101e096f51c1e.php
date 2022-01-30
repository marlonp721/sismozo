<?php $__env->startSection('breadcrumb'); ?>
<li>TICKET</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card">
                <div class="card-header">

                    <div class="card-title">
                        <span class="title">MANTENIMIENTO DE TICKETS</span>
                    </div>
                    <div class="clearfix"></div>

                </div>

                <div class="card-body">
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                        <form class="form-inline" id="form-search">
                            <?php if (\Entrust::can('module_ticket_search') || \Entrust::hasRole('superuser')) : ?>
                            <?php echo $__env->make('Ubigeo::filter_ubigeo',['f_i'=>$f_i,'f_f'=>$f_f], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; // Entrust::can ?>
                            <a href="<?php echo e(route('exporting.tickets_csv')); ?>"
                                class="btn btn-default pull-right button-rigth export_  <?php echo e(icon_permission('module_ticket_export')); ?>">CSV</a>
                            <a href="<?php echo e(route('exporting.tickets')); ?>"
                                class="btn btn-default pull-right button-rigth export_  <?php echo e(icon_permission('module_ticket_export')); ?>" id="export_xlsx">XLSX</a>
                            <label for="export_" style="padding-top: 22px;"
                                class="pull-right <?php echo e(icon_permission('module_ticket_export')); ?>">Exportar : </label>
                            <a href="#"
                                class="btn btn-default pull-right button-rigth <?php echo e(icon_permission('module_ticket_search')); ?>"
                                id="btn_consultar">Consultar
                            </a>

                        </form>
                    </div>
                </div>
                
                <br>
            </div>
            <div class="card-body">
                <div class="content-kendo"></div>
                <p id="aviso_export" style="display: block;color: #a8a8a8;margin: 0px;padding: 0px;">(*) La funcion de exportar resultados a Excel y CSV podria sufrir lentitud para consultas con resultados superiores a 100 mil registros.</p>
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

<script id="command-template" type="text/x-kendo-template">
    <a title="Detalle"  href="\#" class="show-ticket-entity kendo-buttons <?php echo e(icon_permission('module_ticket_show')); ?>">
            <i class="fa fa-lg fa-info"></i>
    </a>
</script>
    

<script type="text/javascript">
    var fecha_ini = "";
    var fecha_fin = "";
    var id = <?php echo json_encode($id, 15, 512) ?>;
    var ruta="<?php echo e(route('module.ticket.show',[':id',':fi',':ff'])); ?>"
    var permission_search_ticket ="<?php echo e(icon_permission('module_ticket_search')); ?>"
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

        $('#btn_consultar').on('click', function (e) {
            e.preventDefault();
            
            let device = $("#cmb_elementos").val();
            let startDate = $('#fecha_ini').val();
            let endDate = $('#fecha_fin').val();
            let column = 'created_at';
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
           

            let filters = $('.content-kendo').data('kendoGrid').dataSource;

            if(startDate=='' || endDate=='')
            {
               AlertMessage.printError('.side-body', 'Seleccione rango de fechas');
                   return false;
            }

            AlertMessage.removeCurrentAlerts();

            let between = [];
            if(device!=0){
                between.push({"field": 'cpe_id',"operator": "eq","value": device})
            }

            between.push({
                    "field": 'date_ticket_start',"operator": "gte","value": startDate+':00',
                });

            between.push({
                    "field": 'date_ticket_start', "operator": "lte","value": endDate+':00',
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
            if(localidad != '')
            {
                between.push({"field": 'localidad', "operator": "eq", "value": localidad})
            }
                
            let contarFilter = [];
            if (filters.filter() === undefined) {
                    
                filters.filter(between);
            } else {
                filters_ = Array.from(filters.filter().filters).filter(i => (Array.isArray(i.filters) && i.filters[0].field!==column && i.filters[0].field!=='cpe_id' && i.filters[0].field!=='date_ticket_start' && i.filters[0].field!=='region' && i.filters[0].field!=='provincia' && i.filters[0].field!=='distrito' && i.filters[0].field!=='localidad') || (i.field!=column && i.field!='cpe_id' && i.field!='date_ticket_start' && i.field!='region' && i.field!='provincia' && i.field!='distrito' && i.field!='localidad'));
                filters.filter(filters_.concat(between));
            }
                        
        });

        var url_load_tickets = "<?php echo e(route('module.ticket.load')); ?>";

       
</script>
<script src="<?php echo e(asset('js/modules/ubigeo/index.js')); ?>"></script>
<script src="<?php echo e(asset('js/modules/ticket/index.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $('select').select2({allowClear:true});
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>