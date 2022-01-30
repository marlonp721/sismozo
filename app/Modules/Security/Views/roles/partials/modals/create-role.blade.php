<div class="row">
    <div class="col-xs-12">
        <div class="card card-no-bottom-line">
            <div class="card-body">
                {!! Form::open(['route'=>'security.roles.store','class'=>'form-horizontal form-modal-left','id'=>'form-role-create']) !!}
                    @include('Security::roles.partials.modals.form-role')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/modules/security/roles/tree.js') }}"></script>

<script>
    var url_view_menu = "{{ route('security.roles.tree') }}";

    $.get(url_view_menu).done(function (data) {

        showTree(data)
    });
</script>