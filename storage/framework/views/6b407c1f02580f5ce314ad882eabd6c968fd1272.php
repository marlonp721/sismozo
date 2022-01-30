<?php $__env->startSection('breadcrumb'); ?>
<li>Reporte Mensual de Tickets de incidentes y fallas</li>
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
                        <span class="title">Reporte Mensual de Tickets de incidentes y fallas</span>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body">
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">

                        <form class="form-inline" id="form-search">

                            <?php if (\Entrust::can('module_report_tickets_month_search') || \Entrust::hasRole('superuser')) : ?>
                            <?php echo $__env->make('Ubigeo::filter_ubigeo_month', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; // Entrust::can ?>
                            <a href="<?php echo e(route('module.report.tickets.month.export.csv')); ?>" disabled="disabled"
                                class="btn btn-default pull-right button-rigth export_  <?php echo e(icon_permission('module_report_tickets_month_export')); ?>" >CSV</a>
                            <a href="<?php echo e(route('module.report.tickets.month.export')); ?>" disabled="disabled"
                                class="btn btn-default pull-right button-rigth export_  <?php echo e(icon_permission('module_report_tickets_month_export')); ?>" id="export_xlsx">XLSX</a>
                            <label for="export_" style="padding-top: 22px;"
                                class="pull-right <?php echo e(icon_permission('module_report_tickets_month_export')); ?>">Exportar : </label>
                            <a href="#"
                                class="btn btn-default pull-right button-rigth <?php echo e(icon_permission('module_report_tickets_month_search')); ?>"
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
                        <div class="content-kendo" id="content-kendo"></div>
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


<script src="<?php echo e(asset('./libraries/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('./libraries/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js')); ?>"></script>
<script type="text/javascript">
      
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


        var url_load_data = "<?php echo e(route('module.report.tickets.month.load')); ?>";

      

</script>
<script src="<?php echo e(asset('js/modules/ubigeo/index.js')); ?>"></script>
<script src="<?php echo e(asset('js/modules/report/TicketsMonth/index.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $('select').select2({allowClear:true});

        $('#fecha').datepicker({
				format: 'yyyy-mm',
				orientation:'bottom',
				endDate:'+0d',
				language: 'es',
				startView: 2,
				minViewMode: 1,
				autoclose: true,
                endDate: "-1m",
            });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>