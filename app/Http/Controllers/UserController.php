<?php

namespace App\Http\Controllers;
use App\Models\Taller;
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
    $data = User::where('professor', '=', 0)->where('admin', '=', 0)->where('superadmin', '=', 0)->get();

    return view('alumnes', ['data' => $data]);
   
  }

  public function taulaProfessors(){


    
   

    $data = User::where('professor', '=', 1)->get();
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
    

    $data = User::where('professor', '=', 1)->get();

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
    
    $data = Taller::all();
    return view('formulariNouAlumne', ['data' => $data]);
  }

  public function inserirNouUsuari(Request $request){
    $validar = $request->validate([
      'name' => 'required|string|max:255',
      'cognom' => 'required|string|max:255',
      'email' => 'required|email|unique:users|max:255',
      'etapa' => 'required|string|',
      'curs' => 'required|string|',
      'grup' => 'required|string|',
  ]);
  
      $usuari = new User;
      $usuari->name = $validar['name'];
      $usuari->cognoms = $validar['cognom'];
      $usuari->email = $validar['email'];
      $usuari->etapa = $validar['etapa'];
      $usuari->curs = $validar['curs'];
      $usuari->grup = $validar['grup'];
      $usuari->admin = 0;
      $usuari->superadmin =0;
      $usuari->professor = 0;
  
  if ($usuari->save()) {
      return redirect()->back()->with('success', 'Usuari creat');
  } else {
    return redirect()->back()->withErrors($validar);
  }
  }
  public function asignarUsuariTaller(Request $request){
    $primerTaller = $request->input('primerTaller');
    $segonTaller = $request->input('segonTaller');
    $tercerTaller = $request->input('tercerTaller');
    $usuariId = $request->input('usuariID');
    
    if (!$usuariId) {
        $usuariId = Auth::user()->id;
    }
    
    $usuari = User::find($usuariId);
    
    if ($usuari->tallers()->sync([
        $primerTaller => ['position' => 1],
        $segonTaller => ['position' => 2],
        $tercerTaller => ['position' => 3]
    ])) {
      return redirect()->route('alumnes.mostrar')->with('success', "S'han assignat tallers a l'usuari");

    } else {
        return redirect()->back()->withErrors('error', "No s'han pogut assignar tallers a l'usuari");
    }
    
    
  }
  public function retornarPerfil(){
    $tallers = Taller::withCount('users')->get();

    $tallers->each(function ($taller) {
        $taller->isFull = $taller->users_count >= $taller->nAlumnes;
    });

    $user = Auth::user();
    $userTallers = $user->tallers()->pluck('taller_id')->toArray();

    return view('afegirTallers', compact('tallers', 'userTallers'));

  }


  public function retornarPerfilAdmin(Request $request){
    $usuari = User::find($request->input('usuariID'));
    $tallers = Taller::all();
    return view('formulariEditarUsuari')->with(compact('tallers', 'usuari'));
  }

  public function alumSenseTaller(Request $request){
    $usuarisSenseTaller = User::where('professor', '=', 0)->where('admin', '=', 0)->where('superadmin', '=', 0)->whereDoesntHave('tallers')->get();

return view('alumnesSenseTaller')->with(compact('usuarisSenseTaller'));
  }


}
