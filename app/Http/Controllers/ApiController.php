<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Cache;
use App\Images;
use Image;
use File;
use App\ProductLayer;
use App\ProductLayerImage;

class ApiController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:api');
  }

  //get all products
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
  //get product data
  public function get_product(Request $request,$id,$id2=""){
    $product = Product::find($id);
    $layers = $product->layers()->orderBy('rank','asc')->get();
    $imagename = "";
    $init_imagename =$request->root().'/images/';

      if(!empty($id2)){
        $imagename = $request->root().'/products/'.$id.'/history/'.$id;
          foreach(explode("&",$id2)as $data){
            foreach (explode(".",$data) as $value) {
              $imagename .=$value;
            }
          }
          $imagename .=".png";
        }else{
          $init_imagename .= $product->product_init_image->name;
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
              'image'=>$request->root().'/images/'.$image->get_image->name,
              'color'=>$request->root().'/images/'.$image->get_color->name,
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
            'image'=>$request->root().'/images/'.$layer->image,
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
      //return $imagename;
        return response()->json(['sm_imagename'=>$request->root()."/products/".$request->product_id."/small_image/".$imagename.".jpg",'imagename'=>$request->root()."/products/".$request->product_id."/history/".$imagename.".png"]);

    }elseif(Cache::get($imagename) && file_exists("products/".$request->product_id."/history/".$imagename.".png")){
      cutImage('products/'.$request->product_id.'/history/' .$imagename.'.png',$request->img_pos,$request->product_id,$imagename);
      // return  Cache::get($imagename);
         return response()->json(['sm_imagename'=>$request->root()."/products/".$request->product_id."/small_image/".Cache::get($imagename).".jpg",'imagename'=>$request->root()."/products/".$request->product_id."/history/".Cache::get($imagename).".png"]);

    }elseif(!Cache::get($imagename) && file_exists("products/".$request->product_id."/history/".$imagename.".png")){
        cutImage('products/'.$request->product_id.'/history/' .$imagename.'.png',$request->img_pos,$request->product_id,$imagename);
       Cache::forever($imagename, $imagename);
       //return $imagename;
         return response()->json(['sm_imagename'=>$request->root()."/products/".$request->product_id."/small_image/".$imagename.".jpg",'imagename'=>$request->root()."/products/".$request->product_id."/history/".$imagename.".png"]);
    }elseif(Cache::get($imagename) && !file_exists("products/".$request->product_id."/history/".$imagename.".png")){
      Cache::forget($imagename);
      createImage($request->product_id,$request->last_pro,$request->layer_id,$imagename,$request->img_pos);

      Cache::forever($imagename, $imagename);
      return response()->json(['sm_imagename'=>$request->root()."/products/".$request->product_id."/small_image/".$imagename.".jpg",'imagename'=>$request->root()."/products/".$request->product_id."/history/".$imagename.".png"]);
      //return $imagename;
    }
  }

  public function save_product(Request $request ){
    $image = $request->file('image');
   $array = explode('.', $image->getClientOriginalName());
   $imageName =$array[0]."_".rand().".".$array[1];
   //create submnails
   $img = Image::make($image->getRealPath());
    $img->resize(150, 150, function ($constraint) {
       $constraint->aspectRatio();
    })->save(public_path('images').'/'."sub_".$imageName);
    //create image
   $image->move(public_path('images'),$imageName);

   $image_id = Images::create(array('name'=>$imageName))->id;

   //color
   $init_image = $request->file('init_image');
   $array2 = explode('.', $init_image->getClientOriginalName());
   $init_image_name =$array2[0]."_".rand().".".$array2[1];
   //create submnails
   $init = Image::make($init_image->getRealPath());
    $init->resize(150, 150, function ($constraint) {
       $constraint->aspectRatio();
    })->save(public_path('images').'/'."sub_".$init_image_name);
    //create image
   $init_image->move(public_path('images'),$init_image_name);

   $init_image_id = Images::create(array('name'=>$init_image_name))->id;


    $data = array(
      'name_en'=>$request->post_title,
      'name_ar'=>$request->post_title_ar,
      'image'=>$image_id,
      'show'=>1,
      'init_image'=>$init_image_id,
      'wooCommerce_product_id'=>$request->wooCommerce_product_id,
    );

    $product = Product::create($data);
return response()->json(['msg'=>'success']);
  }

  public function get_woo_product(){
    $products = Product::where('wooCommerce_product_id','!=',0)->get();
    return response()->json(['products'=>$products]);
  }
  public function save_layer(Request $request ){

    $data =[
        'rank'=>$request->rank,
        'rankname_en'=>$request->rankname_en,
        'rankname_ar'=>$request->rankname_ar,
        'product_id'=>$request->product_id
      ];
    ProductLayer::create($data);
return response()->json(['msg'=>'success']);
  }
  public function get_woo_layer(){
    $products = Product::where('wooCommerce_product_id','!=',0)->get();
    $layers=[];
    foreach ($products as $value) {
      foreach ($value->layers as $key => $data) {
        $array = array(
            "id"=> $data->id,
            "rank"=> $data->rank,
            "rankname_en"=> $data->rankname_en,
            "rankname_ar"=>$data->rankname_ar ,
            "product_id"=> $data->product_id,
        );
        array_push($layers,$array);
      }
    }
return response()->json($layers);
  }

  public function save_image(Request $request){

     $image = $request->file('image');
    $array = explode('.', $image->getClientOriginalName());
    $imageName =$array[0]."_".rand().".".$array[1];
    //create submnails
    $img = Image::make($image->getRealPath());
     $img->resize(150, 150, function ($constraint) {
        $constraint->aspectRatio();
     })->save(public_path('images').'/'."sub_".$imageName);
     //create image
    $image->move(public_path('images'),$imageName);

    $image_id = Images::create(array('name'=>$imageName))->id;

    //color
    $color = $request->file('color');
    $array2 = explode('.', $color->getClientOriginalName());
    $colorName =$array2[0]."_".rand().".".$array2[1];
    //create submnails
    $col = Image::make($color->getRealPath());
     $col->resize(150, 150, function ($constraint) {
        $constraint->aspectRatio();
     })->save(public_path('images').'/'."sub_".$colorName);
     //create image
    $color->move(public_path('images'),$colorName);

    $color_id = Images::create(array('name'=>$colorName))->id;

    $data =[
      'image'=>$image_id,
      'color'=>$color_id,
      'item_name_en'=>$request->item_en,
      'item_name_ar'=>$request->item_ar,
      'item_distributer_name_en'=>$request->details_en,
      'item_distributer_name_ar'=>$request->details_ar,
      'item_price'=>$request->price,
      'product_layers_id'=>$request->product_layers_id,
    ];
   ProductLayerImage::create($data);
   return response()->json(['msg'=>'success']);
  }

}
