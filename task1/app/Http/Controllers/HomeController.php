<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
   public function __invoke(){
      $user = auth()->user();
        return view('home',compact('user'));
   }
}
