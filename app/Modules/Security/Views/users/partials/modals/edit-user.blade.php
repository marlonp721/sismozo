<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
			<div class="card-body">

			    {!! Form::model($user, [ 'route' => ['security.users.update', $user->id], 'class' => 'form-horizontal form-modal-left' , 'id' => 'form-user-update', 'method' => 'PATCH']) !!}

			        @include('Security::users.partials.modals.form-user')

			        @if( ! $user->isSuperUser() )
			        
			        	@include('Security::users.partials.modals.form-role')

			        @endif

			    {!! Form::close() !!}

			</div>
		</div>
	</div>
</div>



