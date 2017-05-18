<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Yajra\Datatables\Facades\Datatables;

class OrderController extends Controller
{
  public function index(){
    return view('admin.order.index');
  }
  public function show($id){
    $order = Order::find($id);
    $order_details = unserialize($order->details);
    return view('admin.order.show',compact('order','order_details'));
  }
  //datatables
  public function data(){
    $order = Order::all();
    return DataTables::of($order)
     ->editColumn('order_code',function($model){
        return $model->order_number;
     })
     ->editColumn('total',function($model){
        $price = 0;
        foreach (unserialize($model->details) as $key => $value) {
          $price += $value->quantity * $value->price;
        }
        return $price;
     })
     ->editColumn('customer',function($model){
        return customer_name($model->customer_id);
     })
     ->editColumn('details',function($model){
          return  \Html::link('/admin/orders/'.$model->id,'show details');
     })

    ->make(true);
  }
}
