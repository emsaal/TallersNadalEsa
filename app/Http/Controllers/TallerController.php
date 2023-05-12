<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Taller;

use Collective\Html\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TallerController extends Controller
{


public function __construct()
{
   $this->middleware('auth');
}

public function index()
{
    $data = Taller::all();
    return view('dashboard', ['data' => $data]);
}
public function users()
{
    return $this->belongsToMany(User::class, 'tallers_i_usuaris', 'taller_id', 'user_id');
}
public function form()
{
   $email = Auth::user()->email;

   if (Taller::where('responsable', $email)->exists()) {
       if (Auth::user()->professor != 1 && Auth::user()->admin != 1 && Auth::user()->superadmin != 1) {
           $errors = ['error' => 'Ja has creat un taller'];
           return redirect()->route('dashboard.index')->withErrors($errors)->withInput();
       } else {
         return view('formulari');
       }
   } else {
      return view('formulari');
   }
}

 public function duplicar(Request $request){
   $taller = Taller::find($request->input('id'));
   $tallerCopia = $taller->replicate();
   $tallerCopia->save();
   $data = Taller::all();
   return view('dashboard', ['data' => $data]);

}
 public function submit(Request $request){
  
   $request->validate([
      'name' => 'required',
      'descripcio' => 'required',
      'material' => 'required',
      'observacions' => 'required',
      'adrecat' => 'required',
      'nAlumnes' => 'required',
  ]);

  $nameTaller = $request->input('name');
  $proposat = Auth::user()->email;
  $descripcio = $request->input('descripcio');
  $material = $request->input('material');
  $observacions = $request->input('observacions');
  $adrecatA = implode(',', $request->input('adrecat'));
  $nAlumnes = $request->input('nAlumnes');

  $taller = new Taller();
  $taller->taller = $nameTaller;
  $taller->responsable = $proposat;
  $taller->descripcio = $descripcio;
  $taller->adrecatA = $adrecatA;
  $taller->observacions = $observacions;
  $taller->material = $material;
  $taller->nAlumnes = $nAlumnes;
 



  if ( $taller->save()) {
   $data = Taller::all();
  return view('dashboard', ['data' => $data, 'success' => "Taller creat correctament"]);
} else {
   $data = Taller::all();
  return view('dashboard', ['data' => $data, 'error' => "No s'ha pogut crear el taller"]);
}
 }

 public function asignarAjudant(Request $request){

   $taller = Taller::find($request->input('id'));
   $usuaris = User::all(); 

   return view('afegirAjudant', ['taller' => $taller, 'usuaris' => $usuaris]);
 }

public function guardarAjudants(Request $request){
   try {
   
   $tallerID = $request->input('tallerID');
    $ajudantsTemp = $request->input('ajudants');
    
    $ajudants = array_unique($ajudantsTemp);
    $ajudantsPerGuardar = implode(',', $ajudants);
    
    $taller = Taller::find($tallerID);
    $taller->ajudant = $ajudantsPerGuardar;
    $taller->save();
    
    return redirect()->route('dashboard.index')->with('success', "S'ha guardat correctament");
  } catch (\Exception $e) {
      return redirect()->route('dashboard.index')->with('error', "No s'ha guardat correctament")->withErrors([$e->getMessage()]);
  }

}
public function detallsTaller(Request $request){
  $tallerID = $request->input('id');
  $taller = Taller::with('users')->find($tallerID);
  $usuarisApuntats = $taller->users->count();

  return view('detallsTaller', compact('taller', 'usuarisApuntats'));
}

public function alumnesTaller(Request $request){
  $tallerID = $request->input('tallerID');
  $taller = Taller::find($tallerID);
  $usuaris = $taller->users()->get();

  return view('alumnesTaller', ['usuaris' => $usuaris, 'taller' => $taller]);

}
}

