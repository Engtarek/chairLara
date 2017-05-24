<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Yajra\Datatables\Facades\Datatables;

class CustomerController extends Controller
{
  //display all customers
  public function index(){
    return view('admin.customer.index');
  }

  //show specific customer
  public function show($id){
    $customer = Customer::find($id);
    return view('admin.customer.view',compact('customer'));
  }

  //edit in the customer data
  public function update($id,Request $request){
    $this->validate($request,[
      'name' => 'required',
      'email' => 'required',
      'phone' => 'required',
      'country' => 'required',
      'city' => 'required',
      'address' => 'required',
    ]);
    $customer = Customer::find($id);
    $customer->update($request->all());
    return redirect()->route("customers.show",$id)->with("success","The Customer updated successfully");

  }

  //delete specific customer
  public function destroy($id){
    $customer = Customer::find($id);
    foreach($customer->orders as $order){
      foreach($order->histories as $history){
        $history->delete();
      }
      $order->delete();
    }
    $customer->delete();
    return redirect()->route("customers.index")->with("success","The Customer deleted successfully");
  }
  //datatables
  public function data(){
    $customer = Customer::all();
    return DataTables::of($customer)

     ->editColumn('name',function($model){
        return $model->name;
     })
     ->editColumn('email',function($model){
        return $model->email;
     })
     ->editColumn('phone',function($model){
        return $model->phone;
     })
     ->editColumn('country',function($model){
        return $model->country;
     })
     ->editColumn('city',function($model){
        return $model->city;
     })
     ->editColumn('address',function($model){
        return $model->address;
     })
     ->editColumn('view',function($model){
       return \Html::link('/admin/customers/'.$model->id,'view');
     })
    ->make(true);
  }

}
