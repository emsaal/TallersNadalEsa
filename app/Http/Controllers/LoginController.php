<?php

namespace App\Http\Controllers;

use App\Models\Taller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login(){
        $user = Socialite::driver('google')->user();
        $pos = strpos($user->email, '@');
        $domini = substr($user->email, $pos + 1);

        if($domini != "sapalomera.cat"){
            return view('errorLogin');
        } else {
        $userExists = User::where('email', $user->email)->first();
    
        if($userExists){
            Auth::login($userExists);
            $user = Auth::user();
            $data = Taller::all();
            return view('dashboard', ['data' => $data]);
        } else {
            echo "<script>alert('Error');</script>";
        }
    }
    
    }
    public function logout(Request $request){
   
      //COMPROVAR SI EL USUARI ESTA LOGEJAT
    
        Auth::logout();
      
        return redirect('/login-google');
   
       

    
    }
}
