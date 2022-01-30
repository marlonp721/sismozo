<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@dashboard']);

Route::get('/profile', ['as' => 'profile', 'uses' => 'HomeController@profile']);

// --------------------------  RUTAS DE PEDIDOS ---------------

// LAYOUT PRINCIPAL
Route::get('/pedidos', ['as' => 'pedidos', 'uses' => 'HomeController@pedidos']);
// GRID DE LISTA DE PEDIDOS
Route::get('/loadpedidos', ['as' => 'pedidos.load', 'uses' => 'HomeController@pedidosload']);
// CRUD DE PEDIDOS
Route::get('create',            	['as' => 'pedidos.create',  'uses' => 'HomeController@create']  );
Route::post('store',            	['as' => 'pedidos.store',   'uses' => 'HomeController@store']   );
Route::get('edit/{pedidos}',       ['as' => 'pedidos.edit',    'uses' => 'HomeController@edit']    );
Route::patch('edit/{pedidos}',     ['as' => 'pedidos.update',  'uses' => 'HomeController@update']  );
Route::get('delete/{pedidos}',     ['as' => 'pedidos.delete',  'uses' => 'HomeController@delete']  );
Route::delete('destroy/{pedidos}', ['as' => 'pedidos.destroy', 'uses' => 'HomeController@destroy'] );

// --------------------------------------------------------------------------------------------------

Route::get('/default', [ 'as' => 'default',   'uses' => 'HomeController@defaultGrid' ]);




Auth::routes();
