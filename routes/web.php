<?php
/**
 * Arxiu de les rutes
 * @author Emma S. Albano
 */
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

Route::middleware(['auth'])->group(function () {
    // your protected routes here
    
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
Route::post('/alumnes/guardarTallersEdit', [UserController::class, 'asignarUsuariTaller'])->name("usuariEdiarTallers.submit");
Route::post('/alumnes/guardarTallersAdmin', [UserController::class, 'asignarUsuariTaller'])->name("usuariAfegirTallersAdmin.submit");


Route::get('/alumnes/sensetaller', [UserController::class, 'alumSenseTaller'])->name("alumnes.sensetaller");
Route::post('/alumnes/tallersUsuari', [UserController::class, 'retornarPerfilAdmin'])->name("usuariEditarUsuari.submit");
Route::get('/alumnes/tallersUsuari', [UserController::class, 'retornarPerfilAdmin'])->name("usuariEditarUsuari.submit");
Route::post('/alumnes/tallersUsuariPerfil', [UserController::class, 'retornarPerfil'])->name("usuari.tallers");
Route::get('/alumnes/tallersUsuariPerfil', [UserController::class, 'retornarPerfil'])->name("usuari.tallers");
Route::post('/dashboard/asignarAjudant', [TallerController::class, 'asignarAjudant'])->name("asignarAjudant"); // per mostrar el taller i els ajudants que hi podem afegir
Route::post('/dashboard/guardarAjudant', [TallerController::class, 'guardarAjudants'])->name("usuariAfegirAjudants.submit"); // per guardar el taller amb els ajudants asignats
Route::get('/dashboard', [TallerController::class, 'retornarTaller'])->name("mostrarAlumnesTaller.submit'");

Route::post('/dashboard/tallersDetall', [TallerController::class, 'detallsTaller'])->name("detalls.taller"); 

Route::post('/dashboard/tallersDetall/alumnes', [TallerController::class, 'alumnesTaller'])->name("alumnesTaller"); 

Route::get('/dashboard', [TallerController::class, 'index'])->name("dashboard.index");

});
