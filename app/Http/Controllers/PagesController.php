<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Cart;
use Session;
use App\Customer;
use App\Order;
use App\ProductLayer;

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
        //  $image_name = merge_image($defaultimages,$id,$image_pos);
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
          //$image_name = merge_image($defaultimages,$id,$image_pos);
        }
        $last="";
        $next="";
        if(!empty(Product::find($id+1))){
          $next=$id+1;
        }
        if(!empty(Product::find($id-1))){
                $last=$id-1;
        }
              return view('pages.product',compact('id2','product','layers','last','next'));
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
    public function test(Request $request){

      $x=2800;
      $y=1400;
      $outputImage = imagecreatetruecolor(2800, 1400);
      // set background to white
      $white = imagecolorallocate($outputImage, 255, 255, 255);
      imagefill($outputImage, 0, 0, $white);

      $last_pro_name = $request->product_id;
      foreach(explode("&",$request->last_pro)as $data){
        foreach (explode(".",$data) as $value) {
          $last_pro_name .=$value;
        }
      }
      if(file_exists('products/'.$request->product_id.'/history/'.$last_pro_name.'.png')){
        $name= imagecreatefrompng('products/'.$request->product_id.'/history/'.$last_pro_name.'.png');
        imagecopyresized($outputImage,$name,0,0,0,0, $x, $y,$x,$y);
      }else{
        $name= imagecreatefrompng('products/'.$request->product_id.'/history/init_image.png');
        imagecopyresized($outputImage,$name,0,0,0,0, $x, $y,$x,$y);
      }

      $imagename = $request->product_id;
        foreach(explode("&",$request->ch_layer_id2)as $data2){
          foreach (explode(".",$data2) as $value2) {
            $imagename .=$value2;
          }
        }
       $image = ProductLayer::find(explode(".",$request->layer_id)[0])->images()->find(explode(".",$request->layer_id)[1])->image;

      $ext = pathinfo($image, PATHINFO_EXTENSION);
      if($ext == 'png'){
        $name= imagecreatefrompng('products/'.$request->product_id.'/image/'.$image.'');
        imagecopyresized($outputImage,$name,0,0,0,0, $x, $y,$x,$y);
      }elseif($ext == 'jpg' || $ext == 'jpeg'){
        $name="2";
        $name= imagecreatefromjpeg('products/'.$request->product_id.'/image/'.$image.'');
        imagecopyresized($outputImage,$name,0,0,0,0, $x, $y,$x,$y);
      }

      if (!file_exists('products/'.$request->product_id.'/history')) {
          mkdir('products/'.$request->product_id.'/history', 0777, true);
      }
      imagepng($outputImage, 'products/'.$request->product_id.'/history/' .$imagename.'.png');
        //cut image
        $position =explode(" ",$request->img_pos);
        $startX = abs(substr($position[0], 0, -2));
       $startY = abs(substr($position[1], 0, -2));

        $img = imagecreatefrompng('products/'.$request->product_id.'/history/' .$imagename.'.png');
        $cropImage = imagecrop($img,['x'=>$startX,'y'=>$startY,'width'=>700,'height'=>700]);

        if (!file_exists('products/'.$request->product_id.'/small_image')) {
            mkdir('products/'.$request->product_id.'/small_image', 0777, true);
        }
       imagejpeg($cropImage,'products/'.$request->product_id.'/small_image/' .$imagename.'.jpg',40);
      // cutImage('products/'.$product_id.'/history/' .$imagename.'.jpg',$image_position,$product_id,$imagename);
       return $imagename;

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
