<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ApiController extends Controller
{
  public function get_all_product(){
    $products = Product::all();
    return response()->json(['products'=>$products]);
  }
  public function get_product($id,$id2=""){
    $product = Product::find($id);
    $layers = $product->layers()->orderBy('rank','asc')->get();
    $imagename = "";
    $init_imagename ="";

      if(!empty($id2)){
          $imagename = $id;
          foreach(explode("&",$id2)as $data){
            foreach (explode(".",$data) as $value) {
              $imagename .=$value;
            }
          }
          $imagename .=".png";
        }else{
          $init_imagename = $product->product_init_image->name;
          foreach($layers as $key=>$layer){
              $id2 .= $layer->id.'.'.$layer->Images->first()->id;
              if( $key != ( count( $layers ) - 1 ) ){
                $id2.='&';
              }
            }
        }

        return response()->json(['imagename'=>$imagename,'init_imagename'=>$init_imagename]);

  }
    //return response()->json(['key'=>'val']);
    //product function
    //give me [product_id,layers&images_id,]
    //take['layers&images_id','product','init_imagename','layers',];

    //change image function
    //give me [last_pro[last layers and images ids],product_id,layer_andimageid,layer&imagesid,img_pos]
    //take[image];

}
