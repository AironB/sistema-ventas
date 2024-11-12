<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\RecuperarClaveController;

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
    // return view('welcome');
    return redirect()->route("home");
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/* mis rutas */
Route::get("mi-perfil", [PerfilController::class, "index"])->name("usuario.perfil");
Route::post("actualizar-foto-perfil",[PerfilController::class, "ActualizarIMG"])->name("usuario.actualizarIMG");
Route::get("eliminar-foto-perfil", [PerfilController::class, "eliminarFotoPerfil"])->name("perfil.eliminarFoto");

//empresa
Route::get('empresa-index',[EmpresaController::class,'index'])->name('empresa.index')->middleware('verified');
Route::post('empresa-update-{id}',[EmpresaController::class,'update'])->name('empresa.update')->middleware('verified');
