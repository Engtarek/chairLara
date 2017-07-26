<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductLayer;
use Yajra\Datatables\Facades\Datatables;

use App\ProductLayerImage;
use File;
use App\Images;
class LayerController extends Controller
{
  public function index(){
    return view('admin.product_layers.index');
  }
  //show add layer form
  public function create_layer($product_id){
    $images = Images::all();
    return view('admin.product_layers.create',compact('product_id','images'));
  }
  //save new layer in database
  public function store(Request $request){
    $this->validate($request,[
      'rank' => 'required|integer',
      'rankname_en' => 'required|max:255',
      'rankname_ar' => 'required|max:255',
    ]);
    $data =[
        'rank'=>$request->rank,
        'rankname_en'=>$request->rankname_en,
        'rankname_ar'=>$request->rankname_ar,

        'image'=>$request->image,
        'product_id'=>$request->product_id
      ];
    ProductLayer::create($data);
    return redirect()->route("product_layers.index")->with("success","The Layer created successfully");
  }
  //show form to delete&edit layer
  public function show($id){
    $layer = ProductLayer::find($id);
    $images = Images::all();
    return view('admin.product_layers.view',compact('layer','images'));
  }

  //edit exiting layer
  public function update(Request $request, $id)
  {
    $this->validate($request,[
      'rank'=>'required',
      'rankname_en'=>'required',
      'rankname_ar'=>'required',
    ]);
    $layer = ProductLayer::find($id);

    if(!empty($request->image)){
      $image_name = $request->image;
    }else{
      $image_name = $layer->image;
    }

    $data =[
      'rank'=>$request->rank,
      'rankname_en'=>$request->rankname_en,
        'rankname_ar'=>$request->rankname_ar,
      'image'=>$image_name,
      'product_id'=>$layer->product_id
    ];

    $layer->update($data);
    return redirect()->route("product_layers.show",$id)->with("success","The Layer updated successfully");
  }

  //delete layer
  public function destroy($id){
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
      return redirect()->route("product_layers.index")->with("success","The Layer deleted successfully");

  }
  //add layer image
  public function add_image($id){
    $images = Images::all();
    return view('admin.product_layers.add_image',compact('id','images'));
  }
  //save layer image
  public function save_image(Request $request){

    $this->validate($request,[
      'image' => 'required',
      'color' => 'required',
      'item_name_en' => 'required',
      'item_name_ar' => 'required',
      'item_distributer_name_en' => 'required',
      'item_distributer_name_ar' => 'required',
      'item_price' => 'required',
    ]);
     $product_id = ProductLayer::find($request->layer_id)->product_id;
     $data =[
       'image'=>$request->image,
       'color'=>$request->color,
       'item_name_en'=>$request->item_name_en,
       'item_name_ar'=>$request->item_name_ar,
       'item_distributer_name_en'=>$request->item_distributer_name_en,
       'item_distributer_name_ar'=>$request->item_distributer_name_ar,
       'item_price'=>$request->item_price,
       'product_layers_id'=>$request->layer_id,
     ];
    ProductLayerImage::create($data);
    return redirect('admin/layer_images')->with("success","The Layer image added successfully");

  }
  //datatables
  public function data(){
    $layer = ProductLayer::all();
    return DataTables::of($layer)

    ->editColumn('product_id',function($model){
        return product()[$model->product_id];
     })
     ->editColumn('rankname_en',function($model){
        return $model->rankname_en;
     })
     ->editColumn('rankname_ar',function($model){
        return $model->rankname_ar;
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
