<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\License;
use App\Mail\LicenseMail;
use Illuminate\Support\Facades\Mail;
use App\User;
class LicenseController extends Controller
{
    public function all_license($id)
    {
        $licenses = User::find($id)->licenses;
        return view('admin.licenses.index',compact('licenses'));
    }

    public function create_license($user_id){
      return view('admin.licenses.create',compact('user_id'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
          'license'=>'required',
          'website_url'=>'required',
        ]);
        $data = array(
          'license'=>Hash::make($request->license).rand().time(),
          'website_url'=>$request->website_url,
          'user_id'=>$request->user_id,
        );
        $user = User::find($request->user_id);
        $License = License::create($data);
         Mail::to($user->email)->send(new LicenseMail($License->license,''));
        return redirect("admin/licenses/".$request->user_id)->with("success","The Licenses created successfully");
    }

    public function destroy($id)
    {
        $license = License::find($id);
        $license->delete();
    }

    public function create_new_user(){
        return view('admin.licenses.create_new_user');
    }

    public function save_new_user(Request $request){
      //user
      $this->validate($request,[
        'name'=>'required|max:255',
        'email'=>'required|email',
        'password'=>'required|min:6',
        'role_id'=>'required',
        'license'=>'required',
        'website_url'=>'required',
      ]);
      $user_data = array(
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),
        'role_id'=>$request->role_id,
        'confirm'=>'1',
       'remember_token'=>$request->_token
      );
      $user = User::create($user_data);
      //license
      $license_data = array(
        'license'=>Hash::make($request->license.rand().time()),
        'website_url'=>$request->website_url,
        'user_id'=>$user->id,
      );
      $License = License::create($license_data);
      //send email
       $test = Mail::to($user->email)->send(new LicenseMail($License->license,$request->root().'/change_password'));
      return redirect()->route('users.index')->with('success','The user created successfully with license');
    }

    public function enable_update($id,Request $request){
        $License = License::find($id);
        $License->enable = $request->enable;
        $License->save();
    }
}
