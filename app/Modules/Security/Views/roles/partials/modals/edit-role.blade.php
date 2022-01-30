<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
            <div class="card-body">
                {!! Form::model($role, ['route'=> ['security.roles.update', $role->id], 'class'=>'form-horizontal form-modal-left', 'id'=>'form-role-update', 'method'=>'PATCH']) !!}
                    @include('Security::roles.partials.modals.form-role')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/modules/security/roles/tree.js') }}"></script>

<script>
    $(document).ready(function() {

        var data = {!! $permissions_role !!}

        showTree(data)

    });
</script>