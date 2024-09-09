<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function login(){
        return view('login');
    }

    public function handle_login(Request $request){
        # récupération et validation des données du formulaire
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        # essaie d'authentification
        if(!Auth::attempt($validate)){
            return back()->withInput(['email'])->with('error', 'Invalid credentials!');
        }

        # connexion (persistance dans la session)
        $user = User::where('email', $validate['email'])->first();
        Auth::login($user);

        # retoune à l'accueil
        return to_route('home');
    }

    public function register(){
        return view('register');
    }

    public function handle_register(Request $request){
        # récupération et validation des données du formulaire
        $validate = $request->validate([
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|unique:users,email',
            #'password' => 'required|min:6|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[!#@]/|confirmed'
            'password' => ['required', Password::min(6)->mixedCase()->numbers()->symbols(), 'confirmed'],
        ]);

        # sauvegarde des données si tout est bon
        $user = new User();
        $user->name = mb_ucfirst($validate['name']);
        $user->email = strtolower($validate['email']);
        $user->password = $validate['password'];
        $user->save();

        # retour avec message flash
        return back()->with('success', 'Registered succesfuly!');

    }

    public function logout(Request $request){
        # déconnexion
        Auth::logout();
        # réinitialisation de la session
        $request->session()->regenerate();

        # retoune à l'accueil
        return to_route('home');
    }
}
