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
        $layers_arr =[];
        $images_arr = [];
        foreach ($layers as $key => $layer) {
          foreach ($layer->images as $key => $image) {
            $array_1=[
              'id'=>$image->id,
              'image'=>$image->get_image->name,
              'color'=>$image->get_color->name,
              'item_name_en'=>$image->item_name_en,
              'item_name_ar'=>$image->item_name_ar,
              'item_distributer_name_en'=>$image->item_distributer_name_en,
              'item_distributer_name_ar'=>$image->item_distributer_name_ar,
              'item_price'=>$image->item_price,
              'product_layers_id'=>$image->product_layers_id,
            ];
            array_push($images_arr,$array_1);
          }
          $array_2=[
            'id'=>$layer->id,
            'rank'=>$layer->rank,
            'rankname_en'=>$layer->rankname_en,
            'rankname_ar'=>$layer->rankname_ar,
            'image'=>$layer->image,
            'product_id'=>$layer->product_id,
            'images'=>$images_arr
          ];
            array_push($layers_arr,$array_2);
            $images_arr = [];
        }

        return response()->json(['imagename'=>$imagename,'init_imagename'=>$init_imagename,'product'=>$product,'layers'=>$layers_arr]);

  }
    //return response()->json(['key'=>'val']);
    //product function
    //give me [product_id,layers&images_id,]
    //take['layers&images_id','product','init_imagename','layers',];

    //change image function
    //give me [last_pro[last layers and images ids],product_id,layer_andimageid,layer&imagesid,img_pos]
    //take[image];

}
