<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderStatus;
use Yajra\Datatables\Facades\Datatables;
use Auth;
use App\OrderHistory;
use Carbon\Carbon;
use App\Employees;
use PDF;
use App\Customer;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
class OrderController extends Controller
{
  //display all orders
  public function index(){
    return view('admin.order.index');
  }

  //update the status of order
  public function show($id){
    $order = Order::find($id);
    $order_items = unserialize($order->items);
    $status = OrderStatus::all();
    return view('admin.order.view',compact('order','order_items','status'));
  }

  //show all items including in order
  public function items($id){
    $order = Order::find($id);
    $order_items = unserialize($order->items);
    return view('admin.order.items',compact('order','order_items'));
  }

  //show the history of order
  public function details($id){
    $history = OrderHistory::where('order_id',$id)->get();
    return view('admin.order.details',compact('history'));
  }

  //delete order
  public function destroy($id){
    $order = Order::find($id);
    foreach($order->histories as $history){
      $history->delete();
    }
    $order->delete();
    return redirect()->route("orders.index")->with("success","The order deleted successfully");
  }

  //update the exiting product
  public function update(Request $request , $id){

    $order = Order::find($id);
    if ($order->status_id !== $request->status_id){
      $data=[
        'username'=>Auth::user()->name,
        'previous_status'=>$order->status_id,
        'current_status'=>$request->status_id,
        'order_id'=>$order->id,
        'text'=>''
      ];
      if (!empty($request->date)){
        $data["date"]=$request->date;
      }else{
        $data["date"]= Carbon::now()->setTimezone('Asia/Riyadh');
      }
      OrderHistory::create($data);
    }
    $order->status_id=$request->status_id;
    $order->save();
      return redirect()->route("orders.show",$id)->with("success","The order updated successfully");
  }

  //show form to choose one make the order
  public function assignOrder($id){
    return view('admin.order.assign_order',compact('id'));
  }

  //save  the employee make it and sending the email to him
  public function saveAssignOrder(Request $request){
    $employee = Employees::find($request->employee_id);
    $employee_email = $employee->email;
    $order = Order::find($request->order_id);

    //create pdf
     $order_array=array();
     $cart = unserialize($order->items);
     foreach ( $cart as $key => $value) {
         $items = explode("-",$value->id);
         $url="";
         for($i=1 ;$i<count($items); $i++){
           $array  = array_map('intval', str_split($items[$i]));
           $layer_id = $array[0];
           $image_id ="";
           for($x=1 ;$x<count($array); $x++){
             $image_id.=$array[$x];
           }
          if($i+1 == count($items)){
            $url .=$array[0].'.'.$image_id;
          }else{
            $url .=$array[0].'.'.$image_id.'&';
          }
        }
        $product_url =$request->root().'/product/'.$items[0].'/'.$url;
        $array = [
          'cart'=>$value,
          'url'=>$product_url,
        ];
        array_push($order_array,$array);
      }

      view()->share('order',$order_array);
    // return view('order-pdf');
    // $pdf = PDF::loadView('order-pdf');
    // $order_pdf = $pdf->output();
    // $customer = Customer::find($order->customer_id);
    //  Mail::to($employee_email)->send(new OrderShipped($customer,$order_pdf,$cart));
     $data=[
       'username'=>Auth::user()->name,
       'previous_status'=>0,
       'current_status'=>0,
       'order_id'=>$order->id,
        'text'=>$employee->name,
       'date'=>Carbon::now()->setTimezone('Asia/Riyadh'),
     ];
       OrderHistory::create($data);
       return redirect()->route('orders.index');
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
        foreach (unserialize($model->items) as $key => $value) {
          $price += $value->quantity * $value->price;
        }
        return $price;
     })
     ->editColumn('customer',function($model){
        return customer_name($model->customer_id);
     })
     ->editColumn('items',function($model){
          return  \Html::link('/admin/orders/items/'.$model->id,'Show Items');
     })
     ->editColumn('date',function($model){
        return date('d-m-Y h:i A',strtotime($model->created_at));
     })
     ->editColumn('status',function($model){
        return status_name($model->status_id);
     })
     ->editColumn('details',function($model){
          return  \Html::link('/admin/orders/details/'.$model->id,'show details');
     })
     ->editColumn('view',function($model){
          return  \Html::link('/admin/orders/'.$model->id,'View');
     })
     ->editColumn('assign_order',function($model){
          return  \Html::link('/admin/orders/assign/'.$model->id,'Assign Order');
     })
    ->make(true);
  }
}
