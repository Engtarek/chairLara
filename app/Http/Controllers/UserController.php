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
      return view('pages.login');
    }
    public function save_login(Request $request){
      $remember = $request->remember;
      if (Auth::attempt(['email' => $request->email, 'password' => $request->password],$remember) ){
         return redirect()->intended(Session::get('backUrl'));
       }else{
         return redirect()->back()->with('fail','Your Email or Password wrong .');
       }
    }
    public function save_register(Request $request){
      $this->validate($request,[
        'name'=>'required|max:255',
        'last_name'=>'required|max:255',
        'email'=>'required|email|unique:users',
        'password'=>'required|min:6'
      ]);
      $data =array(
        'name'=>$request->name,
        'last_name'=>$request->last_name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'role'=>0
      );
      $user = User::create($data);
      Auth::login($user);
      return redirect()->intended(Session::get('backUrl'));
    }
    public function logout(){
      Auth::logout();
      return redirect()->back();
    }
}
