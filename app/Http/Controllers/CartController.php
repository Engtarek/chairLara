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
class CartController extends Controller
{
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

  public function checkout(Request $request){
     if(Auth::check()){
        $cart = Cart::getContent();
        return view('pages.check',compact('cart'));
     }else{
       return view('pages.login');
     }

  }
  public function test(Request $request){
      //save customer
      // $customer = Customer::create($request->all());
      // //save order
       $cart = Cart::getContent();
      // $order =[
      //   'order_number'=>rand(),
      //   'details'=>serialize($cart),
      //   'total'=>Cart::getTotal(),
      //   'customer_id'=>$customer->id,
      // ];
      // Order::create($order);

       // pdf download
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
       //return view('test');
       $pdf = PDF::loadView('test');
       // $output = $pdf->output();
       //Mail::to('sabryhend170@gmail.com')->send(new OrderShipped($output));
        return $pdf->download('pdfview.pdf');

      // pdf download
      // $order = array();
      // foreach ($cart as $key => $value) {
      //    $items = explode("-",$value->id);
      //    $product_id = $items[0];
      //    $layers=array();
      //    $url="";
      //    $total=0;
      //     for($i=1 ;$i<count($items); $i++){
      //       $array  = array_map('intval', str_split($items[$i]));
      //       $layer_id = $array[0];
      //       $image_id ="";
      //       for($x=1 ;$x<count($array); $x++){
      //         $image_id.=$array[$x];
      //       }
      //       $image =ProductLayerImage::find($image_id);
      //         $array2= [
      //           'id'=>$layer_id,
      //           'rank'=>ProductLayer::find($layer_id)->rank,
      //           'image'=>$image->image,
      //           'color'=>$image->color,
      //           'item_name'=>$image->item_name,
      //           'item_distributer_name'=>$image->item_distributer_name,
      //           'item_price'=>$image->item_price,
      //         ];
      //         array_push($layers,$array2);
      //          $total+=$image->item_price;
      //         if($i+1 == count($items)){
      //           $url .=$array[0].'.'.$image_id;
      //        }else{
      //          $url .=$array[0].'.'.$image_id.'&';
      //      }
      //       }
      //       $items = [
      //         'id'=>$product_id,
      //         'name'=>Product::find($product_id)->name,
      //         'url'=>$request->root().'/product/'.$product_id.'/'.$url,
      //         'layers'=>$layers,
      //         'total' =>$total * $value->quantity,
      //         'quantity' =>$value->quantity,
      //      ];
      //    array_push($order,$items);
      //  }


  }


}
