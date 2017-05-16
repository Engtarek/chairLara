<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;
use Share;
use PDF;

class TestController extends Controller
{
    public function show_product(){
      $products = Product::all();
      return view('pages.products',compact('products'));
    }
    public function product($id,$id2="",Request $request){
      $product = Product::find($id);
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
      }

      $fb_button = Share::load($request->url(), $product->name)->facebook();
      $tweet_button = Share::load($request->url(), $product->name)->twitter();
      $gplus_button = Share::load($request->url(), $product->name)->gplus();
      $paint_button = Share::load($request->url(), $product->name)->pinterest();
      return view('pages.product',compact('id2','product','layers','defaultimages','fb_button','tweet_button','gplus_button','paint_button'));
    }
    public function order(){
       return '<a href="'.url("/orderpdf").'" class="btn btn-lg">Download PDF</a>';
   }
   public function orderpdf(Request $request){
     $item = Product::find(1);
     $layers = array();
     foreach($item->layers as $layer){
       $layer_image = $layer->images()->first();
       $array= [
         'id'=>$layer->id,
         'rank'=>$layer->rank,
         'image'=>$layer_image->image,
         'color'=>$layer_image->color,
         'item_name'=>$layer_image->item_name,
         'item_distributer_name'=>$layer_image->item_distributer_name,
         'item_price'=>$layer_image->item_price,
       ];
       array_push($layers,$array);
     }
     $items = [
       'id'=>$item->id,
       'name'=>$item->name,
       'url'=>$request->root().'/product/1',
       'layers'=>$layers,
     ];
    view()->share('items',$items);
  // return view('pdfview');
    $pdf = PDF::loadView('pdfview');
    // $output = $pdf->output();
    //Mail::to('sabryhend170@gmail.com')->send(new OrderShipped($output));
    return $pdf->download('pdfview.pdf');
   }

}
