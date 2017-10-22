<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Product;
use File;
use App\Images;
use Illuminate\Support\Facades\Cache;
use Auth;
class ProductController extends Controller
{
    //show all products
    public function index(){
      return view('admin.products.index');
    }

    //show add product form
    public function create(){
      $images = Images::all();
      return view('admin.products.create',compact('images'));
    }

    //save new product in database
    public function store(Request $request){
      $this->validate($request,[
        'name_en'=>'required|max:255',
        'name_ar'=>'required|max:255',
        'image'=>'required',
        'show'=>'required',
        'init_image'=>'required',
      ]);

      $data = array(
        'name_en'=>$request->name_en,
        'name_ar'=>$request->name_ar,
        'image'=>$request->image,
        'show'=>$request->show,
        'init_image'=>$request->init_image,
        'uuid'=>uniqid(),
        'price'=>0,
         'user_id'=>Auth::user()->id,
      );
      $product = Product::create($data);
      return redirect()->route("products.index")->with("success","The product created successfully");
    }

    //show form to delete&edit product
    public function show($id){
      $product = Product::find($id);
      $images = Images::all();
      return view('admin.products.view',compact('product','images'));
    }
    //edit exiting product
    public function update(Request $request, $id){
      $product = Product::find($id);
      if($request->image == ""){
        $image_name = $product->image;
      }else{
        $image_name = $request->image;
      }
      if($request->init_image == ""){
      $init_image_name = $product->init_image;
      }else{
        File::deleteDirectory(public_path('products/'.$id));
        Cache::flush();
        $init_image_name = $request->init_image;
      }
      $data = array(
        'name_en'=>$request->name_en,
        'name_ar'=>$request->name_ar,
        'image'=>$image_name,
        'show'=>$request->show,
        'init_image'=>$init_image_name,
      );
      $product->update($data);
       return redirect()->route("products.show",$id)->with("success","The product updated successfully");
    }

    //delete product
    public function destroy($id){
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
        return redirect()->route("products.index")->with("success","The Product deleted successfully");
    }

    //datatables
    public function data(){
      $product = Product::all();
      return DataTables::of($product)
      ->editColumn('name_en',function($model){
        return $model->name_en;
      })
      ->editColumn('name_ar',function($model){
        return $model->name_ar;
      })
      ->editColumn('view',function($model){
         return \Html::link('/admin/products/'.$model->id,'View');
      })
      ->editColumn('add_layer',function($model){
         return \Html::link('/admin/product_layers/create/'.$model->id,'Add layers');
      })

      ->make(true);
    }

    public function delete_cache($id){
        Cache::flush();
        return redirect()->route("products.show",$id)->with("success","The cache deleted successfully");
    }
}
