<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Cart;
use App\ProductLayer;
use App\Customer;
use App\Order;
use App\ProductLayerImage;
use PDF;
use Auth;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
  // add new element to cart
  public function AddToCart(Request $request,$id,$id2,$id3){
    $Product = Product::find($id);
    $price=0;
    $suk = $Product->id;
    $feature =$Product->name;
    $layers = array();
    foreach(explode("&",$id2) as $key=>$data){
      $items = explode(".",$data);
      $layer=ProductLayer::find($items[0]);
      $array= [
        'id'=>$layer->id,
        'rank'=>$layer->rank,
        'image'=>$layer->images()->find($items[1])->image,
        'item_name'=>$layer->images()->find($items[1])->item_name,
        'item_distributer_name'=>$layer->images()->find($items[1])->item_distributer_name,
        'item_price'=>$layer->images()->find($items[1])->item_price,
        'product_id'=> $Product->id,
      ];
      array_push($layers,$array);
      $price +=  $layer->images()->find($items[1])->item_price;
      $suk .= "-".$items[0].$items[1];
      if($key == 0){
          $feature =$feature." with ".$layer->images()->find($items[1])->item_name;
      }else{
          $feature =$feature." and ".$layer->images()->find($items[1])->item_name;
      }
    }
    Cart::add(array(
      'id' => $suk,
      'name' =>$feature,
      'price' =>$price,
      'quantity' => $id3,
      'attributes'=>$layers,
    ));
    return redirect('/cart');

  }

  //get all elements in the cart
  public function Cart(){
   $items = Cart::getContent();
   return view('pages.cart',compact('items'));
  }

  //delete the specified element from cart
  public function DeleteCartItem($id){
    Cart::remove($id);
    return redirect()->back();
  }

  // subtract the quantity by one
  public function DecreaseQty($id){
    Cart::update($id, array(
      'quantity' => -1,
    ));
    $total=0;
    foreach (Cart::getContent() as $key => $cart) {
      $total += $cart->quantity * $cart->price;
    }
    return $array = [
      'single'=>Cart::get($id),
      'total'=>$total,
      'total_quantity'=>Cart::getTotalQuantity(),
    ];
  }
  //add the quantity by one
  public function IncreaseQty($id){
    Cart::update($id, array(
      'quantity' => +1,
    ));
    $total=0;
    foreach (Cart::getContent() as $key => $cart) {
      $total += $cart->quantity * $cart->price;
    }
    return $array = [
      'single'=>Cart::get($id),
      'total'=>$total,
      'total_quantity'=>Cart::getTotalQuantity(),
    ];
  }
  //delete all elements in the cart
  public function Clear(){
    Cart::clear();
    return redirect()->back();
  }
  //check if user login=>make checkout else make login or register
  public function checkout(Request $request){
     if(Auth::check()){
        $cart = Cart::getContent();
        return view('pages.check',compact('cart'));
     }else{
       return view('pages.login');
     }
  }
  //save customer ,order,create pdf and send email to customer
  public function test(Request $request){
      //save customer
        $param = array("address"=>Auth::user()->country." ".Auth::user()->city." ".Auth::user()->address);
        $response = \Geocoder::geocode('json', $param);
        $a = json_decode($response);
        $lat = $a->results[0]->geometry->location->lat;
        $lang = $a->results[0]->geometry->location->lng;
      $data=[
        'name'=>Auth::user()->name,
        'email'=>Auth::user()->email,
        'phone'=>Auth::user()->phone,
        'country'=>Auth::user()->Country,
        'city'=>Auth::user()->city,
        'address'=>Auth::user()->address,
         'lat'=>$lat,
         'lng'=>$lang,
      ];

     $customer = Customer::create($data);
     //save order
      $cart = Cart::getContent();
      $order =[
        'order_number'=>rand(),
        'items'=>serialize($cart),
        'total'=>Cart::getTotal(),
        'customer_id'=>$customer->id,
        'status_id'=>1,
      ];
      Order::create($order);
       //pdf download
       $order=array();
       foreach ($cart as $key => $value) {
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
          array_push($order,$array);
        }
        view()->share('order',$order);
    //   return view('order-pdf');
      $pdf = PDF::loadView('order-pdf');
      $order_pdf = $pdf->output();
       Mail::to($customer->email)->send(new OrderShipped($customer,$order_pdf,$cart));
       Cart::clear();
       return " your order send successufelly ,please check your email";
  }


}
