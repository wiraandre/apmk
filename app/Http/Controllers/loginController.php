<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class loginController extends Controller
{
    public function index()
    {
    	return view ('login');
    }

    public function login(Request $request)
    {

    	if (Auth::attempt($request->only('email','password'))) {
    		return redirect('/');
    	}else{
    		return redirect('/login')->with('danger', 'Email atau Password salah');
    	}

    }
    public function logout()
    	{
    		Auth::logout();
    		return redirect('/login');
    	}
}
