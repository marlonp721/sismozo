<?php
Route::group(['middleware' => ['web', 'auth'], 'module' => 'Security', 'namespace' => 'App\Modules\Security\Controllers'], function () {

  // Users routes

  Route::group(['prefix' => 'security/users'], function () {

    Route::get('/',                 ['as' => 'security.users',         'uses' => 'UserController@index']   + set_middleware('security_users'));
    Route::get('load',              ['as' => 'security.users.load',    'uses' => 'UserController@load']    + set_middleware('security_users_show'));
    Route::get('create',            ['as' => 'security.users.create',  'uses' => 'UserController@create']  + set_middleware('security_users_store'));
    Route::post('store',            ['as' => 'security.users.store',   'uses' => 'UserController@store']   + set_middleware('security_users_store'));
    Route::get('edit/{user}',       ['as' => 'security.users.edit',    'uses' => 'UserController@edit']    + set_middleware('security_users_update'));
    Route::patch('edit/{user}',     ['as' => 'security.users.update',  'uses' => 'UserController@update']  + set_middleware('security_users_update'));
    Route::get('show/{user}',       ['as' => 'security.users.show',    'uses' => 'UserController@show']    + set_middleware('security_users_show'));
    Route::get('delete/{user}',     ['as' => 'security.users.delete',  'uses' => 'UserController@delete']  + set_middleware('security_users_destroy'));
    Route::delete('destroy/{user}', ['as' => 'security.users.destroy', 'uses' => 'UserController@destroy'] + set_middleware('security_users_destroy'));
  });

  // Roles routes

  Route::group(['prefix' => 'security/roles'], function () {

    Route::get('/',                 ['as' => 'security.roles',         'uses' => 'RoleController@index']   + set_middleware('security_roles'));
    Route::get('load',              ['as' => 'security.roles.load',    'uses' => 'RoleController@load']    + set_middleware('security_roles_show'));
    Route::get('tree',              ['as' => 'security.roles.tree',    'uses' => 'RoleController@tree']    + set_middleware('security_roles_store'));
    Route::get('create',            ['as' => 'security.roles.create',  'uses' => 'RoleController@create']  + set_middleware('security_roles_store'));
    Route::post('store',            ['as' => 'security.roles.store',   'uses' => 'RoleController@store']   + set_middleware('security_roles_store'));
    Route::get('edit/{role}',       ['as' => 'security.roles.edit',    'uses' => 'RoleController@edit']    + set_middleware('security_roles_update'));
    Route::patch('edit/{role}',     ['as' => 'security.roles.update',  'uses' => 'RoleController@update']  + set_middleware('security_roles_update'));
    Route::get('show/{role}',       ['as' => 'security.roles.show',    'uses' => 'RoleController@show']    + set_middleware('security_roles_show'));
    Route::get('destroy/{role}',    ['as' => 'security.roles.delete',  'uses' => 'RoleController@delete']  + set_middleware('security_roles_destroy'));
    Route::delete('destroy/{role}', ['as' => 'security.roles.destroy', 'uses' => 'RoleController@destroy'] + set_middleware('security_roles_destroy'));
  });


  //equipos
  Route::group(['prefix' => 'security/equipments'], function () {

    Route::get('/',                      ['as' => 'security.equipments',            'uses' => 'EquipmentController@index'] + set_middleware('security_equipos'));
    Route::get('load',                ['as' => 'security.equipments.show',            'uses' => 'EquipmentController@load'] + set_middleware('security_equipments_show'));
    Route::get('create',                ['as' => 'security.equipments.create',            'uses' => 'EquipmentController@create'] + set_middleware('security_equipments_store'));
    Route::post('store',                      ['as' => 'security.equipments.store',            'uses' => 'EquipmentController@store'] + set_middleware('security_equipments_store'));
    Route::get('destroy/{equipment}',    ['as' => 'security.equipments.delete',  'uses' => 'EquipmentController@delete']  + set_middleware('security_equipments_destroy'));
    Route::delete('destroy/{equipment}', ['as' => 'security.equipments.destroy', 'uses' => 'EquipmentController@destroy'] + set_middleware('security_equipments_destroy'));
    Route::get('edit/{equipment}',       ['as' => 'security.equipments.edit',    'uses' => 'EquipmentController@edit']    + set_middleware('security_equipements_update'));
    Route::patch('edit/{equipment}',     ['as' => 'security.equipments.update',  'uses' => 'EquipmentController@update']  + set_middleware('security_equipements_update'));



    Route::post('json-provincia',                      ['as' => 'security.configuration.json-provincia',            'uses' => 'EquipmentController@getprovinces'] + set_middleware('security_configuration'));
    Route::post('json-distrito',                      ['as' => 'security.configuration.json-distrito',            'uses' => 'EquipmentController@getdistricts'] + set_middleware('security_configuration'));
    Route::post('json-localidad',                      ['as' => 'security.configuration.json-localidad',            'uses' => 'EquipmentController@getlocalities'] + set_middleware('security_configuration'));

  });

  //wifi
  
  Route::group(['prefix' => 'security/wifis'], function () {

    Route::get('/',                      ['as' => 'security.wifis',            'uses' => 'WifiController@index'] + set_middleware('security_wifis'));
    Route::get('load',                ['as' => 'security.wifis.show',            'uses' => 'WifiController@load'] + set_middleware('security_wifis_show'));
    Route::get('create',                ['as' => 'security.wifis.create',            'uses' => 'WifiController@create'] + set_middleware('security_wifis_store'));
    Route::post('store',                      ['as' => 'security.wifis.store',            'uses' => 'WifiController@store'] + set_middleware('security_wifis_store'));
    Route::get('destroy/{wifi}',    ['as' => 'security.wifis.delete',  'uses' => 'WifiController@delete']  + set_middleware('security_wifis_destroy'));
    Route::delete('destroy/{wifi}', ['as' => 'security.wifis.destroy', 'uses' => 'WifiController@destroy'] + set_middleware('security_wifis_destroy'));
    Route::get('edit/{wifi}',       ['as' => 'security.wifis.edit',    'uses' => 'WifiController@edit']    + set_middleware('security_wifis_update'));
    Route::patch('edit/{wifi}',     ['as' => 'security.wifis.update',  'uses' => 'WifiController@update']  + set_middleware('security_wifis_update'));

  

    Route::post('json-provincia',                      ['as' => 'security.configuration.json-provincia',            'uses' => 'WifiController@getprovinces'] + set_middleware('security_configuration'));
    Route::post('json-distrito',                      ['as' => 'security.configuration.json-distrito',            'uses' => 'WifiController@getdistricts'] + set_middleware('security_configuration'));
    Route::post('json-localidad',                      ['as' => 'security.configuration.json-localidad',            'uses' => 'WifiController@getlocalities'] + set_middleware('security_configuration'));

  });

  //exporting

  Route::group(['prefix' => 'exporting'], function () {

    Route::get('/roles', ['uses' => 'ExportingController@roles'] + set_middleware('security_roles_export'))->name('exporting.roles');
    Route::get('/users', ['uses' => 'ExportingController@users'] + set_middleware('security_users_export'))->name('exporting.users');
   
    Route::get('/roles_csv', ['uses' => 'ExportingController@roles_csv'] + set_middleware('security_roles_export'))->name('exporting.roles_csv');
    Route::get('/users_csv', ['uses' => 'ExportingController@users_csv'] + set_middleware('security_users_export'))->name('exporting.users_csv');
    
    Route::get('/equipments', ['uses' => 'ExportingController@equipments'] + set_middleware('security_equipments_export'))->name('exporting.equipments');
    Route::get('/equipments_csv', ['uses' => 'ExportingController@equipments_csv'] + set_middleware('security_equipments_export'))->name('exporting.equipments_csv');

    Route::get('/wifis', ['uses' => 'ExportingController@wifis'] + set_middleware('security_wifis_export'))->name('exporting.wifis');
    Route::get('/wifis_csv', ['uses' => 'ExportingController@wifis_csv'] + set_middleware('security_wifis_export'))->name('exporting.wifis_csv');
  });
});
