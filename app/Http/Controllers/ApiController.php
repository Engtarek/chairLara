<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Cache;

class ApiController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api');
  }

  public function get_all_product(Request $request){
    $products = [];
    foreach(Product::all() as $product){
      $array =[
        "id"=>$product->id,
        "name_en"=>$product->name_en,
        "name_ar"=>$product->name_ar,
        "image"=>$request->root().'/images/'.$product->product_image->name,
        "init_image"=>$request->root().'/images/'.$product->product_init_image->name,
        "show"=>$product->show,
      ];
      array_push($products,$array);

    }
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

        return response()->json(['imagename'=>$imagename,'init_imagename'=>$init_imagename,'product'=>$product,'layers'=>$layers_arr,'id2'=>$id2]);

  }

  //change image
  public function change_image(Request $request){
    //

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
      return response()->json(['imagename'=>$imagename]);
      //return $imagename;
    }
  }

  public function test(){
    return response()->json(['key'=>'val'])->withHeaders(['Access-Control-Allow-Origin'=>'*'
            ]);
  }
    //return response()->json(['key'=>'val']);
    //product function
    //give me [product_id,layers&images_id,]
    //take['layers&images_id','product','init_imagename','layers',];

    //change image function
    //give me [last_pro[last layers and images ids],product_id,layer_andimageid,layer&imagesid,img_pos]
    //take[image];

}
