<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
            <div class="card-body">
                <div class="form-horizontal form-modal-left">

                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">NOMBRE DEL PERFIL</label>
                        <div class="col-sm-8 control-div">
                            {{ Str::upper($role->display_name) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">PERMISOS</label>

                        @if( $role->isSuperuser() )
                            <div class="col-sm-8 control-div"> 
                                ACCESO A TODO
                            </div>
                        @endif

                    </div>

                    <div class="form-group">
                       <div class="detail-role-permissions" id="detail-role-permissions"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@if( ! $role->isSuperuser() )

<script>
    var permissions_role = {!!  json_encode($permissions_role) !!};

    $('#detail-role-permissions').jstree(
        { 'core': { 'data': permissions_role } }
    ).bind("loaded.jstree", function (event, data) {
        $(this).jstree("open_all");
    });
</script>

@endif