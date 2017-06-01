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
        $image_name = merge_image($defaultimages,$id);
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
        $image_name = merge_image($defaultimages,$id);
      }
      return view('pages.product',compact('id2','product','layers','image_name'));
    }
    public function change_image($product_id,$id2){
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
      return  merge_image($defaultimages,$product_id);

    }

}
