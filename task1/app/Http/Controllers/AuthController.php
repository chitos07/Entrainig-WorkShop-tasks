<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

   public function LoginView(){
      return view('auth/login');
   }

 public function login(Request $request)
 {
   $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
  ]);

    if (Auth::attempt($credentials)) {
       $request->session()->regenerate();

   return redirect()->intended('home');
}
   return back()->withErrors([
      'email' => 'The provided credentials do not match our records.',
   ])->onlyInput('email');


 }

 public function registerView()
 {
    return view('auth/register');
 }


 public function register(Request $request)
 {
      $request->validate([
         'name' => ['required','string'],
         'email' => ['required','email'],
         'password' => ['required','confirmed'],

       ]);

   $user = User::create([
         'name' => $request->name,
         'email' => $request->email,
         'password' => Hash::make($request->password)
   ]);

   auth()->login($user);
   if($user){
         return redirect()->route('home');

   }
 }

 public function logout(Request $request)
 {
   Auth::logout();
   $request->session()->invalidate();
   $request->session()->regenerateToken();
   return redirect()->route('login');
 }
 
}
