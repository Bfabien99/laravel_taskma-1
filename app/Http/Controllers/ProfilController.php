<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class ProfilController extends Controller
{
    //
    public function index(){
        return view('user.profil');
    }

    public function update_info(Request $request){
        $user = User::findOrFail(auth()->user()->id);
        $validated = $request->validate([
            'name' => 'required|min:2|max:50',
            'email' => 'required|email',
        ]);
        $user->update($validated);
        return back()->with('success-info', 'Information updated!');
    }

    public function update_pass(Request $request){
        $user = User::findOrFail(auth()->user()->id);
        $validated = $request->validate([
            'password' => ['required', Password::min(6)->mixedCase()->numbers()->symbols(), 'confirmed'],
        ]);
        $user->update($validated);
        return back()->with('success-pass', 'Password updated!');
    }   
}
