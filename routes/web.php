<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/home');
});


Auth::routes();

Route::get('/test', 'TestController@index');


Route::group(['middleware' => ['auth', 'roles:admin,company,third,provider,operator,reception']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    // Chat
    Route::get('/chat', 'MessageController@index')->name('chat');
    Route::get('/messages', 'MessageController@fetch')->middleware('auth');
    Route::post('/messages', 'MessageController@sentMessage')->middleware('auth');
});

Route::group(['middleware' => ['auth', 'roles']], function () {

    //Users
    Route::get('/empresa/users', 'UserController@index');
    Route::get('/empresa/users/create', 'UserController@create');
    Route::post('/empresa/users', 'UserController@store');
    Route::get('/empresa/users/{id}/edit', 'UserController@edit');
    Route::put('/empresa/users/{id}', 'UserController@update');
    Route::delete('/empresa/users/{id}/destroy', 'UserController@destroy');

    //Clientes
    Route::get('/empresa/customers', 'CustomerController@index');
    Route::get('/empresa/customers/create', 'CustomerController@create');
    Route::post('/empresa/customers', 'CustomerController@store');
    Route::get('/empresa/customers/{id}/edit', 'CustomerController@edit');
    Route::put('/empresa/customers/{id}', 'CustomerController@update');
    Route::get('/empresa/customers/{id}/delete', 'CustomerController@delete');
    Route::delete('/empresa/customers/{id}/destroy', 'CustomerController@destroy');
    Route::get('/empresa/customers/load-states/{id}', 'CustomerController@loadStates');
    Route::get('/empresa/customers/load-cities/{id}', 'CustomerController@loadCities');

    //Catalogos
    Route::get('/empresa/customers/{customer_id}/catalogs', 'CatalogController@index');
    Route::get('/empresa/customers/{customer_id}/catalogs/create', 'CatalogController@create');
    Route::post('/empresa/customers/{cutomer_id}/catalogs', 'CatalogController@store');
    Route::get('/empresa/customers/{customer_id}/catalogs/{id}/edit', 'CatalogController@edit');
    Route::put('/empresa/customers/{customer_id}/catalogs/{id}', 'CatalogController@update');
    Route::get('/empresa/customers/{customer_id}/catalogs/{id}/delete', 'CatalogController@delete');
    Route::delete('/empresa/customers/{customer_id}/catalogs/{id}/destroy', 'CatalogController@destroy');
    Route::get('/empresa/customers/{customer_id}/catalogs/import', 'ImportCatalogController@index');

    //Bodegas
    Route::get('/empresa/bodegas', 'BodegaController@index')->name('bodegas');
    Route::get('/empresa/bodegas/nueva', 'BodegaController@create')->name('nuevaBodega');
    Route::post('/empresa/bodegas/guardar', 'BodegaController@store')->name('storageBodega');
    Route::get('/empresa/bodegas/detalle/{id}', 'BodegaController@show')->name('detalleBodega');
    Route::get('/empresa/bodegas/detalle/modelado/{id}', 'BodegaController@model')->name('modeladoBodega');
    Route::post('/empresa/bodegas/actualizar/{id}', 'BodegaController@update')->name('updateBodega');
    Route::get('/empresa/bodegas/eliminar/{id}', 'BodegaController@destroy')->name('destroyBodega');

    //Modelado
    Route::get('/empresa/bodegas/{bodega_id}/sections', 'SectionController@index');
    Route::post('/empresa/bodegas/{bodega_id}/sections/store', 'SectionController@store');
    Route::put('/empresa/bodegas/{bodega_id}/sections/{id}/drag', 'SectionController@drag');

    Route::get('/empresa/bodegas/{bodega_id}/racks/{id}/edit', 'RackController@edit');
    Route::put('/empresa/bodegas/{bodega_id}/racks/{id}/update', 'RackController@update');

    Route::get('/empresa/bodegas/{bodega_id}/racks/{rack_id}/ubications/{id}/show', 'RackUbicationController@show');
    Route::put('/empresa/bodegas/{bodega_id}/racks/{rack_id}/ubications/{id}/available', 'RackUbicationController@available');


    //Unidades
    Route::get('/empresa/units', 'UnitController@index');
    Route::get('/empresa/units/create', 'UnitController@create');
    Route::post('/empresa/units', 'UnitController@store');
    Route::get('/empresa/units/{id}/edit', 'UnitController@edit');
    Route::put('/empresa/units/{id}', 'UnitController@update');
    Route::get('/empresa/units/{id}/delete', 'UnitController@delete');
    Route::delete('/empresa/units/{id}/destroy', 'UnitController@destroy');

    //Tipos de referencias
    Route::get('/empresa/reference-types', 'ReferenceTypeController@index');
    Route::get('/empresa/reference-types/create', 'ReferenceTypeController@create');
    Route::post('/empresa/reference-types', 'ReferenceTypeController@store');
    Route::get('/empresa/reference-types/{id}/edit', 'ReferenceTypeController@edit');
    Route::put('/empresa/reference-types/{id}', 'ReferenceTypeController@update');
    Route::get('/empresa/reference-types/{id}/delete', 'ReferenceTypeController@delete');
    Route::delete('/empresa/reference-types/{id}/destroy', 'ReferenceTypeController@destroy');

    //Tallas
    Route::get('/empresa/sizes', 'SizeController@index');
    Route::get('/empresa/sizes/create', 'SizeController@create');
    Route::post('/empresa/sizes', 'SizeController@store');
    Route::get('/empresa/sizes/{id}/edit', 'SizeController@edit');
    Route::put('/empresa/sizes/{id}', 'SizeController@update');
    Route::get('/empresa/sizes/{id}/delete', 'SizeController@delete');
    Route::delete('/empresa/sizes/{id}/destroy', 'SizeController@destroy');


    //Presentación
    Route::get('/empresa/presentations', 'PresentationController@index');
    Route::get('/empresa/presentations/create', 'PresentationController@create');
    Route::post('/empresa/presentations', 'PresentationController@store');
    Route::get('/empresa/presentations/{id}/edit', 'PresentationController@edit');
    Route::put('/empresa/presentations/{id}', 'PresentationController@update');
    Route::get('/empresa/presentations/{id}/delete', 'PresentationController@delete');
    Route::delete('/empresa/presentations/{id}/destroy', 'PresentationController@destroy');


    //Admin Roles 
    Route::get('/empresa/roles', 'RoleController@index');
    Route::get('/empresa/roles/create', 'RoleController@create');
    Route::post('/empresa/roles', 'RoleController@store');
    Route::get('/empresa/roles/{id}/edit', 'RoleController@edit');
    Route::put('/empresa/roles/{id}', 'RoleController@update');
    Route::get('/empresa/roles/{id}/delete', 'RoleController@delete');
    Route::delete('/empresa/roles/{id}/destroy', 'RoleController@destroy');


    Route::post('/get-deparments', 'HomeController@getDepartments')->name('getDepartments');
    Route::post('/getCities', 'HomeController@getCities')->name('getCities');
    Route::post('/settings/save', 'HomeController@saveSetting')->name('saveSetting');
});


Route::group(['middleware' => ['auth']], function () {

    Route::get('/admin/companies', 'HomeController@users')->name('adminCompanies');
    Route::get('/usuarios', 'HomeController@users')->name('users');
});
