<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Cart;
use Session;
use App\Customer;
use App\Order;

class PagesController extends Controller
{
    public function faq(){
      return view('pages.faq');
    }
    public function privacy(){
      return view('pages.privacy');
    }
    public function terms_conditions(){
      return view('pages.terms-conditions');
    }
    public function about(){
      return view('pages.about');
    }
    public function contact(){
      return view('pages.contact');
    }
    public function shop(){
      $products = Product::where('show',1)->take(8)->get();
      if(count($products) < 8 || count(Product::where('show',1)->skip(8)->take(8)->get()) == 0 ){
        $more=0;
      }else{
        $more=1;
      }
      return view('pages.index',compact('products','more'));
    }
    public function showmore(Request $request){
        $products = Product::where('show',1)->skip($request->numofelement)->take(8)->get();
      if(count(Product::where('show',1)->skip($request->numofelement + 8)->take(8)->get()) > 0){
        $more=1;
      }else{
        $more=0;
      }
      return $array=array('products'=>$products,'more'=>$more);
    }
    public function product($id,$id2="",Request $request){
      $product = Product::find($id);
      if($product->show == 1){
        $layers = $product->layers()->orderBy('rank','asc')->get();
        $defaultimages = [];
        if(!empty($id2)){
          foreach(explode('&',$id2) as $data){
            $layer = $product->layers->find(explode('.',$data)[0]);
            $array =[
              'rank'=>$layer->rank,
              'image'=>$layer->Images->find(explode('.',$data)[1]),
            ];
            array_push($defaultimages,$array);
          }
          $image_pos = "0px 0px";
          $image_name = merge_image($defaultimages,$id,$image_pos);
        }else{
          foreach($layers as $key=>$layer){
            $array =[
              'rank'=>$layer->rank,
              'image'=>$layer->Images->first(),

            ];
            $id2 .= $layer->id.'.'.$layer->Images->first()->id;
            if( $key != ( count( $layers ) - 1 ) ){
              $id2.='&';
            }
            array_push($defaultimages,$array);
          }
            $image_pos = "0px 0px";
          $image_name = merge_image($defaultimages,$id,$image_pos);
        }
        $last="";
        $next="";
        if(!empty(Product::find($id+1))){
          $next=$id+1;
        }
        if(!empty(Product::find($id-1))){
                $last=$id-1;
        }
              return view('pages.product',compact('id2','product','layers','image_name','last','next'));
      }else{
        return view('pages.404');
      }
    }
    public function change_image($product_id,$id2,$image_pos){
      $product = Product::find($product_id);
      $defaultimages = [];
      foreach(explode('&',$id2) as $data){
        $layer = $product->layers->find(explode('.',$data)[0]);
        $array =[
          'rank'=>$layer->rank,
          'image'=>$layer->Images->find(explode('.',$data)[1]),
        ];
        array_push($defaultimages,$array);
      }

       return  merge_image($defaultimages,$product_id,$image_pos);

    }
    public function checkout(){
      $cart = Cart::getContent();
      if(Cart::getTotal() != 0){
        return view('pages.chechout',compact('cart'));
      }else{
          return redirect('/');
      }
    }
    public function get_checkout_data(Request $request){
      $customer = $request->all();
      $cart = Cart::getContent();
      return view('pages.checkout2',compact('customer','cart'));
    }
    public function pay(Request $request){
      if(Cart::getTotal() == 0){
          return redirect('/');
      }else{
      $customer_data = Session::get('customer');
      // $param = array("address"=>$customer_data['country']." ".$customer_data['city']." ".$customer_data['address1']);
      // $response = \Geocoder::geocode('json', $param);
      // $a = json_decode($response);
      // $customer_data['lat'] = $a->results[0]->geometry->location->lat;
      // $customer_data['lng'] = $a->results[0]->geometry->location->lng;
      $customer_data['lat'] = 24.713552;
      $customer_data['lng'] = 46.675296;
      $customer = Customer::create($customer_data);

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
           foreach ($items as $k => $data) {
             if($k==0){
               $url=$data.'/';
             }elseif($k == count($items)-1){
               $url.=$data;
             }else{
               $url.=$data.'&';
             }
           }
           $product_url =$request->root().'/product/'.$url;
           $array = [
             'cart'=>$value,
             'url'=>$product_url,
           ];
           array_push($order,$array);
         }
       //  view()->share('order',$order);
       //return view('order-pdf');
     //  $pdf = PDF::loadView('order-pdf');
     //   $order_pdf = $pdf->output();
     //    Mail::to($customer->email)->send(new OrderShipped($customer,$order_pdf,$cart));
        Cart::clear();
        Session::forget('customer');
        return view('pages.order_success');
        }
    }

}
