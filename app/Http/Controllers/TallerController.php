<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use Collective\Html\FormBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

 public function form(){
    return view('formulari');
 }
 public function duplicar(Request $request){
   $taller = Taller::find($request->input('id'));
   $tallerCopia = $taller->replicate();
   $tallerCopia->save();
   $data = Taller::all();
   return view('dashboard', ['data' => $data]);

}
 public function submit(Request $request){
  
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
   $taller->material = $material;
   $taller->nAlumnes = $nAlumnes;
   $taller->save();
   $data = Taller::all();
   return view('dashboard', ['data' => $data]);
 }

 
}
