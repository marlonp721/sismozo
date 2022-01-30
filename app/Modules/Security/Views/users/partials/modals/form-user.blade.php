<div class="form-group">
  <label for="username" class="col-sm-2 control-label">Nombre de Usuario<span class="span-rojo">(*)</span></label>
  <div class="col-sm-5">
      {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Nombre de Usuario', 'maxlength' => 45 ,'autocomplete'=>'nope','id'=>'username']) }}
  </div>
</div>

<div class="form-group">
  <label for="fullname" class="col-sm-2 control-label">Nombre y Apell<span class="span-rojo">(*)</span></label>
  <div class="col-sm-10">
      {{ Form::text('fullname', null, ['class' => 'form-control', 'placeholder' => 'Nombre y Apellidos', 'maxlength' => 100 ,'autocomplete'=>'off']) }}
  </div>
</div>

  
<div class="form-group password-c">
<label for="password" class="col-sm-2 control-label">Password<span class="span-rojo">(*)</span></label>
<div class="col-sm-4">
  <input name="password" type="password" value="" id="passwordu" class="form-control passwordu" placeholder="Password" autocomplete="new-password">
</div>



  <label for="password_repeat" class="col-sm-2 control-label">Repetir Password<span class="span-rojo">(*)</span></label>
  <div class="col-sm-4">
    {{ Form::password('password_repeat', null, ['id'=>'passwordrepeat','class' => 'form-control passwordrepeat', 'placeholder' => 'Repetir Password', 'maxlength' => 80 ,'autocomplete'=>'off']) }}
  </div>
</div>


<div class="form-group">
  <label for="email" class="col-sm-2 control-label">Email<span class="span-rojo">(*)</span></label>
  <div class="col-sm-4">
    {{ Form::text('email', null, ['id'=>'emailu','class' => 'form-control', 'placeholder' => 'Correo', 'maxlength' => 80 ,'autocomplete'=>'off']) }}
  </div>
 

</div>

{{--@endif--}}
<div class="form-group">
  <label for="status" class="col-sm-2 control-label">Area</label>
    <div class="col-sm-4">
        {{ Form::select('area', $users_area, null, ['id'=>'area', 'class'=>'form-control select2', 'maxlength'=>'10', 'data-placeholder'=>'Seleccione Area']) }}
    </div>
  <label for="cellphone" class="col-sm-2 control-label">Celular</label>
  <div class="col-sm-4">
      {{ Form::text('cellphone',null, ['class' => 'form-control', 'placeholder' => 'Celular', 'maxlength' => 20 ,'autocomplete'=>'off','id'=>'cellphone']) }}
  </div>
</div>


@include('Security::users.partials.select-first-user')

<script>
$(function() {
  return $(".select2").select2({
    allowClear: true,
    placeholder: function(){
      $(this).data('placeholder');
    },
  });
});
$("input[name='password_repeat']").attr('id','password_repeatu');
$("input[name='password_repeat']").addClass('form-control');
$("input[name='password_repeat']").attr('placeholder','Repetir Password');
$("input[name='username']").change(function(){
  $(this).val($.trim($(this).val()));
})
$("input[name='email']").change(function(){
  $(this).val($.trim($(this).val()))
});
</script>