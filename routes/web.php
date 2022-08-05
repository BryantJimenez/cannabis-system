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

/////////////////////////////////////// AUTH /////////////////////////////////////////////////
Auth::routes();
Route::get('/usuarios/email', 'AdminController@emailVerifyAdmin');

///////////////////////////////////////// WEB ////////////////////////////////////////////////
Route::get('/', function() {
	return redirect()->route('admin');
});

/////////////////////////////////////// ADMIN ////////////////////////////////////////////////
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
	// Home
	Route::get('/', 'AdminController@index')->name('admin');

	// Profile
	Route::prefix('perfil')->group(function () {
		Route::get('/', 'AdminController@profile')->name('profile');
		Route::get('/editar', 'AdminController@profileEdit')->name('profile.edit');
		Route::put('/', 'AdminController@profileUpdate')->name('profile.update');
	});

	// Users
	Route::prefix('usuarios')->group(function () {
		Route::get('/', 'UserController@index')->name('users.index')->middleware('permission:users.index');
		Route::get('/registrar', 'UserController@create')->name('users.create')->middleware('permission:users.create');
		Route::post('/', 'UserController@store')->name('users.store')->middleware('permission:users.create');
		Route::get('/{user:slug}', 'UserController@show')->name('users.show')->middleware('permission:users.show');
		Route::get('/{user:slug}/editar', 'UserController@edit')->name('users.edit')->middleware('permission:users.edit');
		Route::put('/{user:slug}', 'UserController@update')->name('users.update')->middleware('permission:users.edit');
		Route::delete('/{user:slug}', 'UserController@destroy')->name('users.delete')->middleware('permission:users.delete');
		Route::put('/{user:slug}/activar', 'UserController@activate')->name('users.activate')->middleware('permission:users.active');
		Route::put('/{user:slug}/desactivar', 'UserController@deactivate')->name('users.deactivate')->middleware('permission:users.deactive');
	});

	// Employees
	Route::prefix('trabajadores')->group(function () {
		Route::get('/', 'EmployeeController@index')->name('employees.index')->middleware('permission:employees.index');
		Route::get('/registrar', 'EmployeeController@create')->name('employees.create')->middleware('permission:employees.create');
		Route::post('/', 'EmployeeController@store')->name('employees.store')->middleware('permission:employees.create');
		Route::get('/{employee:slug}', 'EmployeeController@show')->name('employees.show')->middleware('permission:employees.show');
		Route::get('/{employee:slug}/editar', 'EmployeeController@edit')->name('employees.edit')->middleware('permission:employees.edit');
		Route::put('/{employee:slug}', 'EmployeeController@update')->name('employees.update')->middleware('permission:employees.edit');
		Route::delete('/{employee:slug}', 'EmployeeController@destroy')->name('employees.delete')->middleware('permission:employees.delete');
		Route::put('/{employee:slug}/activar', 'EmployeeController@activate')->name('employees.activate')->middleware('permission:employees.active');
		Route::put('/{employee:slug}/desactivar', 'EmployeeController@deactivate')->name('employees.deactivate')->middleware('permission:employees.deactive');
	});

	// Strains
	Route::prefix('cepas')->group(function () {
		Route::get('/', 'StrainController@index')->name('strains.index')->middleware('permission:strains.index');
		Route::get('/registrar', 'StrainController@create')->name('strains.create')->middleware('permission:strains.create');
		Route::post('/', 'StrainController@store')->name('strains.store')->middleware('permission:strains.create');
		Route::get('/{strain:slug}', 'StrainController@show')->name('strains.show')->middleware('permission:strains.show');
		Route::get('/{strain:slug}/editar', 'StrainController@edit')->name('strains.edit')->middleware('permission:strains.edit');
		Route::put('/{strain:slug}', 'StrainController@update')->name('strains.update')->middleware('permission:strains.edit');
		Route::delete('/{strain:slug}', 'StrainController@destroy')->name('strains.delete')->middleware('permission:strains.delete');
		Route::put('/{strain:slug}/activar', 'StrainController@activate')->name('strains.activate')->middleware('permission:strains.active');
		Route::put('/{strain:slug}/desactivar', 'StrainController@deactivate')->name('strains.deactivate')->middleware('permission:strains.deactive');
	});

	// Rooms
	Route::prefix('cuartos')->group(function () {
		Route::get('/', 'RoomController@index')->name('rooms.index')->middleware('permission:rooms.index');
		Route::get('/registrar', 'RoomController@create')->name('rooms.create')->middleware('permission:rooms.create');
		Route::post('/', 'RoomController@store')->name('rooms.store')->middleware('permission:rooms.create');
		Route::get('/{room:slug}', 'RoomController@show')->name('rooms.show')->middleware('permission:rooms.show');
		Route::get('/{room:slug}/editar', 'RoomController@edit')->name('rooms.edit')->middleware('permission:rooms.edit');
		Route::put('/{room:slug}', 'RoomController@update')->name('rooms.update')->middleware('permission:rooms.edit');
		Route::delete('/{room:slug}', 'RoomController@destroy')->name('rooms.delete')->middleware('permission:rooms.delete');
		Route::put('/{room:slug}/activar', 'RoomController@activate')->name('rooms.activate')->middleware('permission:rooms.active');
		Route::put('/{room:slug}/desactivar', 'RoomController@deactivate')->name('rooms.deactivate')->middleware('permission:rooms.deactive');
	});

	// Containers
	Route::prefix('recipientes')->group(function () {
		Route::get('/', 'ContainerController@index')->name('containers.index')->middleware('permission:containers.index');
		Route::get('/registrar', 'ContainerController@create')->name('containers.create')->middleware('permission:containers.create');
		Route::post('/', 'ContainerController@store')->name('containers.store')->middleware('permission:containers.create');
		Route::get('/{container:slug}', 'ContainerController@show')->name('containers.show')->middleware('permission:containers.show');
		Route::get('/{container:slug}/editar', 'ContainerController@edit')->name('containers.edit')->middleware('permission:containers.edit');
		Route::put('/{container:slug}', 'ContainerController@update')->name('containers.update')->middleware('permission:containers.edit');
		Route::delete('/{container:slug}', 'ContainerController@destroy')->name('containers.delete')->middleware('permission:containers.delete');
		Route::put('/{container:slug}/activar', 'ContainerController@activate')->name('containers.activate')->middleware('permission:containers.active');
		Route::put('/{container:slug}/desactivar', 'ContainerController@deactivate')->name('containers.deactivate')->middleware('permission:containers.deactive');
	});

	// Harvests
	Route::prefix('cosechas')->group(function () {
		Route::get('/', 'HarvestController@index')->name('harvests.index')->middleware('permission:harvests.index');
		Route::get('/registrar', 'HarvestController@create')->name('harvests.create')->middleware('permission:harvests.create');
		Route::post('/', 'HarvestController@store')->name('harvests.store')->middleware('permission:harvests.create');
		Route::get('/{harvest:slug}', 'HarvestController@show')->name('harvests.show')->middleware('permission:harvests.show');
		Route::get('/{harvest:slug}/editar', 'HarvestController@edit')->name('harvests.edit')->middleware('permission:harvests.edit');
		Route::put('/{harvest:slug}', 'HarvestController@update')->name('harvests.update')->middleware('permission:harvests.edit');
		Route::delete('/{harvest:slug}', 'HarvestController@destroy')->name('harvests.delete')->middleware('permission:harvests.delete');
		Route::put('/{harvest:slug}/activar', 'HarvestController@activate')->name('harvests.activate')->middleware('permission:harvests.active');
		Route::put('/{harvest:slug}/desactivar', 'HarvestController@deactivate')->name('harvests.deactivate')->middleware('permission:harvests.deactive');
	});
});