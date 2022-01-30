<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
            <div class="card-body">
                <div class="form-horizontal form-modal-left">
                
                    <div class="form-group">
                        <label for="name" class="col-sm-6 control-label">NOMBRES Y APELLIDOS</label>
                        <div class="col-sm-6 control-div">
                            {{ $user->fullname }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="col-sm-6 control-label">NOMBRE DE USUARIO</label>
                        <div class="col-sm-6 control-div">
                            {{ $user->username }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-sm-6 control-label">CORREO PERSONAL</label>
                        <div class="col-sm-6 control-div">
                            {{ $user->email }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="roles" class="col-sm-6 control-label">PERFILES</label>
                        <div class="col-sm-6 control-div">
                            <ul>
                                @foreach($user->roles as $role)
                                    <li>{{ $role->display_name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
