<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\VarDumper\VarDumper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class UserController extends Controller
{
  public function __construct()
  {
        $this->middleware('auth');
  }


  public function index(){
    return view("dashboard");
  }
  public function iniciInici(){
    return view("dashboard");
  }

  public function taulaAlumnes(){

    $data = User::all();
    return view('alumnes', ['data' => $data]);
   
  }

  public function taulaProfessors(){

    $data = User::all();
    return view('professors', ['data' => $data]);
   
  }



  public function actualitzarProf(Request $request){
    $user = User::find($request->input('id'));
    if($request->input('admin') == "on"){
      $admin = 1;
    } else 
    { 
      $admin = 0;
    };
    
    $user->admin = $admin;
    $user->save();
    
    $data = User::all();
    
    session()->flash("alert", "S'han actualitzat els professors");
    return view('professors', ['data' => $data]);
  }

  public function actualitzarAlumnes(){
    $path = storage_path('/data/usuaris.txt');
    $data = File::get($path);

    
    $linies = explode("\n", $data);
  
    foreach($linies as $linea) {

      
        $camps =  Str::of($linea)->explode("\t");
  
     
        $usuari = User::where('email', $camps[0])->first();
     
        $cognoms = implode(' ', [$camps[2] , $camps[3]]);
     
        $curs =    substr($camps[1],-2, 1);
        $grup = substr($camps[1],-1);
        $etapa = substr($camps[1], 3, -2);
        $prof = 1;
        if(substr($camps[0],1,2) != ".") {
          $prof = 0;
        }
  
        if($usuari) {
          
          $usuari->name = $camps[4];
          $usuari->cognoms = $cognoms;
          $usuari->curs = $curs;
          $usuari->etapa = $etapa;
          $usuari->grup = $grup;
          $usuari->professor = $prof;
          $usuari->admin = 0;
          $usuari->superadmin = 0;
          $usuari->save();
        } else {
          $nouUsuari = new User;
          $nouUsuari->name = $camps[4];
          $nouUsuari->email = $camps[0];
          $nouUsuari->cognoms = $cognoms;
          $nouUsuari->curs = $curs;
          $nouUsuari->etapa = $etapa;
          $nouUsuari->grup = $grup;
          $nouUsuari->professor = $prof;
          $nouUsuari->admin = 0;
          $nouUsuari->superadmin = 0;
          $nouUsuari->save();
        }
 
    
        
    }
      
   
  



   
    $data = User::all();
    return view('alumnes', ['data' => $data]);
  }
  public function crearNouAlumne(){
  
    return view('formulariNouAlumne');
  }
  
}
