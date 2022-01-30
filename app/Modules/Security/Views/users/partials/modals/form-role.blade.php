<div class="form-group">
    <label for="name" class="col-sm-4 control-label">Perfiles<span class="span-rojo">(*)</span></label>

    <div class="col-sm-8 form-role">

        <div class="table-container">
            
            <table class="table table-condensed table-role table-bordered">
                <tr>

                    @foreach($roles as $pos => $role)

                        <td>
                            <div class="checkbox3 checkbox-inline checkbox-check checkbox-light">
                                {{ Form::checkbox('roles[]', $role->id, in_array($role->id, $current_roles), ['id' => 'checkbox-fa-light-' . $role->id ]) }}
                                <label for="checkbox-fa-light-{{ $role->id}}">{{ $role->display_name }}</label>
                            </div>
                        </td>
                        
                        @if( ($pos + 1) % 2 == 0 )
                            </tr>
                            <tr>
                        @endif

                    @endforeach

                </tr>
            </table>

        </div>
    </div>
</div>