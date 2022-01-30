<?php $__env->startSection('breadcrumb'); ?>
    <li>SEGURIDAD</li>
    <li>WIFI</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card">
                <div class="card-header">

                    <div class="card-title">
                        <span class="title">MANTENIMIENTO DE WIFI</span>

                    </div>
                    <?php if (\Entrust::can('security_wifis_search') || \Entrust::hasRole('superuser')) : ?>
           
                  <div class="">
                      <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">

                        <div class="col-xs-1 pull-right " style="background:white;height:25px;width:120px;">
                          <?php echo e(Form::text('apn_createatend', null, ['id'=>'apn_createatend', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off'])); ?>

                        </div>
                        <div class=" pull-right" style="text-align: center;"><strong>Hasta</strong></div>
                        <div class="col-xs-1 pull-right" style="background:white;height:25px;width:120px;">
                          <?php echo e(Form::text('apn_createatstart', null, ['id'=>'apn_createatstart', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off'])); ?>

                        </div>
                        <div class="col-xs-1 pull-right"><strong>Fecha: </strong> </div>



                      </div>


                  </div>
                    <?php endif; // Entrust::can ?>
                <div class="clearfix"></div>


                    <a href="<?php echo e(route('exporting.wifis_csv')); ?>" class="btn btn-default pull-right button-rigth export_  <?php echo e(icon_permission('security_wifis_export')); ?>" >CSV</a>
                    <a href="<?php echo e(route('exporting.wifis')); ?>" class="btn btn-default pull-right button-rigth export_  <?php echo e(icon_permission('security_wifis_export')); ?>">XLSX</a>
                    <label for="export_" style="padding-top: 22px;" class="pull-right <?php echo e(icon_permission('security_wifis_export')); ?>">Exportar : </label>
                    <button type="submit" class="btn btn-default pull-right button-rigth <?php echo e(icon_permission('security_wifis_search')); ?>" id="button-s">BUSCAR</button>

                    <?php if (\Entrust::can('security_wifis_store') || \Entrust::hasRole('superuser')) : ?>
                    <button class="btn btn-default pull-right new-button" id="new-equipo-entity">NUEVO</button>
                    <?php endif; // Entrust::can ?>
                    
                </div>

            </div>

			<?php
				$rol = \Entrust::hasRole('superuser');
				$permiso = \Entrust::can('security_users_load');
			?>

			<?php if (\Entrust::can('security_wifis_show') || \Entrust::hasRole('superuser')) : ?>
				<div class="card-body">
					<div class="content-kendo"></div>
				</div>
			<?php endif; // Entrust::can ?>

        </div>
    </div>
</div>

<!-- DELETE FORM -->
<?php echo Form::open([ 'route' => ['security.wifis.destroy', ':ROW_ID'], 'method' => 'DELETE', 'id' => 'form-equipo-delete']); ?>


<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.assets.libraries.kendo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.jquery-validation', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.checkbox', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.select2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.datetime', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startPush('scripts'); ?>

    <script id="command-template" type="text/x-kendo-template">
       
        <a title="Editar"   href="\#" class="edit-equipo-entity kendo-buttons <?php echo e(icon_permission('security_wifis_update')); ?>">
            <i class="fa fa-lg fa-pencil"></i>
        </a>
        <a title="Eliminar" href="\#" class="delete-equipo-entity <?php echo e(icon_permission('security_wifis_destroy')); ?>">
            <i class="fa fa-lg fa-trash"></i>
        </a>
    </script>
    
    <script id="estado-template" type="text/x-kendo-template">
        #if(status =='Inactivo'){#
            Inactivo
        #}else{#
            Activo
        #}#


    </script>

    <script src="<?php echo e(asset('js/modules/security/wifis/functions_wifis.js')); ?>"></script>
    <script type="text/javascript">
      var permission_search_user ="<?php echo e(icon_permission('security_wifis_search')); ?>"
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

        $('#apn_createatstart').datetimepicker({
            timepicker: false,
            format: 'd/m/Y',
            onShow:function( ct ){
                let d,m,y;
                if ($('#apn_createatend').val()) {
                    [d, m, y] = $('#apn_createatend').val().split('/');
                }
                this.setOptions({
                    maxDate:$('#apn_createatend').val()? y + '/' + m + '/' + d:false
                })
            }
        });

        $('#apn_createatend').datetimepicker({
            timepicker: false,
            format: 'd/m/Y',
            onShow:function( ct ){   
                let d,m,y;
                if ($('#apn_createatstart').val()) {
                    [d, m, y] = $('#apn_createatstart').val().split('/');
                }         
                this.setOptions({
                    minDate:$('#apn_createatstart').val()? y + '/' + m + '/' + d:false
                })
            },
        });
        $('#button-s').on('click', function (e) {
            e.preventDefault();
            let startDate = $('#apn_createatstart').val();
            let endDate = $('#apn_createatend').val();
            let column = 'created_at';
            if (startDate == '' || endDate == ''){
                console.log("are");
                
                return false;
            }

            let filters = $('.content-kendo').data('kendoGrid').dataSource;
            let between = [
                {
                    "field": column, 
                    "operator": "gte", 
                    "value": startDate+' 00:00:00'
                },
                {
                    "field": column, 
                    "operator": "lte", 
                    "value": endDate+' 23:59:59'
                }
            ];
            let contarFilter = [];
            if (filters.filter() === undefined) {
                    
                filters.filter(between);
            } else {
                filters_ = Array.from(filters.filter().filters).filter(i => (Array.isArray(i.filters) && i.filters[0].field!==column) || (i.field!=column));
                filters.filter(filters_.concat(between));
            }
                        
        });
                
        var url_load_wifis       = "<?php echo e(route('security.wifis.show')); ?>";
        var ConfigSettings = newModalSettings_wifis();

        var ConfigCRUD     = newModalCRUD_wifis();
        ConfigSettings.entity     = 'EQUIPOS';
        ConfigSettings.selector   = 'equipo';
        ConfigSettings.edit.url   = "<?php echo e(route('security.wifis.edit', ':ROW_ID')); ?>";
        ConfigSettings.create.url = "<?php echo e(route('security.wifis.create')); ?>";
        ConfigSettings.delete.url = "<?php echo e(route('security.wifis.delete', ':ROW_ID')); ?>";
        ConfigCRUD.init(ConfigSettings);
    </script>

    <script src="<?php echo e(asset('js/modules/security/wifis/index.js')); ?>"></script>

<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>