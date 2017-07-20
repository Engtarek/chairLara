<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

use App\ProductLayerImage;
use App\ProductLayer;
use File;
use App\Images;
class LayerImageController extends Controller
{
  public function index(){
    return view('admin.layer_images.index');
  }
  // show form to edit or delete the layer
  public function show($id){
    $images = Images::all();
    $image = ProductLayerImage::find($id);
    $product_id = ProductLayer::find($image->product_layers_id)->product_id;
    return view('admin.layer_images.view',compact('image','product_id','images'));
  }

  //update the exiting image
  public function update($id,Request $request){

    $image_layer = ProductLayerImage::find($id);
    if(!empty($request->image)){
       $image_name =$request->image;
       
     }else{
       $image_name = $image_layer->image;
     }

     if(!empty($request->color)){
       $color_name =$request->color;
      }else{
        $color_name = $image_layer->color;
      }

       $image_layer->image = $image_name;
       $image_layer->color = $color_name;
       $image_layer->item_name = $request->item_name;
       $image_layer->item_distributer_name = $request->item_distributer_name;
       $image_layer->item_price = $request->item_price;
       $image_layer->product_layers_id =$request->product_layers_id ;
       $image_layer->save();
    return redirect()->route("layer_images.show",$id)->with("success","The  image updated successfully");

  }

  //delete image
  public function destroy($id){
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
      return redirect()->route("layer_images.index")->with("success","The image deleted successfully");

  }
  //datatables
  public function data(){
    $layer = ProductLayerImage::all();
    return DataTables::of($layer)
    ->editColumn('product',function($model){
        return product()[ProductLayer::find($model->product_layers_id)->product_id];
     })
    ->editColumn('layer_name',function($model){
      return   ProductLayer::find($model->product_layers_id)->rankname;
     })
     ->editColumn('layer_image',function($model){
          return "<img style='width:150px' src='/images/sub_".$model->get_image->name."'>";
     })
     ->editColumn('layer_color',function($model){
          return "<img style='width:50px' src='/images/sub_".$model->get_color->name."'>";
     })
     ->editColumn('item_name',function($model){
          return $model->item_name;
     })
     ->editColumn('item_dist',function($model){
          return $model->item_distributer_name;
     })
     ->editColumn('item_price',function($model){
          return $model->item_price;
     })
     ->editColumn('view',function($model){
       return \Html::link('/admin/layer_images/'.$model->id,'view');
     })
     ->rawColumns(['layer_image','layer_color', 'confirmed'])
    ->make(true);
  }
}
