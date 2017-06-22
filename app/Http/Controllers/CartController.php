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
      $suk .= "-".$items[0].".".$items[1];
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

  

}
