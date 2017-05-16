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
class CartController extends Controller
{
  public function AddToCart(Request $request,$id,$id2){
    $Product = Product::find($id);
    $price=0;
    $suk = $Product->id;
    $feature =$Product->name;
    foreach(explode("&",$id2) as $key=>$data){
      $layer = explode(".",$data);
      $price +=  ProductLayer::find($layer[0])->images()->find($layer[1])->item_price;
      $suk .= "-".$layer[0].$layer[1];
      if($key == 0){
          $feature =$feature." with ".ProductLayer::find($layer[0])->images()->find($layer[1])->item_name;
      }else{
          $feature =$feature." and ".ProductLayer::find($layer[0])->images()->find($layer[1])->item_name;
      }
    }
    Cart::add(array(
      'id' => $suk,
      'name' =>$feature,
      'price' =>$price,
      'quantity' => 1,
    ));
     return redirect('/cart');

  }
  public function Cart(){
   $items = Cart::getContent();
   return view('pages.cart',compact('items'));
  }
  public function DeleteCartItem($id){
    Cart::remove($id);
    return redirect()->back();
  }
  public function DecreaseQty($id){
    Cart::update($id, array(
      'quantity' => -1,
    ));
    return Cart::get($id)->quantity;
    //return redirect()->back();
  }
  public function IncreaseQty($id){
    Cart::update($id, array(
      'quantity' => +1,
    ));
    return Cart::get($id)->quantity;
    //return redirect()->back();
  }
  public function Clear(){
    Cart::clear();
    return redirect()->back();
  }

  public function checkout(){
    $cart = Cart::getContent();
    return view('pages.check',compact('cart'));
  }
  public function test(Request $request){
    $customer = Customer::create($request->all());
    $cart = Cart::getContent();
    $order =[
      'order_number'=>rand(),
      'details'=>serialize($cart),
      'total'=>Cart::getTotal(),
      'customer_id'=>$customer->id,
    ];
    Order::create($order);
  $order = array();
  foreach ($cart as $key => $value) {
    $items = explode("-",$value->id);
    $product_id="";
    $layers = array();
    $total=0;
    $url="";
    $image_id="";
    for($i=0 ;$i<count($items); $i++){
        if($i == 0){
            $product_id =  $items[0];
          }else{
           $array  = array_map('intval', str_split($items[$i]));
           for($x=1 ;$x<count($array); $x++){
             $image_id.=$array[$x];
           }
            $image = ProductLayerImage::find($image_id);
            //$total+=intval($image->item_price);
            //$total+=$image->item_price;
            if($i+1 == count($items)){
                $url .=$array[0].'.'.$image_id;
            }else{
                $url .=$array[0].'.'.$image_id.'&';
            }
            $array2= [
               'id'=>$array[0],
               'rank'=>ProductLayer::find($array[0])->rank,
               'image'=>$image->image,
               'color'=>$image->color,
               'item_name'=>$image->item_name,
               'item_distributer_name'=>$image->item_distributer_name,
               'item_price'=>$image->item_price,

            ];
            array_push($layers,$array2);
          }
        }
    //      $items = [
    //       'id'=>$product_id,
    //       'name'=>Product::find($product_id)->name,
    //       'url'=>$request->root().'/product/'.$product_id.'/'.$url,
    //       'layers'=>$layers,
    //       'total' =>$total,
    //     ];
    // array_push($order,$items);
}

 // view()->share('order',$order);
  //return view('pdfview');
  // $pdf = PDF::loadView('pdfview');
 // // $output = $pdf->output();
 // //Mail::to('sabryhend170@gmail.com')->send(new OrderShipped($output));
 // return $pdf->download('pdfview.pdf');
  }
}
