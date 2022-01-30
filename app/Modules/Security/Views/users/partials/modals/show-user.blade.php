@inject('params', 'App\Modules\Security\Entities\Params')
<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
            <div class="card-body">
                <div class="form-horizontal form-modal-left">
                <div class="form-group">

                .   <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Nombre de Usuario</label>
                        <div class="col-sm-4 control-div">
                            {{ $user->username }}
                        </div>
                      
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-4 control-label">Nombre y Apellidos</label>
                        <div class="col-sm-8 control-div">
                            {{ $user->fullname }}
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="email" class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-8 control-div">
                            {{ $user->email }}
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="email" class="col-sm-4 control-label">Celular</label>
                        <div class="col-sm-8 control-div">
                            {{ $user->cellphone }}
                        </div>
                    </div>

                    <div class="form-group">

                        <label for="email" class="col-sm-4 control-label">Comentario</label>
                        <div class="col-sm-8 control-div">
                            {{ $user->comment_user }}
                        </div>

                    </div>
                    <div class="form-group">

                        <label for="email" class="col-sm-4 control-label">Estado</label>
                        <div class="col-sm-8 control-div">

                           
                            {{  $params::getByStatus($user->status) }}
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="roles" class="col-sm-4 control-label">Perfiles</label>
                        <div class="col-sm-8 control-div">
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
