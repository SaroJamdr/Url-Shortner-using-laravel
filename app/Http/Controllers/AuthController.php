<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
   public function register_page(){
    return view ('auth.register');
   }
   public function register(Request $request){
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'unique|required|email|max:255',
        'password' => 'required|string|confirmed|min:6|max:255',
        'conf_password' => 'required|string|max:255'

    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password
    ]);

    return redirect()->route('login')->with('success','Registered Succesfully.');

    // Auth::login($user);
    // $this->login($request);
   
    //Since the user is registered, we need to authenticate the user or login


   }
   public function login_page(){
    return view('auth.login');
   }
   public function login(Request $request){
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|'
    ]);
     
    $credentials  = $request->only('email','password');

    //Auth::attempt method checks if the user with provided email exist in the database.
    //If the user is present, check the password if it matches the one in the database.
    //If both conditions are met, start a new user session as authenticated.

    if(Auth::attempt($credentials)){
        return redirect()->intended('urls')->with('success','Logged in succesfully');
    }

   }
   public function logout(Request $request){
    auth()->logout();
    return redirect()->route('home');

   }

   public function profile(){
    return view('url.profile');
   }

   public function update_profile(Request $request){
    // dd($request);
    $request->validate([
        'name' => 'required|string|max:255'
    ]);
    $user = auth()->user();
    $user->name = $request->name;
    $user->save();
    return redirect()->back()->with('success','Profile updated succesfully.');

   }

}
