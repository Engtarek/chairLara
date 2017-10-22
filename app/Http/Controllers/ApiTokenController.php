<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\ApiToken;
use Hash;

class ApiTokenController extends Controller
{
  //show all tokens
  public function index(){
    return view('admin.api.index');
  }

  //show add token form
  public function create(){
    return view('admin.api.create');
  }

  //save new token in database
  public function store(Request $request){
    $this->validate($request,[
      'name'=>'required|max:255',
      'company_name'=>'required|max:255',
      'email'=>'required|email|unique:api_tokens',
      'active'=>'required',
    ]);

    $data = array(
      'name'=>$request->name,
      'company_name'=>$request->company_name,
      'email'=>$request->email,
      'api_token'=>Hash::make($request->email),
      'active'=>$request->active,
    );
    $token = ApiToken::create($data);
    return redirect()->route("api_tokens.index")->with("success","The token created successfully");
  }

  //show form to delete&edit token
  public function show($id){
    $token = ApiToken::find($id);
    return view('admin.api.view',compact('token'));
  }
  //edit exiting product
  public function update(Request $request, $id){
    $token = ApiToken::find($id);

    $data = array(
      'name'=>$request->name,
      'company_name'=>$request->company_name,
      'email'=>$request->email,
      'api_token'=>$request->api_token,
      'active'=>$request->active,
    );
    $token->update($data);
     return redirect()->route("api_tokens.index")->with("success","The token updated successfully");
  }

  //delete product
  public function destroy($id){
     $token = ApiToken::find($id);
     $token->delete();
      return redirect()->route("api_tokens.index")->with("success","The token deleted successfully");
  }

  //datatables
  public function data(){
    $token = ApiToken::all();
    return DataTables::of($token)
    ->editColumn('active',function($model){
      if($model->active == 1){
        return 'Active';
      }else{
        return 'Unactive';
      }
    })
    ->editColumn('view',function($model){
       return \Html::link('/admin/api_tokens/'.$model->id,'View');
    })
    ->make(true);
  }
}
