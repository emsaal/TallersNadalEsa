<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TallerController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/login-google', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-callback', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name("dashboard.logout");
Route::post('/dashboard/duplicar', [TallerController::class, 'duplicar'])->name("dashboard.duplicar");
Route::get('/formulari', [TallerController::class, 'form'])->name("form");
Route::post('/formulari/submit', [TallerController::class, 'submit'])->name("formulari.submit");
Route::get('/alumnes', [UserController::class, 'taulaAlumnes'])->name("alumnes.mostrar");
Route::get('/professors/mostrar', [UserController::class, 'taulaProfessors'])->name("professors.mostrar");
Route::post('/professors', [UserController::class, 'actualitzarProf'])->name("professors.actualitzar");
Route::get('/alumnes/actualitzar', [UserController::class, 'actualitzarAlumnes'])->name("alumnes.actualitzar");
Route::get('/alumnes/nou', [UserController::class, 'crearNouAlumne'])->name("alumnes.nou");
Route::post('/alumnes/inserirUsuari', [UserController::class, 'inserirNouUsuari'])->name("formulariNouAlumne.submit");
Route::post('/alumnes/guardarTallers', [UserController::class, 'asignarUsuariTaller'])->name("usuariAfegirTallers.submit");
Route::post('/alumnes/guardarTallers', [UserController::class, 'asignarUsuariTaller'])->name("usuariEdiarTallers.submit");
Route::post('/alumnes/guardarTallers', [UserController::class, 'asignarUsuariTaller'])->name("usuariAfegirTallersAdmin.submit");

Route::get('/alumnes/tallersUsuari', [UserController::class, 'retornarPerfil'])->name("usuari.tallers");
Route::post('/alumnes/tallersUsuari', [UserController::class, 'retornarPerfilAdmin'])->name("usuariEditarTallers.submit");

Route::get('/dashboard', [TallerController::class, 'index'])->name("dashboard.index");


Auth::routes();

