<?php $__env->startSection('breadcrumb'); ?>
  <li>SEGURIDAD</li>
  <li>PERFILES</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card">

          <div class="card-header">
            <div class="card-title">
              <span class="title">MANTENIMIENTO DE PERFILES</span>
            </div>
            <?php if (\Entrust::can('security_roles_search') || \Entrust::hasRole('superuser')) : ?>
            
              
                
              
              
              
                
              
              
            

            <div class="">
              <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                <div class="col-xs-1 pull-right" style="background:white;height:25px;width:120px;">
                  <?php echo e(Form::text('apn_createatend', null, ['id'=>'apn_createatend', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off'])); ?>

                </div>
                <div class="pull-right" style="text-align: center;"><strong>Hasta</strong></div>
                <div class="col-xs-1 pull-right" style="background:white;height:25px;width:120px;">
                  <?php echo e(Form::text('apn_createatstart', null, ['id'=>'apn_createatstart', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off'])); ?>

                </div>
                <div class="col-xs-1 pull-right"><strong>Fecha: </strong></div>
              </div>

            </div>


            <?php endif; // Entrust::can ?>
            <div class="clearfix"></div>
            <a href="<?php echo e(route('exporting.roles_csv')); ?>" class="btn btn-default pull-right button-rigth export_ <?php echo e(icon_permission('security_roles_export')); ?>" >CSV</a>
            <a href="<?php echo e(route('exporting.roles')); ?>" class="btn btn-default pull-right button-rigth export_ <?php echo e(icon_permission('security_roles_export')); ?>" >XLSX</a>
             <label for="export_" style="padding-top: 22px;" class="pull-right <?php echo e(icon_permission('security_roles_export')); ?>">Exportar : </label>
            <button type="submit" class="btn btn-default pull-right button-rigth <?php echo e(icon_permission('security_roles_search')); ?>"
                    id="button-search">BUSCAR
            </button>

            <?php if (\Entrust::can('security_roles_store') || \Entrust::hasRole('superuser')) : ?>
            <button class="btn btn-default pull-right new-button" id="new-role-entity">NUEVO</button>
            <?php endif; // Entrust::can ?>
          </div>

          
          
          
          
          
          
          
          
          
          

        </div>

        <?php if (\Entrust::can('security_roles_show') || \Entrust::hasRole('superuser')) : ?>
        <div class="card-body">
          <div class="content-kendo">

          </div>
        </div>
        <?php endif; // Entrust::can ?>

      </div>
    </div>
  </div>

  <!-- DELETE FORM -->
  <?php echo Form::open([ 'route' => ['security.roles.destroy', ':ROW_ID'], 'method' => 'DELETE', 'id' => 'form-role-delete']); ?>


  <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.assets.libraries.kendo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.jquery-validation', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.checkbox', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.jstree', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.datetime', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startPush('scripts'); ?>

  <script id="command-template" type="text/x-kendo-template">
    <a title="Detalle" href="\#" class="show-role-entity kendo-buttons <?php echo e(icon_permission('security_roles_show')); ?>">
      <i class="fa fa-lg fa-info"></i>
    </a>
    <a title="Editar" href="\#" class="edit-role-entity kendo-buttons <?php echo e(icon_permission('security_roles_update')); ?>">
      <i class="fa fa-lg fa-pencil"></i>
    </a>
    <a title="Eliminar" href="\#" class="delete-role-entity <?php echo e(icon_permission('security_roles_destroy')); ?>">
      <i class="fa fa-lg fa-trash"></i>
    </a>
  </script>
  <script id="estado-template" type="text/x-kendo-template">
    #if(deleted_at !=null){#
    Inactivo
    #}else{#
    Activo
    #}#


  </script>
  <script>
    $.datetimepicker.setLocale('es');
    var permission_search_role = "<?php echo e(icon_permission('security_roles_search')); ?>"
    $(".export_").click(function (e) {
      e.preventDefault();
      const url = $(this).prop('href');
      grid = $('.content-kendo').data('kendoGrid').dataSource;
      let json = '';
      if (grid.filter() != undefined)
        json = 'json=' + decodeURIComponent(JSON.stringify(grid.filter()));


      //location.href = url + '?' + json;
      window.open(url + '?' + json, '_blank');
    });

    $('#apn_createatstart').datetimepicker({
      //timepicker: false,
      format: 'd/m/Y H:i',
      onShow: function (ct) {
        let d,m,y,datetime,time;
        if ($('#apn_createatend').val()) {
          datetime = $('#apn_createatend').val().split(' ');
          [d, m, y] = datetime[0].split('/');
          time = datetime[1]
        }
        this.setOptions({
          maxDate: $('#apn_createatend').val() ? y + '/' + m + '/' + d : false
        })
      }
    });

    $('#apn_createatend').datetimepicker({
      //timepicker: false,
      format: 'd/m/Y H:i',
      onShow: function (ct) {
        let d,m,y,datetime,time;
        if ($('#apn_createatstart').val()) {
          datetime = $('#apn_createatstart').val().split(' ');
          [d, m, y] = datetime[0].split('/');
          time = datetime[1]
        }
        this.setOptions({
          minDate: $('#apn_createatstart').val() ? y + '/' + m + '/' + d : false
        })
      },
    });

    $('#button-search').on('click', function (e) {
      e.preventDefault();
      let startDate = $('#apn_createatstart').val();
      let endDate = $('#apn_createatend').val();
      let column = 'created_at';
      if (startDate == '' || endDate == '') {
        console.log("are");

        return false;
      }

      let filters = $('.content-kendo').data('kendoGrid').dataSource;
      let between = [
        {
          "field": column,
          "operator": "gte",
          "value": startDate+':00'
        },
        {
          "field": column,
          "operator": "lte",
          "value": endDate+':59'
        }
      ];
      console.log(between)
      let contarFilter = [];
      if (filters.filter() === undefined) {

        filters.filter(between);
      } else {
        filters_ = Array.from(filters.filter().filters).filter(i => (Array.isArray(i.filters) && i.filters[0].field !== column) || (i.field != column)
      )
        ;
        filters.filter(filters_.concat(between));
      }

    });


    var url_load_roles = "<?php echo e(route('security.roles.load')); ?>";

    var RoleSettings = newModalSettings();
    var RoleCRUD = newModalCRUD();

    RoleSettings.entity = 'PERFIL';
    RoleSettings.selector = 'role';
    RoleSettings.create.url = "<?php echo e(route('security.roles.create')); ?>";
    RoleSettings.show.url = "<?php echo e(route('security.roles.show', ':ROW_ID')); ?>";
    RoleSettings.edit.url = "<?php echo e(route('security.roles.edit', ':ROW_ID')); ?>";
    RoleSettings.delete.url = "<?php echo e(route('security.roles.delete', ':ROW_ID')); ?>";

    RoleCRUD.init(RoleSettings);

  </script>

  <script src="<?php echo e(asset('js/modules/security/roles/index.js')); ?>"></script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>