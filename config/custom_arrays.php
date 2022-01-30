<?php

return [
	
	'days' => [
		1 => 'Lunes',
		2 => 'Martes',
		3 => 'Miércoles',
		4 => 'Jueves',
		5 => 'Viernes',
		6 => 'Sábado',
		0 => 'Domingo',
	],

	'months' => [
		1 => 'Enero',
		2 => 'Febrero',
		3 => 'Marzo',
		4 => 'Abril',
		5 => 'Mayo',
		6 => 'Junio',
		7 => 'Julio',
		8 => 'Agosto',
		9 => 'Setiembre',
		10 => 'Octubre',
		11 => 'Noviembre',
		12 => 'Diciembre',
	],

	'settings' => [
		'rops' => 
			[	
				'body' => ',afirmo haber entendido las posibles consecuencias del acto subestandar que he cometido y me comprometo a no incurrir en este tipo de faltas, porque soy consciente que éstas pueden provocar pérdidas en perjuicios de mi integridad, la de mis compañeros, el proceso productivo de la Empresa, o al medio ambiente.',
				'note' => 'Nota: El observado no está en la obligación de firmar el presente documento',
			]
	],
	'form'=>
		[""=>'Seleccione una opcion',
			'inspections'=>'Inspeccion',
			'rops'=>'Rop',
			'all'=>'Ambos'
		],
	'site'	=>[

		0	=>'San Borja',
	    1	=>'San Borja'

	],
	'status'	=>[

		0	=>'Inactivo',
		1	=>'Activo'

	],
	'level_building'	=>[

		1	=> 1,
		2	=> 2,
		3	=> 3,
		4	=> 4,
		5	=> 5,
		6	=> 6,

	],
  'smtp'=>[
    ["id"=>'',"name"=>'smtp_ip',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'smtp_port',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'smtp_auth',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'smtp_from',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'smtp_mail',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'smtp_username',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'smtp_password',"valor"=>["valor"=>'']],
  ],
  'ldap'=>[
    ["id"=>'',"name"=>'ldap_ip',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'ldap_port',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'ldap_protocol',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'ldap_dn',"valor"=>["valor"=>'']]
  ],
  'pcrf'=>[
    ["id"=>'',"name"=>'pcrf_ip',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'pcrf_port',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'pcrf_user',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'pcrf_passwd',"valor"=>["valor"=>'']]
  ],
  'hss'=>[
    ["id"=>'',"name"=>'hss_ip',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'hss_port',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'hss_user',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'hss_passwd',"valor"=>["valor"=>'']]
  ],
  'msc'=>[
    ["id"=>'',"name"=>'msc_ip',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'msc_port',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'msc_user',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'msc_passwd',"valor"=>["valor"=>'']]
  ],
  'sps'=>[
    ["id"=>'',"name"=>'sps_ip',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'sps_port',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'sps_user',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'sps_passwd',"valor"=>["valor"=>'']]
  ],
  'usn'=>[
    ["id"=>'',"name"=>'usn_ip',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'usn_port',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'usn_user',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'usn_passwd',"valor"=>["valor"=>'']]
  ],
  'dns'=>[
    ["id"=>'',"name"=>'dns_ip',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'dns_port',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'dns_user',"valor"=>["valor"=>'']],
    ["id"=>'',"name"=>'dns_passwd',"valor"=>["valor"=>'']]
  ],
  'mml'=>[
    'msc'=>[],
    'hss'=>[],
    'sps'=>[],
    'usn'=>[],
    'dns'=>[],
  ],


];


