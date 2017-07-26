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
use App;
class CartController extends Controller
{
  // add new element to cart
  public function AddToCart(Request $request){

    $Product = Product::find($request->product_id);
    $price=0;
    $suk = $Product->id;
    $feature_en =$Product->name_en;
    $feature_ar =$Product->name_ar;
    $layers = array();
    foreach(explode("&",$request->id2) as $key=>$data){
      $items = explode(".",$data);
      $layer=ProductLayer::find($items[0]);
      $array= [
        'id'=>$layer->id,
        'rank'=>$layer->rank,
        'image'=>$layer->images()->find($items[1])->image,
        'item_name'=>$layer->images()->find($items[1])->item_name_en,
        'item_distributer_name'=>$layer->images()->find($items[1])->item_distributer_name_en,
        'item_price'=>$layer->images()->find($items[1])->item_price,
        'product_id'=> $Product->id,
      ];
      array_push($layers,$array);
      $price +=  $layer->images()->find($items[1])->item_price;
      $suk .= "-".$items[0].".".$items[1];
      if($key == 0){
          $feature_en =$feature_en." with ".$layer->images()->find($items[1])->item_name_en;
          $feature_ar =$feature_ar." يتكون من  ".$layer->images()->find($items[1])->item_name_ar;
      }else{
          $feature_en =$feature_en." and ".$layer->images()->find($items[1])->item_name_en;
          $feature_ar =$feature_ar." و ".$layer->images()->find($items[1])->item_name_ar;
      }
    }
    Cart::add(array(
      'id' => $suk."&".$request->size,
      'name' =>array('name_ar'=>$feature_ar,'name_en'=>$feature_en),
      'price' =>$price,
      'quantity' => $request->quantity,
      'attributes'=> array('layers' => $layers,'size'=>$request->size ),
    ));

    return '/cart';

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



}
