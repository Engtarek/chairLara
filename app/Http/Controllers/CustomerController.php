<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use Yajra\Datatables\Facades\Datatables;

class CustomerController extends Controller
{
  public function index(){
    return view('admin.customer.index');
  }
  //datatables
  public function data(){
    $customer = Customer::all();
    return DataTables::of($customer)
     ->editColumn('first_name',function($model){
        return $model->first_name;
     })
     ->editColumn('last_name',function($model){
        return $model->last_name;
     })
     ->editColumn('company_name',function($model){
        return $model->company_name;
     })
     ->editColumn('email',function($model){
        return $model->email;
     })
     ->editColumn('phone',function($model){
        return $model->phone;
     })
     ->editColumn('address',function($model){
        return $model->address;
     })
     ->editColumn('city',function($model){
        return $model->city;
     })
     ->editColumn('state',function($model){
        return $model->state;
     })
     ->editColumn('zip',function($model){
        return $model->ZIP;
     })
    ->make(true);
  }

}
