<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Cart;
use Session;
use App\Customer;
use App\Order;
use App\ProductLayer;
use Illuminate\Support\Facades\Cache;
use App\Settings;

class PagesController extends Controller
{
    //faq page
    public function faq(){
      return view('pages.faq');
    }

    //privacy page
    public function privacy(){
      return view('pages.privacy');
    }

    //terms_conditions page
    public function terms_conditions(){
      return view('pages.terms-conditions');
    }

    //about page
    public function about(){
      return view('pages.about');
    }

    //contact page
    public function contact(){
      return view('pages.contact');
    }

    //index page
    public function shop(){

      $products = Product::where('show',1)->take(8)->get();
      if(count($products) < 8 || count(Product::where('show',1)->skip(8)->take(8)->get()) == 0 ){
        $more=0;
      }else{
        $more=1;
      }
      return view('pages.index',compact('products','more'));
    }

    //get more data in index page
    public function showmore(Request $request){
        $products = Product::where('show',1)->skip($request->numofelement)->take(8)->get();
        $product = array();
        foreach ($products as  $value) {
          $data =array(
            'id'=>$value->id,
            'name'=>$value->name,
            'image'=>$value->product_image->name,
            'init_image'=>$value->product_init_image->name,
            'show'=>$value->show,
          );
          array_push($product,$data);
        }
      if(count(Product::where('show',1)->skip($request->numofelement + 8)->take(8)->get()) > 0){
        $more=1;
      }else{
        $more=0;
      }
      return $array=array('products'=>$product,'more'=>$more);
    }

    //product page
    public function product($id,$id2="",Request $request){
      //setting
      $setting = Settings::find(1);
      $product = Product::find($id);
      $init_imagename = "";
      $imagename = "";
      $layers = $product->layers()->orderBy('rank','asc')->get();
      if($product->show == 1){
        if(!empty($id2)){
            $imagename = $id;
            foreach(explode("&",$id2)as $data){
              foreach (explode(".",$data) as $value) {
                $imagename .=$value;
              }
            }
          }else{
            $init_imagename = explode(".",$product->product_init_image->name)[0];
            foreach($layers as $key=>$layer){
                $id2 .= $layer->id.'.'.$layer->Images->first()->id;
                if( $key != ( count( $layers ) - 1 ) ){
                  $id2.='&';
                }
              }
          }

        $last="";
        $next="";
        if(!empty(Product::find($id+1))){
          $next=$id+1;
        }
        if(!empty(Product::find($id-1))){
          $last=$id-1;
        }
        return view('pages.product',compact('id2','product','init_imagename','imagename','layers','last','next','setting'));
      }else{
        return view('pages.404');
      }
    }

    //change image
    public function change_image(Request $request){

      //get new imagename
      $imagename = $request->product_id;
        foreach(explode("&",$request->ch_layer_id2)as $data2){
          foreach (explode(".",$data2) as $value2) {
            $imagename .=$value2;
          }
        }

      // make condition
      if(!Cache::get($imagename) && !file_exists("products/".$request->product_id."/history/".$imagename.".png")){

        createImage($request->product_id,$request->last_pro,$request->layer_id,$imagename,$request->img_pos);
        Cache::forever($imagename, $imagename);
        return $imagename;

      }elseif(Cache::get($imagename) && file_exists("products/".$request->product_id."/history/".$imagename.".png")){
        cutImage('products/'.$request->product_id.'/history/' .$imagename.'.png',$request->img_pos,$request->product_id,$imagename);
         return  Cache::get($imagename);

      }elseif(!Cache::get($imagename) && file_exists("products/".$request->product_id."/history/".$imagename.".png")){
          cutImage('products/'.$request->product_id.'/history/' .$imagename.'.png',$request->img_pos,$request->product_id,$imagename);
         Cache::forever($imagename, $imagename);
         return $imagename;
      }elseif(Cache::get($imagename) && !file_exists("products/".$request->product_id."/history/".$imagename.".png")){
        Cache::forget($imagename);
        createImage($request->product_id,$request->last_pro,$request->layer_id,$imagename,$request->img_pos);

        Cache::forever($imagename, $imagename);
        return $imagename;
      }
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
    //test
//     public function testing(){
//       return view('test');
//     }
//     public function upload_testing( Request $request){
//       parent::__construct();
//   //  \Cloudinary\Uploader::upload("s3://my-bucket/my-path/sample.jpg");
// //return ;
// //dd($request->file('image')->getRealPath());
//       \Cloudinary\Uploader::upload( $request->file('image')->getRealPath(),array("public_id" => "my_folder/my_sub_folder/my_name"));
//     //  return "done";
//     }
}
