

<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">

        	   <div class="card-header">

                    <div class="card-title">
                        <span class="title">NUEVO USUARIO</span>
                       
                    </div>

                </div>
			<div class="card-body">



			    {!! Form::open([ 'route' => ['security.users.store'], 'class' => 'form-horizontal form-modal-left', 'id' => 'form-user-create' ]) !!}

			        @include('Security::users.partials.modals.form-user')

			        @include('Security::users.partials.modals.form-role')

			    {!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
