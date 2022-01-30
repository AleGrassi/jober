<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authentication(){
        return view('auth.auth');
    }

    public function login(){
    
    }

    public function logout(){
        session_start();
        session_destroy();
        return Redirect::to('home');
    }

    public function registration(){

    } 
}
