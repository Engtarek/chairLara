<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use Auth;
use Session;
use App\User;
use Hash;
class UserController extends Controller
{

  //show all users
  public function index(){

    return view('admin.users.index');
  }

  //show add user form
  public function create(){
    return view('admin.users.create');
  }

  //save new user in database
  public function store(Request $request){
    $this->validate($request,[
      'name'=>'required|max:255',
      'email'=>'required|email',
      'password'=>'required|min:6',
      'role_id'=>'required',
    ]);
    $data = array(
      'name'=>$request->name,
      'email'=>$request->email,
      'password'=>$request->password,
      'role_id'=>$request->role_id,
      'confirm'=>'0',
    );
    $user = User::create($data);
    return redirect()->route("users.index")->with("success","The user created successfully");
  }

  //show form to delete&edit user
  public function show($id){
     $user = User::find($id);
     $licenses = $user->Licenses;
    return view('admin.users.view',compact('user','licenses'));
  }
  //edit exiting user
  public function update(Request $request, $id){
    $user = User::find($id);
    $data = array(
      'name'=>$request->name,
      'email'=>$request->email,
      'password'=>$user->password,
      'role_id'=>$request->role_id,
      'confirm'=>$request->confirm,
    );
    $user->update($data);
     return redirect()->route("users.index")->with("success","The user updated successfully");
  }

  //delete product
  public function destroy($id){
     $user = User::find($id);
     foreach ($user->licenses as $key => $value) {
       $value->delete();
     }
     $user->delete();
     return redirect()->route("users.index")->with("success","The user deleted successfully");
  }

  //datatables
  public function data(){
    $user = User::all();
    return DataTables::of($user)
    ->editColumn('status',function($model){
       if($model->confirm == 1){
         return 'Active';
       }else{
         return 'Pending';
       }
    })
    ->editColumn('details',function($model){
       return \Html::link('/admin/users/'.$model->id,'Details');
    })
    ->editColumn('licenses',function($model){
       return \Html::link('/admin/licenses/'.$model->id,'Licenses');
    })
    ->make(true);
  }
  public function change_password(){
      return view('admin.users.change_password');

  }
  public function save_change_password(Request $request){
    $user = User::where('email',$request->email)->first();
    $user->password = Hash::make($request->password);
    $user->save();
  //  Auth::loginUsingId($user->id);
    return redirect('/admin/login');

  }

  public function register(){
    return view('admin.users.register');
  }

  public function save_reqister(Request $request){
    $this->validate($request,[
      'name'=>'required|max:255',
      'email'=>'required|email',
      'password'=>'required|min:8',
    ]);
    $data = array(
      'name'=>$request->name,
      'email'=>$request->email,
      'password'=>Hash::make($request->password),
      'role_id'=>2,
      'confirm'=>0,
    //  'remember_token'=>$request->_token,
    );
    $user = User::create($data);
    return redirect('/admin/register')->with("success","Admin will activate your acount");
  }
  public function login(){
    return view('admin.users.login');
  }
  public function save_login(Request $request){
    if ( Auth::attempt(['email' => $request->email, 'password' => $request->password, 'confirm' => 1]) ) {
        return redirect('/admin/products');
      }else{
        return redirect('/admin/login')->with("success","password or email not correct");
      }



  }
    // public function login(){
    //   return view('pages.login');
    // }
    // public function register(){
    //   return view('pages.login');
    // }
    // public function save_login(Request $request){
    //   $remember = $request->remember;
    //   if (Auth::attempt(['email' => $request->email, 'password' => $request->password],$remember) ){
    //      return redirect()->intended(Session::get('backUrl'));
    //    }else{
    //      return redirect()->back()->with('fail','Your Email or Password wrong .');
    //    }
    // }
    // public function save_register(Request $request){
    //   $this->validate($request,[
    //     'name'=>'required|max:255',
    //     'last_name'=>'required|max:255',
    //     'email'=>'required|email|unique:users',
    //     'password'=>'required|min:6'
    //   ]);
    //   $data =array(
    //     'name'=>$request->name,
    //     'last_name'=>$request->last_name,
    //     'email'=>$request->email,
    //     'password'=>Hash::make($request->password),
    //     'role'=>0
    //   );
    //   $user = User::create($data);
    //   Auth::login($user);
    //   return redirect()->intended(Session::get('backUrl'));
    // }
    // public function logout(){
    //   Auth::logout();
    //   return redirect()->back();
    // }
}
