<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Images;
use Image;
use File;
use App\Product;
use App\ProductLayer;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('home');
    }

    public function dropzone(){
       $images = Images::all();
         return view('admin.dropzone-view',compact('images'));
     }

     /**
      * Image Upload Code
      *
      * @return void
      */
     public function dropzoneStore(Request $request){
         $image = $request->file('file');
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
         return response()->json(['name'=>$imageName,'id'=>$image_id]);
     }
     public function dropzoneDelete(Request $request){
       $image = Images::find($request->image_id);
       $products =[];

       if(count($image->product_images) == 0 && count($image->product_init_images) == 0 &&
           count($image->layer_images) == 0 && count($image->images_color) ==0 && count($image->images_image) == 0){
             File::delete(public_path('images/'.$image->name));
             File::delete(public_path('images/sub_'.$image->name));
             $image->delete();
             return array('key'=>"delete",'product'=>$request->image_id);
           }else{
             if(count($image->product_images) != 0){
               foreach ($image->product_images as $product_image) {
                 array_push($products, $product_image->name);
               }
             }
             if(count($image->product_init_images) != 0){
               foreach ($image->product_init_images as $product_init_image) {
                 array_push($products, $product_init_image->name);
               }
             }
             if(count($image->layer_images) != 0){
               foreach ($image->layer_images as $layer_image) {
                 array_push($products, Product::find($layer_image->product_id)->name);
               }
             }
             if(count($image->images_color) !=0){
               foreach ($image->images_color as $color) {
                 array_push($products,ProductLayer::find($color->product_layers_id)->product->name);
               }

             }
             if(count($image->images_image) != 0){
               foreach ($image->images_image as $image) {
                 array_push($products,ProductLayer::find($image->product_layers_id)->product->name);
               }
             }
             $array = array_unique($products);
              return array('key'=>"not_delete",'product'=>$array);
           }

     }

}
