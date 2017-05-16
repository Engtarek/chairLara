<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

use App\ProductLayerImage;
use App\ProductLayer;

class LayerImageController extends Controller
{
  public function index(){
    return view('admin.layer_images.index');
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
     ->rawColumns(['layer_image','layer_color', 'confirmed'])
    ->make(true);
  }
}
