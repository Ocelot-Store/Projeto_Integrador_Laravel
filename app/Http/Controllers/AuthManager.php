<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    function registration(){
        return view('authentication.registration');
    }

    function login(){
        return view('authentication.login');
    }
    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect() -> intended(route('home'));
        }
        return redirect(route('login'))->with("error", "Login details are not valid");

        

    }
    function registrationPost(request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user', // email verifica se é um email válido @xxxx.com 
            'address' => 'required',
            'password' => 'required',
            'PasswordConfirmation' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['address'] = $request->address;
        $data['password'] = Hash::make($request->password);
        $data['PasswordConfirmation'] = Hash::make($request->password);

        $user = User::create($data);

        if(Auth::login($user));{
            return redirect(route('home'))->with("success", "Registration completed, login to access the website");
        }
        return redirect(route('registration'))->with("error", "Registration failed try again.");
        
        
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('index'));        
    }



}
