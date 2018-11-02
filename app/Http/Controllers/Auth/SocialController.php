<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Socialite;


class SocialController extends Controller
{
    public function capturarProvider($proveedor)
    {
        //$social_user = Socialite::driver('facebook')->user();     
        dd("entre ".$proveedor);
    }
    public function irAlProveedor($provider)
    {
        //dd("proveedor: ".$provider);
        return Socialite::driver($provider)->redirect();
    }
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    // Metodo encargado de obtener la información del usuario
    public function tomarCallback($provider)
    {
        // Obtenemos los datos del usuario
        $social_user = Socialite::driver($provider)->user(); 
        // Comprobamos si el usuario ya existe
        //dd($social_user->id);
        if ($user = User::where('email', $social_user->email)->first()) { 
            return $this->authAndRedirect($user); // Login y redirección
        } else {  
            // En caso de que no exista creamos un nuevo usuario con sus datos.
            $user = User::create([
                'name' => $social_user->name,
                'email' => $social_user->email,
                'provider' => $provider,
                'provider_id' => $social_user->id,
                'verified' => true,
                'avatar' => $social_user->avatar,
            ]);
 
            return $this->authAndRedirect($user); // Login y redirección
        }
    }
 
    // Login y redirección
    public function authAndRedirect($user)
    {
        Auth::login($user);
 
        return redirect()->to('/home#');
    }
}

