@extends('layouts.admin.app')

@section('breadcrumb')
    <li>SEGURIDAD</li>
    <li>USUARIOS</li>
@endsection

@section('content')

<div class="row">
    <div class="col-xs-12">
        <div class="card">
            <div class="card">
                <div class="card-header">

                    <div class="card-title">
                        <span class="title">MANTENIMIENTO DE USUARIOS</span>

                    </div>
                    @permission('security_users_search')
                    {{--<div class="">--}}

                    {{--<div class="col-xs-1 pull-right">--}}
                      {{--{{ Form::text('apn_createatend', null, ['id'=>'apn_createatend', 'class'=>'form-control pull-right', 'placeholder'=>'', 'style'=>"background:white;height:25px;width:120px;"]) }}--}}
                    {{--</div>--}}
                    {{--<div class="col-sx-1 pull-right" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>--}}
                    {{--<div class="col-xs-1 pull-right">--}}
                      {{--{{ Form::text('apn_createatstart', null, ['id'=>'apn_createatstart', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"background:white;height:25px;width:120px;"]) }}--}}
                    {{--</div>--}}
                    {{--<div class="col-xs-1 pull-right"><strong>Fecha: </strong> </div>--}}
                  {{--</div>--}}

                  <div class="">
                      <div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">

                        <div class="col-xs-1 pull-right " style="background:white;height:25px;width:120px;">
                          {{ Form::text('apn_createatend', null, ['id'=>'apn_createatend', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off']) }}
                        </div>
                        <div class=" pull-right" style="text-align: center;"><strong>Hasta</strong></div>
                        <div class="col-xs-1 pull-right" style="background:white;height:25px;width:120px;">
                          {{ Form::text('apn_createatstart', null, ['id'=>'apn_createatstart', 'class'=>'form-control', 'placeholder'=>'', 'style'=>"", 'autocomplete'=>'off']) }}
                        </div>
                        <div class="col-xs-1 pull-right"><strong>Fecha: </strong> </div>



                      </div>


                  </div>
                    @endpermission
<div class="clearfix"></div>
{{--{{ Form::select('ext', array('csv' => 'csv', 'txt' => 'txt', 'xlsx' => 'xlsx'), null, ['class' => 'new-button pull-right ', 'id' => 'ext']) }}--}}

                    <a href="{{ route('exporting.users_csv') }}" class="btn btn-default pull-right button-rigth export_  {{ icon_permission('security_users_export') }}" >CSV</a>
                    <a href="{{ route('exporting.users') }}" class="btn btn-default pull-right button-rigth export_  {{ icon_permission('security_users_export') }}" >XLSX</a>
                    <label for="export_" style="padding-top: 22px;" class="pull-right {{ icon_permission('security_users_export') }}">Exportar : </label>
                    <button type="submit" class="btn btn-default pull-right button-rigth {{ icon_permission('security_users_search') }}" id="button-s">BUSCAR</button>

                    @permission('security_users_store')
                    <button class="btn btn-default pull-right new-button" id="new-user-entity">NUEVO</button>
                    @endpermission
                </div>

                {{--@permission('security_users_load')--}}
                    {{--<div class="card-body">--}}
                        {{--<form class="form-inline" id="form-search">--}}
                            {{--<div class="form-group">--}}
                                {{--<input type="text" class="form-control" name="fullname" id="fullname" placeholder="Nombres" maxlength="45">--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<input type="text" class="form-control" name="username" id="username" placeholder="Usuario" maxlength="45">--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<input type="email" class="form-control" name="email" id="email" placeholder="Correo Personal" maxlength="80">--}}
                            {{--</div>--}}
                            {{--<button type="submit" class="btn btn-default" id="button-search">BUSCAR</button>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--@endpermission--}}

            </div>
          @php
          $rol = \Entrust::hasRole('superuser');
          $permiso = \Entrust::can('security_users_load');
           //dd($rol);
           //print_r($permiso);

          @endphp

            @permission('security_users_show')
                <div class="card-body">
                   <div class="content-kendo"></div>
                </div>
            @endpermission

        </div>
    </div>
</div>

<!-- DELETE FORM -->
{!! Form::open([ 'route' => ['security.users.destroy', ':ROW_ID'], 'method' => 'DELETE', 'id' => 'form-user-delete']) !!}

{!! Form::close() !!}

@endsection

@include('layouts.admin.assets.libraries.kendo')
@include('layouts.admin.assets.libraries.jquery-validation')
@include('layouts.admin.assets.libraries.checkbox')
@include('layouts.admin.assets.libraries.select2')
@include('layouts.admin.assets.libraries.datetime')

@push('scripts')

    <script id="command-template" type="text/x-kendo-template">
        <a title="Detalle"  href="\#" class="show-user-entity kendo-buttons {{ icon_permission('security_users_show') }}">
            <i class="fa fa-lg fa-info"></i>
        </a>
        <a title="Editar"   href="\#" class="edit-user-entity kendo-buttons {{ icon_permission('security_users_update') }}">
            <i class="fa fa-lg fa-pencil"></i>
        </a>
        <a title="Eliminar" href="\#" class="delete-user-entity {{ icon_permission('security_users_destroy') }}">
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


    <script type="text/javascript">
        $.datetimepicker.setLocale('es');
      var permission_search_user ="{{ icon_permission('security_users_search') }}"
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
            //timepicker: false,
            format: 'd/m/Y H:i',
            onShow:function( ct ){
                let d,m,y,time,datetime;
                if ($('#apn_createatend').val()) {
                    datetime = $('#apn_createatend').val().split(' ');
                    [d, m, y] = datetime[0].split('/');
                    time = datetime[1]
                }
                this.setOptions({
                    maxDate:$('#apn_createatend').val()? y + '/' + m + '/' + d:false,
                    //maxTime:time
                })
            }
        });

        $('#apn_createatend').datetimepicker({
            //timepicker: false,
            format: 'd/m/Y H:i',
            onShow:function( ct ){   
                let d,m,y,datetime,time;
                if ($('#apn_createatstart').val()) {
                    datetime = $('#apn_createatstart').val().split(' ');
                    [d, m, y] = datetime[0].split('/');
                    time = datetime[1]
                }         
                this.setOptions({
                    minDate:$('#apn_createatstart').val()? y + '/' + m + '/' + d:false,
                    //maxTime:time
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
                    "value": startDate+':00'
                },
                {
                    "field": column, 
                    "operator": "lte", 
                    "value": endDate+':59'
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
                


        var url_load_users       = "{{ route('security.users.load') }}";

        var UserSettings = newModalSettings();

        var UserCRUD     = newModalCRUD();

        UserSettings.entity     = 'USUARIO';
        UserSettings.selector   = 'user';
        UserSettings.show.url   = "{{ route('security.users.show', ':ROW_ID') }}";
        UserSettings.edit.url   = "{{ route('security.users.edit', ':ROW_ID') }}";
        UserSettings.create.url = "{{ route('security.users.create') }}";
        UserSettings.delete.url = "{{ route('security.users.delete', ':ROW_ID') }}";
        //console.log(UserSettings)
        UserCRUD.init(UserSettings);

    </script>

    <script src="{{ asset('js/modules/security/users/index.js') }}"></script>

@endpush

