<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthController extends Controller
{
    //
    public function login(){
        return view('client.auth.login');
    }

    public function handleLogin(Request $request){
       $auth =   Auth::attempt($request->only('email','password'));
       if($auth){
        return redirect()->route('home.index');
       }else{
        return redirect()->back()->with('message','Email or password is incorrect');
       }
    }
    public function register(){}

    public function handleRegister(Request $request){
        $user = User::create($request->all());
        Auth::login($user);
        return redirect()->route('home.index');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
