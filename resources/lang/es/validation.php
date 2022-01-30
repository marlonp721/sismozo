<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */
    
    'web_dni_inspector_validation'      =>'El campo :attribute ya existe.',
    'validate_imsi_msisdn'                   =>'El   :attribute :values  ya existe para esta apn.',
    'validate_regex_lines'             =>'El   :attribute :values tiene un formato no valido.',
    'validate_regex_lines_mb'             =>'El   :attribute :values tiene un formato no valido.:values',
    'digits_lines'                     =>'El   :attribute :values debe tener :caracteres digitos.',
    'digits_lines_mb'                     =>'El   :attribute :values debe tener :caracteres digitos.:values',
    'digits_lines_fild'                     =>':attribute :values debe tener minimo :min y :max digitos.',
    'validate_name_unique'               => 'El campo :attribute ya ha sido registrado.',
    'web_dni_responsible_validation'    =>'El campo :attribute ya existe.',
    'api_dni_validation'    =>'El campo :attribute ya existe.',
    'accepted'             => 'El campo :attribute debe ser aceptado.',
    'active_url'           => 'El campo :attribute no es una URL válida.',
    'after'                => 'El campo :attribute debe ser una fecha posterior a :date.',
    'alpha'                => 'El campo :attribute solo debe contener letras.',
    'alpha_dash'           => 'El campo :attribute solo debe contener letras, números y guiones.',
    'alpha_num'            => 'El campo :attribute solo debe contener letras y números.',
    'array'                => 'El campo :attribute debe ser un conjunto.',
    'before'               => 'El campo :attribute debe ser una fecha anterior a :date.',
    'between'              => [
        'numeric' => 'El campo :attribute tiene que estar entre :min - :max.',
        'file'    => 'El campo :attribute debe pesar entre :min - :max kilobytes.',
        'string'  => 'El campo :attribute tiene que tener entre :min - :max caracteres.',
        'array'   => 'El campo :attribute tiene que tener entre :min - :max ítems.',
    ],
    'boolean'              => 'El campo :attribute debe tener un valor verdadero o falso.',
    'confirmed'            => 'La confirmación de :attribute no coincide.',
    'date'                 => 'El campo :attribute no es una fecha válida.',
    'date_format'          => 'El campo :attribute no corresponde al formato :format.',
    'different'            => 'El campo :attribute y :other deben ser diferentes.',
    'digits'               => 'El campo :attribute debe tener :digits dígitos.',
    'digits_between'       => 'El campo :attribute debe tener entre :min y :max dígitos.',
    'dimensions'           => 'El campo :attribute tiene dimensiones inválidas.',
    'distinct'             => 'El campo :attribute contiene un valor duplicado.',
    'email'                => 'El campo :attribute no es un correo válido',
    'exists'               => 'El campo :attribute es inválido.',
    'file'                 => 'El campo :attribute debe ser un archivo.',
    'filled'               => 'El campo :attribute es obligatorio.',
    'image'                => 'El campo :attribute debe ser una imagen.',
    'in'                   => 'El campo :attribute es inválido.',
    'in_array'             => 'El campo :attribute no existe en :other.',
    'integer'              => 'El campo :attribute debe ser un número entero.',
    'ip'                   => 'El campo :attribute debe ser una dirección IP válida.',
    'json'                 => 'El campo :attribute debe tener una cadena JSON válida.',
    'max'                  => [
        'numeric' => 'El campo :attribute no debe ser mayor a :max.',
        'file'    => 'El campo :attribute no debe ser mayor que :max kilobytes.',
        'string'  => 'El campo :attribute no debe ser mayor que :max caracteres.',
        'array'   => 'El campo :attribute no debe tener más de :max elementos.',
    ],
    'mimes'                => 'El campo :attribute debe ser un archivo con formato: :values.',
    'mimetypes'            => 'El campo :attribute debe ser un archivo de tipo: :values.',
    'min'                  => [
        'numeric' => 'El tamaño de :attribute debe ser de al menos :min.',
        'file'    => 'El tamaño de :attribute debe ser de al menos :min kilobytes.',
        'string'  => 'El campo :attribute debe contener al menos :min caracteres.',
        'array'   => 'El campo :attribute debe tener al menos :min elementos.',
    ],
    'not_in'               => 'El campo :attribute es inválido.',
    'numeric'              => 'El campo :attribute debe ser numérico.',
    'present'              => 'El campo :attribute debe estar presente.',
    'regex'                => 'El formato de :attribute es inválido.',
    'required'             => 'El campo :attribute es obligatorio.',
    'required_if'          => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_unless'      => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with'        => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_without'     => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values estén presentes.',
    'same'                 => 'El campo :attribute y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El tamaño de :attribute debe ser :size.',
        'file'    => 'El tamaño de :attribute debe ser :size kilobytes.',
        'string'  => 'El campo :attribute debe contener :size caracteres.',
        'array'   => 'El campo :attribute debe contener :size elementos.',
    ],
    'string'               => 'El campo :attribute debe ser una cadena de caracteres.',
    'timezone'             => 'El campo :attribute debe ser una zona válida.',
    'unique'               => 'El campo :attribute ya ha sido registrado.',
    'uploaded'             => 'El campo :attribute falló en subirse al servidor.',
    'url'                  => 'El formato :attribute es inválido.',

    'form_list'            => 'El campo :attribute no pertenece al formulario.',
    'form_event'           => 'El campo :attribute no pertenece al formulario.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'roles.*' => [
            'exists' => 'Cada campo de perfil debe ser válido.',
            'exclude_superuser'  => 'No puede asignarse el perfil de Super Usuario.',
        ],
        'permissions.*' => [
            'exists' => 'Cada campo de permiso debe ser válido.',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name'                  => 'nombre',
        'fullname'              => 'nombres y apellidos',
        'username'              => 'Nombre de usuario',
        'email'                 => 'correo electrónico',
        'first_name'            => 'nombre',
        'last_name'             => 'apellido',
        'password'              => 'contraseña',
        'password_confirmation' => 'confirmación de la contraseña',
        'city'                  => 'ciudad',
        'country'               => 'país',
        'address'               => 'dirección',
        'phone'                 => 'teléfono fijo',
        'cellphone'             => 'teléfono celular',
        'mobile'                => 'celular',
        'age'                   => 'edad',
        'sex'                   => 'sexo',
        'gender'                => 'género',
        'year'                  => 'año',
        'month'                 => 'mes',
        'day'                   => 'día',
        'hour'                  => 'hora',
        'minute'                => 'minuto',
        'second'                => 'segundo',
        'title'                 => 'título',
        'body'                  => 'contenido',
        'description'           => 'descripción',
        'excerpt'               => 'extracto',
        'date'                  => 'fecha',
        'time'                  => 'hora',
        'subject'               => 'asunto',
        'message'               => 'mensaje',
        'roles'                 => 'perfiles',
        'role'                  => 'perfil',
        'display_name'          => 'nombre',
        'font'                  => 'fuente de letra',
        'company_id'            => 'empresa',
        'area'                  => 'área',
        'inspection_type_id'    => 'tipo de inspección',
        'responsible'           => 'responsable',
        'responsible.*.dni'     => 'dni (Responsable)',

      /*Campos de Apn*/
        'name'               =>   'Nombre de Archivo',
        'business_name'      =>   'Razón Social',
        'ruc'      =>   'Ruc',
        'type_apn'      =>   'Tipo Apn',
        'transport_type' =>'Tipo Trasnporte',
        'equipment_type' =>'Tipo Equipo',
        'service_type' =>'Tipo Servicio',
        'destination' =>'Destinos permitidos',
        'lines_projection' =>'Proyección Líneas',
        'c_name' =>'Nombre',
        'c_email' =>'Email',
        'c_phone' =>'Fijo',
        'c_cellphone' =>'Celular',
        'c_name_2' =>'Nombre',
        'c_email_2' =>'Email',
        'c_phone_2' =>'Fijo',
      'c_cellphone_2' =>'Celular',
        'technology'=>'Tecnologia',
        'service_plan'=>'Plan',
        'line_technology'=>'Tecnologia',
        'line_service_plan'=>'Plan',
      /*Fin campos apn*/

//        'inspector.*.name'      => 'nombre (Inspector)',
//        'inspector.*.dni'       => 'dni (Inspector)',
//
//        'inspector.*.management_id' => 'gerencia (Inspector)',
//
//        'inspection_item.*.event_id'      => 'tipo (Suceso)',
//        'inspection_item.*.description'   => 'descripción (Suceso)',
//        'inspection_item.*.frequency_id'  => 'frecuencia (Suceso)',
//        'inspection_item.*.severity_id'   => 'severidad (Suceso)',
//        'inspection_item.*.risk_category' => 'categoría del riesgo (Suceso)',
//        'inspection_item.*.risk_level'    => 'nivel del riesgo (Suceso)',
//        'inspection_item.*.target_id'     => 'campo de afectación (Suceso)',
//        'inspection_item.*.deadline'      => 'fecha límite (Suceso)',
//        'inspection_item.*.event_item_id' => 'acción de tipo (Suceso)',
//        'inspection_item.*.rac_id'        => 'RAC (Suceso)',
//        'inspection_item.*.responsible'   => 'responsable (Suceso)',
//        'inspection_item.*.supervisor'    => 'supervisor (Suceso)',
//        'inspection_item.*.inspector_id'  => 'inspector (Suceso)',
//
//        'inspection_item_close.*.date_close'    => 'fecha de cierre (Levantamiento)',
//        'inspection_item_close.*.description'   => 'descripción (Levantamiento)',
//        'inspection_item_close.*.severity_id'   => 'severidad (Levantamiento)',
//        'inspection_item_close.*.frequency_id'  => 'frecuencia (Levantamiento)',
//        'inspection_item_close.*.risk_category' => 'categoría del riesgo (Levantamiento)',
//        'inspection_item_close.*.risk_level'    => 'nivel del riesgo (Levantamiento)',
//
//        'inspection_item_image.*.file_image'  => 'imagen (Foto)',
//        'inspection_item_image.*.description' => 'descripción (Foto)',

       // 'rop_image.*.file_image'  => 'imagen (Foto)',
       // 'rop_image.*.description' => 'descripción (Foto)',

       // 'risk_id'            => 'riesgo',
        //'event_id'           => 'tipo de evento',
        //'target_id'          => 'blanco',
        //'area_id'            => 'área responsable',
        //'area'               => 'área responsable',
        'event_place'        => 'lugar exacto del evento',
        //'company_id'         => 'empresa',
        'event_date'         => 'fecha y hora',
        'event_description'  => 'descripción',
        'worker_commitment'  => 'compromisos del trabajador',
//        'reporter_name'      => 'nombre del reportante',
//        'reporter_company'   => 'empresa del reportante',
//        'supervisor_name'    => 'nombre del supervisor',
//        'supervisor_company' => 'empresa del supervisor',
//        'research_required'  => '¿Requiere investigación y análisis de causas?',
        'date_close'         => 'fecha de cierre',

       // 'rop_id'             => 'ROP',
        'file_image'         => 'imagen (Foto)',
        'boss_fullname'      => 'nombre y apellido de Gerencia',
        'hss_ip' =>'IP',
        'hss_port' =>'Puerto',
        'hss_user' =>'Usuario',
        'hss_passwd' =>'Contraseña',
        'pcrf_ip' =>'IP',
        'pcrf_port' =>'Puerto',
        'pcrf_user' =>'Usuario',
        'pcrf_passwd' =>'Contraseña',
        'ldap_ip' =>'IP',
        'ldap_port' =>'Puerto',
        'ldap_protocol' =>'Protocolo',
        'ldap_dn' =>'DN',
        "smtp_ip" => 'Ip',
        "smtp_port" => 'Puerto',
        "smtp_auth" => 'Auth',
        "smtp_from" => 'From',
        "smtp_mail" => 'Mail',
        "smtp_username" => 'Usuario',
        "smtp_password" => 'Contraseña',


    ],

];
