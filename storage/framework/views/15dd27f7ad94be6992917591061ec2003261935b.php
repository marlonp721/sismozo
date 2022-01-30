<?php $__env->startSection('breadcrumb'); ?>
    <li>ESTADOS</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card">
                <div class="card-header">
                    	<div class="card-title">
	                        <span class="title">ESTADOS DE TERMINAL</span>
	                    </div>
	                    <div class="clearfix"></div>
                </div>
				
				<div class="card-body">
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                        <form class="form-inline" id="form-search">
                          	
                            <?php if (\Entrust::can('module_state_search') || \Entrust::hasRole('superuser')) : ?>
                             <?php echo $__env->make('Ubigeo::filter_ubigeo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                            <?php endif; // Entrust::can ?>
                            <a href="<?php echo e(route('exporting.states_csv')); ?>"
                                class="btn btn-default pull-right button-rigth export_  <?php echo e(icon_permission('module_state_export')); ?>" disabled="true" style="pointer-events: none;" >CSV</a>
                            <a href="<?php echo e(route('exporting.states')); ?>"
                                class="btn btn-default pull-right button-rigth export_  <?php echo e(icon_permission('module_state_export')); ?>" id="export_xlsx" disabled="true" style="pointer-events: none;" >XLSX</a>
                            <label for="export_" style="padding-top: 22px;"
                                class="pull-right <?php echo e(icon_permission('module_state_export')); ?>">Exportar : </label>
                            <a href="#"
                                class="btn btn-default pull-right button-rigth <?php echo e(icon_permission('module_state_search')); ?>"
                                id="btn_consultar">Consultar
                            </a>
                        </form>
              </div>
              <?php if (\Entrust::can('module_quality_datos') || \Entrust::hasRole('superuser')) : ?>
                            <a href="#"
                                class="btn btn-default pull-right button-rigth"
                                id="btn_datos" style="text-align: center;"><i class="fa fa-search-plus" aria-hidden="true"></i>Ver Datos</a>
                        <?php endif; // Entrust::can ?>
              <br>
          </div>
      </div>
      <div class="content_graph" style="display: none;">
          <div class="card-body">    
                    <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
                        <form class="form-inline" id="form-search">
                          <div class="row" id="div-statistics-states" style="display:none">
							<div class="col-sm-10">
								<div class="row">
									<div class="col-md-12">
										<h4>Tiempo de Operatividad 
 (<span id="activity_time"></span>%) </h4>
										<div id="uptime-percent" style="border: 1px solid rgb(230, 230, 230);"></div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<h4>Porcentaje de Actividad (%)
										</h4>
										<div id="uptime-graph"></div>
									</div>
								</div>
							</div>
<!--						<div class="row" style="width:100%"> -->
							<div class="col-sm-2">
								<div class="row">
									<div class="col-md-12">
										<div class="card" id="uptime-status" style="width: 18rem;">
										  <ul class="list-group list-group-flush">
											<li class="list-group-item" id='currentstatus-head'><i class="far fa-dot-circle"></i><b>Estado Actual</b></li>
											<li class="list-group-item" id='currentstatus-body'></li>
										  </ul>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="card" id="uptime-statistics" style="width: 18rem;">
										  <ul class="list-group list-group-flush">
											<li class="list-group-item"><b>Tiempo de actividad</b></li>
											<li class="list-group-item" id='uptime-day'></li>
											<li class="list-group-item" id='uptime-week'></li>
											<li class="list-group-item" id='uptime-month'></li>
										  </ul>
										</div>
										
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="card" id="uptime-downtime" style="width: 18rem;">
										  <ul class="list-group list-group-flush">
											<li class="list-group-item"><b>Fecha de última inactividad (<font COLOR="red">Offline</font>)</b></li>
											<li class="list-group-item" id='downtime-info'></li>
										  </ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					<div id="buttons-exports" style="display:none">
						<a href="<?php echo e(route('exporting.states_csv')); ?>" class="btn btn-default pull-right button-rigth export_  <?php echo e(icon_permission('module_state_export')); ?>" >CSV</a>
						<a href="<?php echo e(route('exporting.states')); ?>" class="btn btn-default pull-right button-rigth export_  <?php echo e(icon_permission('module_state_export')); ?>" id="export_xlsx">XLSX</a>
						<label for="export_" style="padding-top: 22px;" class="pull-right <?php echo e(icon_permission('module_state_export')); ?>">Exportar: </label>
					</div>
							
                        </form>
                    </div>
                </div>
            </div>
                <?php if (\Entrust::can('module_state') || \Entrust::hasRole('superuser')) : ?>
		<div class="card-body">
			<div class="row">
				 <div class="col-md-12">
                        <div class="content-kendo" style="text-align: center;"></div>
                    </div>
			</div>
			<p id="aviso_export" style="display: none;color: #a8a8a8;margin: 0px;padding: 0px;">(*) La funcion de exportar resultados a Excel y CSV podria sufrir lentitud para consultas con resultados superiores a 100 mil registros.</p>
		</div>
	<?php endif; // Entrust::can ?>
	</div>
	
	
	
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.assets.libraries.kendo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.jquery-validation', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.checkbox', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.select2', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.admin.assets.libraries.datetime', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->startPush('scripts'); ?>

    <script id="estado-template" type="text/x-kendo-template">
		#if(estado =='online' || estado =='ONLINE'){#
			<i class="fa fa-lg fa-map-marker" aria-hidden="true" style="color: green;"></i>
		#}else{#
			<i class="fa fa-lg fa-times-circle" aria-hidden="true" style="color: red;"></i>
		#}#
    </script>

    <script type="text/javascript">
	var id = <?php echo json_encode($id, 15, 512) ?>;
	
      var permission_search_states ="<?php echo e(icon_permission('module_state_search')); ?>"
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
		
		
		var dateFormat = function(date) {
            let day = ('0'+(date.getDay() + 1)).slice(-2);
            let moh = ('0'+(date.getMonth() + 1)).slice(-2);
            let yer = date.getFullYear();
            let mit = date.getMinutes();
            let hor = date.getHours();
            return day + '/' + moh + '/' + yer + ' ' + hor + ':' + mit;
        }
		$('#btn_consultar').on('click', function(e) {
			e.preventDefault();
			
			var texto=$("#btn_datos").text();
            let startDate = $('#fecha_ini').val();
            let endDate = $('#fecha_fin').val();
            let cpeID = $('#cmb_elementos').val();
            let column = 'date_status';
            let column_cpe = 'cpe_id';


            if(texto=='Ver Datos')
       		{
       			if(cpeID=='')
		        {
		          AlertMessage.printError('.side-body', 'Seleccione dispositivo');
		          return false;
		        }

	            if(startDate=='' || endDate=='')
		        {
		          AlertMessage.printError('.side-body', 'Seleccione rango de fechas');
		          return false;
		        }
		        AlertMessage.removeCurrentAlerts();

		       

	            /*const $mensaje_export=document.getElementById("aviso_export");
	  			$mensaje_export.style.display="block";
	*/

				$('#div-statistics-states').css('display', '');
				$('#div-table-states').css('display', '');
				$("#aviso_export").css('display','none');
				/*$('#buttons-exports').css('display', '');*/
				
	            
				$.post("<?php echo e(route('module.state.getuptimebar')); ?>",
						{cpe_id: cpeID,
						fecha_ini: startDate,
						fecha_end: endDate}
					)
				.done(function(data) {
					$.each(data,function(i,obj){
						if (!obj.online) {
							char_uptimer_bar.series[0].setVisible(false);
							char_uptimer_bar.series[1].setVisible(false);
	                        $('#activity_time').text('');
							return false;
						}
						porcentaje_online = obj.online*100.0/obj.total;
						porcentaje_offline = 100 - porcentaje_online;
						
						/*percent_width = charwidth*porcentaje_online/100.0;

						if (percent_width <= 0.1)
							percent_width = 0.1;*/
							
						char_uptimer_bar.series[0].setData([porcentaje_offline]);
						char_uptimer_bar.series[1].setData([porcentaje_online]);
						
						//~ char_uptimer_bar.setSize(percent_width,null,true);
						char_uptimer_bar.series[0].setVisible(true);
						char_uptimer_bar.series[1].setVisible(true);
						
						$('#activity_time').text(porcentaje_online.toFixed(3));
					});
				});
				var category = [];
				var data = [];
				$.post("<?php echo e(route('module.state.getuptimegraph')); ?>",
						{cpe_id: cpeID,
						fecha_ini: startDate,
						fecha_end: endDate}
					)
				.done(function(data_) {
					
					$.each(data_,function(i,obj){
						porcentaje_online = obj.online*100.0/obj.total;

						data.push(porcentaje_online);
						
						//category.push(obj.year + '-' + ('0' + obj.month).slice(-2) + '-' + ('0' + obj.day).slice(-2));
						category.push(('0' + obj.day).slice(-2)+'/'+('0' + obj.month).slice(-2)+'/'+obj.year);
						
					});
					if (!char_uptimer_gra.series.length)
						char_uptimer_gra.addSeries(data);
					else 
						char_uptimer_gra.series[0].setData(data);
					
					char_uptimer_gra.series[0].name = 'actividad %';
					char_uptimer_gra.xAxis[0].setCategories(category);
					char_uptimer_gra.series[0].setVisible(true);
				});
				$.post("<?php echo e(route('module.state.getcurrentstatus')); ?>",
						{cpe_id: cpeID}
					)
				.done(function(data_) {
	                if ( !data_.length ) {
	                    $('#currentstatus-body').html('');
	                }
					$.each(data_,function(i,obj){
	                    
						if (obj.status_name == 'online' || obj.status_name == 'ONLINE') {
	                        
							//~ $('#currentstatus-body').html('<i class="fa fa-circle fa-2x" style="color:green;padding-right: 2px;"></i> <span style="color:green;font-size: 30px;">Up</span></br>');
							$('#currentstatus-body').html('<span style="color:green;font-size: 30px;">Online</span></br>');
						} else{
							$('#currentstatus-body').html('<span style="color:red;font-size: 30px;">Offline</span></br>');
						}
					});
				});
				$.post("<?php echo e(route('module.state.getcurrentstatus-day')); ?>",
						{cpe_id: cpeID}
					)
				.done(function(data_) {
					$.each(data_,function(i,obj){
						if (!obj.online || !obj.total) {
							$('#uptime-day').html('<i class="fa fa-circle" style="color:gray;"></i> <b>No hay Data</b> (últimas 24 horas)</br>');
							return;
						}
						porcentaje_online = obj.online*100.0/obj.total;
						$('#uptime-day').html('<i class="fa fa-circle" style="color:green;"></i> <span style="color:green;">' + porcentaje_online.toFixed(3) +'%</span> (últimas 24 horas)</br>');
					});
				});
				$.post("<?php echo e(route('module.state.getcurrentstatus-week')); ?>",
						{cpe_id: cpeID}
					)
				.done(function(data_) {
					$.each(data_,function(i,obj){
						if (!obj.online || !obj.total) {
							$('#uptime-week').html('<i class="fa fa-circle" style="color:gray;"></i>  <b>No hay Data</b> (últimos 7 días)</br>');
							return;
						}
						porcentaje_online = obj.online*100.0/obj.total;
						$('#uptime-week').html('<i class="fa fa-circle" style="color:green;"></i> <span style="color:green;">' + porcentaje_online.toFixed(3) +'%</span> (últimos 7 días)</br>');
					});
				});
				$.post("<?php echo e(route('module.state.getcurrentstatus-month')); ?>",
						{cpe_id: cpeID}
					)
				.done(function(data_) {
					$.each(data_,function(i,obj){
						if (!obj.online || !obj.total) {
							$('#uptime-month').html('<i class="fa fa-circle" style="color:gray;"></i>  <b>No hay Data</b> (últimos 30 días)</br>');
							return;
						}
						porcentaje_online = obj.online*100.0/obj.total;
						$('#uptime-month').html('<i class="fa fa-circle" style="color:green;"></i> <span style="color:green;">' + porcentaje_online.toFixed(3) +'%</span> (últimos 30 días)</br>');
					});
				});
				$.post("<?php echo e(route('module.state.getdowntime-info')); ?>",
						{cpe_id: cpeID}
					)
				.done(function(data_) {
					$.each(data_,function(i,obj) {
						if (obj.max_date_status)
							$('#downtime-info').html('<i class="fa fa-circle" style="color:red;"></i> <span style="color:red;">' + obj.max_date_status +'</span>');
						else
							$('#downtime-info').html('<i class="fa fa-circle" style="color:gray;"></i> <b>No hay Data</b>');
					});
				});
				showKendo();
				$(".export_").css('pointer-events','all');
            	$(".export_").attr('disabled',false);
				$(".content_graph").css('display','block');
            }else
            {
            	if($("#fecha_ini").val()=='' || $("#fecha_fin").val()=='')
	            {
	              AlertMessage.printError('.side-body', 'Seleccione rango de fechas');
	              return false;
	            }

	            AlertMessage.removeCurrentAlerts();

	            $(".export_").css('pointer-events','all');
	            $(".export_").attr('disabled',false);
	            
	            
	            $('#btn_datos').html("<i class='fa fa-bar-chart' aria-hidden='true'></i>Gráfica")
	            
	            var dispo=$("#cmb_elementos").val();
	            var f_i=$("#fecha_ini").val();
	            var f_f=$("#fecha_fin").val();
	            
	            showKendo();
            }

            
		})
        var url_load_states       = "<?php echo e(route('module.state.load')); ?>";
       
      /*  var ConfigSettings = newModalSettings();

        var ConfigCRUD     = newModalCRUD();

        ConfigCRUD.init(ConfigSettings);*/

    </script>

	<script src="<?php echo e(asset('libraries/highcharts/highcharts-v9.1.2.js')); ?>"></script>
    <script src="<?php echo e(asset('js/modules/ubigeo/index.js')); ?>"></script>
    <script src="<?php echo e(asset('js/modules/states/index.js')); ?>"></script>
    <script>
                            $(document).ready(function() {
                                    $('select').select2({allowClear:true});
                            });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>