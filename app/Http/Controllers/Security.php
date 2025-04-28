<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Security extends Controller
{
    public function index(){
//        User::create(
//            [
//                'name'=>'lika gueye',
//                'email'=>'lika@gueye.com',
//                'password'=>Hash::make('123')
//            ]
//        );
        return view('security.security');
    }
    public function login(Request $request){
        $verif=$request->validate([
            'email' => 'required|String|email',
            'password' => 'required|String',
        ]);
        //dd($verif);

        /*
         * Auth::attempt() est une méthode de Laravel pour essayer de connecter un utilisateur.
         * attempt() va vérifier dans la base de données s'il existe un utilisateur avec cet email et ce mot de passe.
         - Si l'authentification réussit, il connecte l'utilisateur (c'est-à-dire qu'il sauvegarde l'utilisateur dans la session).
         * $request->session()->regenerate();
         - Si la connexion est réussie, on renouvelle l'identifiant de session.
         - Cela sert à se protéger contre les attaques de type Session Fixation (où un hacker pourrait voler une session).
         - Cela crée un nouvel ID de session pour l'utilisateur après sa connexion.
         */
        if (\Illuminate\Support\Facades\Auth::attempt($verif)){

            $request->session()->regenerate();
            return to_route('tache.index');
        }
        return back()->with(['error'=>'Email ou mot de passe incorrect']);
    }

    function logout(Request $request){
        \Illuminate\Support\Facades\Auth::logout();
        // on arrete la session deja definie
        $request->session()->invalidate();
        // on regenere un nouveau token
        $request->session()->regenerateToken();
        return to_route('login');
    }
}
