<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function registration(){
        return view('auth.registration');
    }

    public function store(Request $request){
        $Validated = $request->validate([
            'name' => 'required|min:2|string|max:255 ',
            'email' => 'required|string|unique:users|email:dns|max:255 ',
            'username' => 'required|string|min:3|unique:users|max:255 ',
            'password' => 'required|string|min:5|',
            'role'=>'required'
        ]);
        // return dd($request->all());
        User::create($Validated);
        return  redirect('/login')->with('success', 'Registration successful. Please log in.');
    }

    public function authenticate(Request $request){
        $credential = $request->validate([
            'username' => 'required|min:3|max:225',
            'password' => 'required|min:5'
        ]);
        if (Auth::attempt($credential)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        } 

        return back()->with('error','Login Failed!!');
    }
        
    
}
