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
Route::get('/plantas/codigo/{container?}', 'AdminController@codeVerifyPlant');
Route::get('/compartimentos/curados', 'AdminController@containerCured')->middleware('permission:stages.cured.create');
Route::post('/compartimentos/curados', 'AdminController@containersCured')->middleware('permission:stages.trimmed.create');

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
	Route::prefix('compartimentos')->group(function () {
		Route::get('/', 'ContainerController@index')->name('containers.index')->middleware('permission:containers.index');
		Route::get('/registrar', 'ContainerController@create')->name('containers.create')->middleware('permission:containers.create');
		Route::post('/', 'ContainerController@store')->name('containers.store')->middleware('permission:containers.create');
		Route::get('/{container:slug}', 'ContainerController@show')->name('containers.show')->middleware('permission:containers.show');
		Route::get('/{container:slug}/editar', 'ContainerController@edit')->name('containers.edit')->middleware('permission:containers.edit');
		Route::put('/{contain:slug}', 'ContainerController@update')->name('containers.update')->middleware('permission:containers.edit');
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

	// Stages
	Route::prefix('etapas')->group(function () {
		Route::prefix('curado')->group(function () {
			// Cured
			Route::get('/', 'StageController@curedIndex')->name('stages.cured.index')->middleware('permission:stages.cured.index');
			Route::get('/registrar', 'StageController@curedCreate')->name('stages.cured.create')->middleware('permission:stages.cured.create');
			Route::post('/', 'StageController@curedStore')->name('stages.cured.store')->middleware('permission:stages.cured.create');
			Route::get('/{stage:id}', 'StageController@curedShow')->name('stages.cured.show')->middleware('permission:stages.cured.show');
			Route::delete('/{stage:id}', 'StageController@curedDestroy')->name('stages.cured.delete')->middleware('permission:stages.cured.delete');
		});
		Route::prefix('trimmiado')->group(function () {
			// Trimmed
			Route::get('/', 'StageController@trimmedIndex')->name('stages.trimmed.index')->middleware('permission:stages.trimmed.index');
			Route::get('/registrar', 'StageController@trimmedCreate')->name('stages.trimmed.create')->middleware('permission:stages.trimmed.create');
			Route::post('/', 'StageController@trimmedStore')->name('stages.trimmed.store')->middleware('permission:stages.trimmed.create');
			Route::get('/{stage:id}', 'StageController@trimmedShow')->name('stages.trimmed.show')->middleware('permission:stages.trimmed.show');
			Route::delete('/{stage:id}', 'StageController@trimmedDestroy')->name('stages.trimmed.delete')->middleware('permission:stages.trimmed.delete');
			Route::put('/{stage:id}/vaciar', 'StageController@empty')->name('stages.trimmed.empty')->middleware('permission:stages.trimmed.empty');
		});
	});

	// Records
	Route::prefix('registros')->group(function () {
		Route::prefix('curado')->group(function () {
			// Cured
			Route::get('/', 'RecordController@curedIndex')->name('records.cured.index')->middleware('permission:records.cured.index');
			Route::get('/{stage:id}', 'RecordController@curedShow')->name('records.cured.show')->middleware('permission:records.cured.show');
		});
		Route::prefix('trimmiado')->group(function () {
			// Trimmed
			Route::get('/', 'RecordController@trimmedIndex')->name('records.trimmed.index')->middleware('permission:records.trimmed.index');
			Route::get('/{stage:id}', 'RecordController@trimmedShow')->name('records.trimmed.show')->middleware('permission:records.trimmed.show');
		});
	});

	// Statistics
	Route::prefix('estadisticas')->group(function () {
		Route::get('/', 'StatisticController@index')->name('statistics.index')->middleware('permission:statistics.index');
		Route::get('/cosechas/{slug}/pdf', 'StatisticController@pdfHarvest')->name('statistics.harvests.pdf')->middleware('permission:statistics.index');
		Route::get('/cosechas/{harvest}/cepas/{strain}/empleados/flor', 'StatisticController@excelEmployeesFlower')->name('statistics.harvests.employees.flower.excel')->middleware('permission:statistics.index');
		Route::get('/cosechas/{harvest}/cepas/{strain}/empleados/larf', 'StatisticController@excelEmployeesLarf')->name('statistics.harvests.employees.larf.excel')->middleware('permission:statistics.index');
	});

	// Logs
	Route::prefix('bitacora')->group(function () {
		Route::get('/', 'LogController@index')->name('logs.index')->middleware('permission:logs.index');
		Route::delete('/{log:id}', 'LogController@destroy')->name('logs.delete')->middleware('permission:logs.delete');
	});

	// Settings
	Route::prefix('ajustes')->group(function () {
		Route::get('/', 'SettingController@edit')->name('settings.edit')->middleware('permission:settings.edit');
		Route::put('/', 'SettingController@update')->name('settings.update')->middleware('permission:settings.edit');
	});
});