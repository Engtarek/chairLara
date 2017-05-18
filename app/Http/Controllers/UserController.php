<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\User;
use Hash;
class UserController extends Controller
{
    public function login(){
      return view('pages.login');
    }
    public function register(){
      return view('pages.register');
    }
    public function save_login(Request $request){
      if (Auth::attempt(['email' => $request->email, 'password' => $request->password]) ){
         return redirect()->intended(Session::get('backUrl'));
       }
    }
    public function save_register(Request $request){
      $user = new User;
      $user->name=$request->first_name." ".$request->last_name;
      $user->email=$request->email;
      $user->role= 0;
      $user->password=Hash::make($request->password);
      $user->save();
       return redirect()->intended('/cart');
    }
    public function logout(){
      Auth::logout();
      return redirect()->back();
    }
}
