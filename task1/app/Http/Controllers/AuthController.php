<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

   public function LoginView(){
      return view('auth/login');
   }

 public function login(LoginRequest $request)
 {
   $credentials = $request->validated();

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


 public function register(RegisterRequest $request)
 {
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
