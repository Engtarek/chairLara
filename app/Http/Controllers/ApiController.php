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

  /*
    ** start api for products
  */
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
        'wooCommerce_product_id'=>$product->wooCommerce_product_id
      ];
      array_push($products,$array);

    }
    return response()->json(['products'=>$products]);
  }
  //show one product
  public function show_pro($id , Request $request){
    $product = Product::find($id);
    $product_arr =[
      'id'=>$product->id,
      'image'=>$request->root().'/images/'.$product->product_image->name,
      'init_image'=>$request->root().'/images/'.$product->product_init_image->name,
      'name_ar'=>$product->name_ar,
      'name_en'=>$product->name_en,
      'show'=>1,
      'wooCommerce_product_id'=>$product->wooCommerce_product_id
    ];
    return response()->json($product_arr);
  }
  //add new product
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
    $product_arr =[
      'id'=>$product->id,
      'image'=>$request->root().'/images/'.$product->product_image->name,
      'init_image'=>$request->root().'/images/'.$product->product_init_image->name,
      'name_ar'=>$product->name_ar,
      'name_en'=>$product->name_en,
      'show'=>1,
      'wooCommerce_product_id'=>$product->wooCommerce_product_id
    ];

    return response()->json($product_arr);
  }
  //update product
  public function update_product(Request $request){
     $product = Product::find($request->product_id);
    if(empty($request->image)){
      $image_name = $product->image;
    }else{
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

      $image_name = Images::create(array('name'=>$imageName))->id;
    }
    if($request->init_image == ""){
       $init_image_name = $product->init_image;
    }else{

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

       $init_image_name = Images::create(array('name'=>$init_image_name))->id;
    }
    $data = array(
      'name_en'=>$request->post_title,
      'name_ar'=>$request->post_title_ar,
      'image'=>$image_name,
      'show'=>'1',
      'init_image'=>$init_image_name,
      'wooCommerce_product_id'=>$request->wooCommerce_product_id,
    );
    $product->update($data);
    $result = [
      'id'=>$product->id,
      'name_en'=>$product->name_en,
      'name_ar'=>$product->name_ar,
      'image'=>$request->root().'/images/'.$product->product_image->name,
      'show'=>'1',
      'init_image'=>$request->root().'/images/'.$product->product_init_image->name,
      'wooCommerce_product_id'=>$request->wooCommerce_product_id,
    ];
    return response()->json($result);
  }
  //delete product
  public function delete_product($id){
    $product = Product::find($id);
    $pro_image = Images::find($product->image);
    $pro_init_image = Images::find($product->init_image);
     foreach($product->layers as $layer){
       $layer_image = Images::find($layer->image);
         foreach($layer->images as $product_layer_image){
           $image = Images::find($product_layer_image->image);
           $color = Images::find($product_layer_image->color);
           if(count($image->product_images) == 0 && count($image->product_init_images) == 0 &&
               count($image->layer_images) == 0 && count($image->images_color) ==0 && count($image->images_image) == 1){
               File::delete(public_path('images/'.$image->name));
               File::delete(public_path('images/sub_'.$image->name));
               $image->delete();
           }
           if(count($color->product_images) == 0 && count($color->product_init_images) == 0 &&
               count($color->layer_images) == 0 && count($color->images_image) ==0 && count($color->images_color) == 1){
               File::delete(public_path('images/'.$color->name));
               File::delete(public_path('images/sub_'.$color->name));
               $color->delete();
           }
           $product_layer_image->delete();
         }
         if(!empty($layer_image)){
           if(count($layer_image->product_images) == 0 && count($layer_image->product_init_images) == 0 &&
               count($layer_image->layer_images) == 1 && count($layer_image->images_color) ==0 && count($layer_image->images_image) == 0){
               File::delete(public_path('images/'.$layer_image->name));
               File::delete(public_path('images/sub_'.$layer_image->name));
               $layer_image->delete();
           }
         }
        $layer->delete();
     }
     if(count($pro_image->product_images) == 1 && count($pro_image->product_init_images) == 0 &&
         count($pro_image->layer_images) == 0 && count($pro_image->images_color) ==0 && count($pro_image->images_image) == 0){
         File::delete(public_path('images/'.$pro_image->name));
         File::delete(public_path('images/sub_'.$pro_image->name));
         $pro_image->delete();
     }
     if(count($pro_init_image->product_images) == 0 && count($pro_init_image->product_init_images) == 1 &&
         count($pro_init_image->layer_images) == 0 && count($pro_init_image->images_image) ==0 && count($pro_init_image->images_color) == 0){
         File::delete(public_path('images/'.$pro_init_image->name));
         File::delete(public_path('images/sub_'.$pro_init_image->name));
         $pro_init_image->delete();
     }
   File::deleteDirectory(public_path('products/'.$id));
    $product->delete();
     return response()->json(['msg'=>'success']);
  }
  /*
    ** start api for layers
  */
  //get all layers
    public function get_woo_layer(){
      $products = Product::all();
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
    //add new layer
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
    //get one layer data
    public function show_layer($id){
      $layer = ProductLayer::find($id);
       return response()->json($layer);
    }
    //update layer
    public function update_layer(Request $request){
      $layer = ProductLayer::find($request->layer_id);
      $data =[
        'rank'=>$request->rank,
        'rankname_en'=>$request->rankname_en,
          'rankname_ar'=>$request->rankname_ar,
        //'image'=>'$image_name',
        'product_id'=>$layer->product_id
      ];
      $layer->update($data);
       return response()->json($layer);
    }
    //delete layer
    public function delete_layer($id){
      $layer = ProductLayer::find($id);
      $layer_image = Images::find($layer->image);
     foreach($layer->images as $product_layer_image){
       $image = Images::find($product_layer_image->image);
       $color = Images::find($product_layer_image->color);
       if(count($image->product_images) == 0 && count($image->product_init_images) == 0 &&
           count($image->layer_images) == 0 && count($image->images_color) ==0 && count($image->images_image) == 1){
           File::delete(public_path('images/'.$image->name));
           File::delete(public_path('images/sub_'.$image->name));
           $image->delete();
       }
       if(count($color->product_images) == 0 && count($color->product_init_images) == 0 &&
           count($color->layer_images) == 0 && count($color->images_image) ==0 && count($color->images_color) == 1){
           File::delete(public_path('images/'.$color->name));
           File::delete(public_path('images/sub_'.$color->name));
           $color->delete();
       }
       $product_layer_image->delete();
     }
     if(!empty($layer_image)){
       if(count($layer_image->product_images) == 0 && count($layer_image->product_init_images) == 0 &&
           count($layer_image->layer_images) == 1 && count($layer_image->images_color) ==0 && count($layer_image->images_image) == 0){
           File::delete(public_path('images/'.$layer_image->name));
           File::delete(public_path('images/sub_'.$layer_image->name));
           $layer_image->delete();
       }
     }
     $layer->delete();
     return response()->json('success');
    }

  /*
    ** start api for images
  */
  //get all images
  public function get_image(Request $request){
    $images = [];
    foreach (ProductLayerImage::all() as $key => $value) {
      $array = [
        "id"=>$value->id,
        "image"=>$request->root().'/images/'.$value->get_image->name,
        "color"=>$request->root().'/images/'.$value->get_color->name,
        "item_name_en"=>$value->item_name_en,
        "item_name_ar"=>$value->item_name_ar,
        "item_distributer_name_en"=>$value->item_distributer_name_en,
        "item_distributer_name_ar"=>$value->item_distributer_name_ar,
        "item_price"=>$value->item_price,
        "product_layers_id"=>$value->productlayer->rankname_en
      ];

      array_push($images,$array);
    }
    return response()->json($images);
  }
  //save new image
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
  //show one image
  public function show_image($id,Request $request){
    $image = ProductLayerImage::find($id);
    $image_arr =[
      "id"=>$image->id,
      "image"=>$request->root().'/images/'.$image->get_image->name,
      "color"=>$request->root().'/images/'.$image->get_color->name,
      "item_name_en"=>$image->item_name_en,
      "item_name_ar"=>$image->item_name_ar,
      "item_distributer_name_en"=>$image->item_distributer_name_en,
      "item_distributer_name_ar"=>$image->item_distributer_name_ar,
      "item_price"=>$image->item_price,
      "product_layers_id"=>$image->product_layers_id
    ];
    return response()->json($image_arr);

  }
  //update image
  public function update_image(Request $request){
    $image_layer = ProductLayerImage::find($request->image_id);

    if(!empty($request->image)){
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

       $image_name = Images::create(array('name'=>$imageName))->id;

     }else{
       $image_name = $image_layer->image;
     }
     if(!empty($request->color)){
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

       $color_name = Images::create(array('name'=>$colorName))->id;

      }else{
        $color_name = $image_layer->color;
      }
      $image_layer->image = $image_name;
      $image_layer->color = $color_name;
      $image_layer->item_name_en = $request->item_en;
      $image_layer->item_name_ar = $request->item_ar;
      $image_layer->item_distributer_name_en = $request->details_en;
      $image_layer->item_distributer_name_ar = $request->details_ar;
      $image_layer->item_price = $request->price;
      $image_layer->product_layers_id =$request->product_layers_id ;
      $image_layer->save();
      $res = [
        'id'=>$image_layer->id,
        'image'=>$request->root().'/images/'.$image_layer->get_image->name,
        'color'=>$request->root().'/images/'.$image_layer->get_color->name,
        'item_name_ar'=>$image_layer->item_name_ar,
        'item_name_en'=>$image_layer->item_name_en,
        'item_distributer_name_ar'=>$image_layer->item_distributer_name_ar,
        'item_distributer_name_en'=>$image_layer->item_distributer_name_en,
        'item_price'=>$image_layer->item_price,
        'product_layers_id'=>$image_layer->product_layers_id,
      ];
      return $res;

      return response()->json($image_layer->id);
  }
  //delete image
  public function delete_image($id){
    $product_layer_image = ProductLayerImage::find($id);
    $image = Images::find($product_layer_image->image);
    $color = Images::find($product_layer_image->color);

    if(count($image->product_images) == 0 && count($image->product_init_images) == 0 &&
        count($image->layer_images) == 0 && count($image->images_color) ==0 && count($image->images_image) == 1){
        File::delete(public_path('images/'.$image->name));
        File::delete(public_path('images/sub_'.$image->name));
        $image->delete();
    }

    if(count($color->product_images) == 0 && count($color->product_init_images) == 0 &&
        count($color->layer_images) == 0 && count($color->images_image) ==0 && count($color->images_color) == 1){
        File::delete(public_path('images/'.$color->name));
        File::delete(public_path('images/sub_'.$color->name));
        $color->delete();
    }
    $product_layer_image->delete();
    return response()->json('success');
  }

}
