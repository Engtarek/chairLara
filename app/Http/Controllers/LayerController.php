<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductLayer;
use Yajra\Datatables\Facades\Datatables;

use App\ProductLayerImage;
use File;

class LayerController extends Controller
{
  public function index(){
    return view('admin.product_layers.index');
  }
  //show add layer form
  public function create_layer($product_id){
    return view('admin.product_layers.create',compact('product_id'));
  }
  //save new layer in database
  public function store(Request $request){
    $this->validate($request,[
      'rank' => 'required|integer',
      'rankname' => 'required|max:255',
    ]);

    $Product_layer= new ProductLayer;
    $Product_layer->rank= $request->rank;
    $Product_layer->rankname= $request->rankname;
    $Product_layer->product_id=  $request->product_id;
    $Product_layer->save();

   return redirect()->route("product_layers.index")->with("success","The Layer created successfully");
  }
  //show form to delete&edit layer
  public function show($id){
    $layer = ProductLayer::find($id);
    return view('admin.product_layers.view',compact('layer'));
  }

  //edit exiting layer
  public function update(Request $request, $id)
  {
    $this->validate($request,[
      'rank'=>'required',
      'rankname'=>'required',
    ]);
    $layer = ProductLayer::find($id);
    $layer->rank = $request->rank;
    $layer->rankname = $request->rankname;
    $layer->save();
    return redirect()->route("product_layers.show",$id)->with("success","The Layer updated successfully");
  }

  //delete layer
  public function destroy($id){
      $layer = ProductLayer::find($id);

      foreach($layer->images as $image){
        File::delete(public_path('products/'.$layer->product_id.'/image/'.$image->image));
        File::delete(public_path('products/'.$layer->product_id.'/color/'.$image->color));
          $image->delete();
      }
      $layer->delete();
      return redirect()->route("product_layers.index")->with("success","The Layer deleted successfully");
  }
  //add layer image
  public function add_image($id){
    return view('admin.product_layers.add_image',compact('id'));
  }
  //save layer image
  public function save_image(Request $request){
     $product_id = ProductLayer::find($request->layer_id)->product_id;
     $image = $request->file('image');
     $color = $request->file('color');
     $name = time().rand();
    if($image){
    $image_name =$name.'.'.$image->getClientOriginalExtension();
      $image->move('products/'.$product_id.'/image', $image_name);
    }
    if($color){
      $color_name =$name.'.'.$color->getClientOriginalExtension();
      $color->move('products/'.$product_id.'/color', $color_name);
    }
    $layer_image = new ProductLayerImage;
    $layer_image->image = $image_name;
    $layer_image->color = $color_name;
    $layer_image->item_name = $request->item_name;
    $layer_image->item_distributer_name = $request->item_distributer_name;
    $layer_image->item_price = $request->item_price;
    $layer_image->product_layers_id = $request->layer_id;
    $layer_image->save();
    return redirect('admin/layer_images')->with("success","The Layer image added successfully");

  }
  //datatables
  public function data(){
    $layer = ProductLayer::all();
    return DataTables::of($layer)

    ->editColumn('product_id',function($model){
        return product()[$model->product_id];
     })
     ->editColumn('rankname',function($model){
        return $model->rankname;
     })
     ->editColumn('rank',function($model){
        return $model->rank;
     })
     ->editColumn('view',function($model){
           return \Html::link('/admin/product_layers/'.$model->id,'View');
     })
     ->editColumn('layer_image',function($model){
           return \Html::link('/admin/product_layers/addimages/'.$model->id,'Add image');
     })

    ->make(true);
  }
}
