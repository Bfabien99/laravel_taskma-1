<?php

namespace App\Http\Controllers;

use App\Mail\ForgetPassword;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class MailableController extends Controller
{
    //
    public function reset_confirm(){
        return view('reset_confirm');
    }

    public function handle_reset_confirm(Request $request){
        $validate = $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $validate['email'])->first();
        if(!$user){
            return back()->with(key: 'error', value: 'Unknow mail... ');
        }

        $token = time().Str::random(30);
        PasswordReset::create([
            'token' =>  $token,
            'user_id' => $user->id
        ]);
        Mail::to($user->email)->send(new ForgetPassword(route('pass-reset', ['token' =>  $token])));
        return back()->with('success', 'Recovery mail send to your!');
    }

    public function reset_password(Request $request){
        $password_reset = PasswordReset::where('token', $request->input('token', ''))->firstOrFail();
        if($password_reset->status){
            return to_route('reset')->with('error', "We can't process, invalid token...");
        }

        $user = User::findOrFail($password_reset->user_id);
        return view('reset_password');
    }

    public function handle_reset_password(Request $request){
        $password_reset = PasswordReset::where('token', $request->input('token', ''))->firstOrFail();
        if($password_reset->status){
            return to_route('reset')->with('error', "We can't process, invalid token...");
        }

        $user = User::findOrFail($password_reset->user_id);

        $validate = $request->validate([
            'password' => ['required', Password::min(6)->mixedCase()->numbers()->symbols(), 'confirmed'],
        ]);
        $user->update($validate);
        $password_reset->update([
            'status' => true
        ]);
        return to_route('login')->with('success', 'Password reset, login now!');
    }
}
