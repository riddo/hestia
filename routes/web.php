<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\RegistroController;
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
    return view('ingresar-asistencia');
});

//Admin dashboard
Route::get('admin', function () {
    return view('admin.dashboard');
});

//Admin

Route::get('admin/login', [AdminController::class, 'login']);
Route::post('admin/login', [AdminController::class, 'checkLogin']);
Route::get('admin/logout', [AdminController::class, 'logout']);

//Cargos
//Create, Read, Update
Route::resource('admin/cargos', CargoController::class);
//Delete
Route::delete('admin/cargos/{id}/delete', [CargoController::class, 'destroy']);


//Horarios

Route::resource('admin/horarios', HorarioController::class);
//Delete
Route::delete('admin/horarios/{id}/delete', [HorarioController::class, 'destroy']);

//Empleados
//Create, Read, Update
Route::resource('admin/empleados', EmpleadoController::class);
Route::post('admin/empleados/updateQr/{codigo}', [EmpleadoController::class, 'updateQr']);
//Delete
Route::delete('admin/empleados/{id}/delete', [EmpleadoController::class, 'destroy']);


/****TURNOS****/

Route::get('admin/empleados/{idEmpleado}/turnos', [TurnoController::class, 'index']);
Route::post('admin/empleados/{idEmpleado}/turnos', [TurnoController::class, 'store']);
Route::delete('admin/empleados/{idEmpleado}/turnos/{idTurno}', [TurnoController::class, 'destroy']);

// /*Create, update, select */
// Route::resource('admin/empleados/turnos/{id}', TurnoController::class);
// //Delete
// Route::delete('admin/empleados/turnos/{id}/{idTurno}', [TurnoController::class, 'destroy']);



/****ASISTENCIA*****/


Route::post("asistencia", [AsistenciaController::class, 'chequearAsistencia']);
Route::get("admin/asistencias", [AsistenciaController::class, 'index']);
Route::post("admin/asistencias", [AsistenciaController::class, 'store'] );
Route::post("admin/verifAsist", [AsistenciaController::class, 'getEmpleadoFromAdmin']);
Route::post("admin/asistencia/save", [AsistenciaController::class, 'storeFromAdmin']);
Route::get("admin/asistencia/{id}", [AsistenciaController::class, 'edit']);
Route::put("admin/asistencia/{id}/update", [AsistenciaController::class, 'update']);
Route::get("admin/registros", [RegistroController::class, 'index']);
/****DOCUMENTOS****/
