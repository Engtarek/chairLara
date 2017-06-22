<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

use App\ProductLayerImage;
use App\ProductLayer;
use File;

class LayerImageController extends Controller
{
  public function index(){
    return view('admin.layer_images.index');
  }
  // show form to edit or delete the layer
  public function show($id){
    $image = ProductLayerImage::find($id);
    $product_id = ProductLayer::find($image->product_layers_id)->product_id;
    return view('admin.layer_images.view',compact('image','product_id'));
  }

  //update the exiting image
  public function update($id,Request $request){
    $image_layer = ProductLayerImage::find($id);
    $product_id = ProductLayer::find($image_layer->product_layers_id)->product_id;
    $new_product_id = ProductLayer::find($request->product_layers_id)->product_id;
    $image = $request->file('image');
    $color = $request->file('color');
    $name = time().rand();
    if($product_id != $new_product_id){
      if($image){
        File::delete(public_path('products/'.$product_id.'/image/'.$image_layer->image));
        $image_name =$name.'.'.$image->getClientOriginalExtension();
        $image->move('products/'.$new_product_id.'/image', $image_name);
     }else{
       copy('products/'.$product_id.'/image/'.$image_layer->image,'products/'.$new_product_id.'/image/'.$image_layer->image);
      File::delete(public_path('products/'.$product_id.'/image/'.$image_layer->image));
         $image_name = $image_layer->image;
     }
      if($color){
           File::delete(public_path('products/'.$product_id.'/color/'.$image_layer->color));
        $color_name =$name.'.'.$color->getClientOriginalExtension();
        $color->move('products/'.$new_product_id.'/color', $color_name);
      }else{
        copy('products/'.$product_id.'/color/'.$image_layer->color,'products/'.$new_product_id.'/color/'.$image_layer->color);
        File::delete(public_path('products/'.$product_id.'/color/'.$image_layer->color));

    $color_name = $image_layer->color;

      }
    }else{
      if($image){
        File::delete(public_path('products/'.$product_id.'/image/'.$image_layer->image));
        $image_name =$name.'.'.$image->getClientOriginalExtension();
        $image->move('products/'.$product_id.'/image', $image_name);
     }else{
          $image_name = $image_layer->image;
     }
      if($color){
           File::delete(public_path('products/'.$product_id.'/color/'.$image_layer->color));

        $color_name =$name.'.'.$color->getClientOriginalExtension();
        $color->move('products/'.$product_id.'/color', $color_name);
      }else{
        $color_name = $image_layer->color;
      }
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
    $image = ProductLayerImage::find($id);
    $product_id = ProductLayer::find($image->product_layers_id)->product_id;
    if(!empty($image->image)){
       File::delete(public_path('products/'.$product_id.'/image/'.$image->image));
    }
     if(!empty($image->color)){
        File::delete(public_path('products/'.$product_id.'/color/'.$image->color));
     }
     $image->delete();
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
          return "<img style='width:150px' src='/products/".ProductLayer::find($model->product_layers_id)->product_id."/image/".$model->image."'>";
     })
     ->editColumn('layer_color',function($model){
          return "<img style='width:50px' src='/products/".ProductLayer::find($model->product_layers_id)->product_id."/color/".$model->color."'>";
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
