<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use App\Product;
use File;

class ProductController extends Controller
{
    //show all products
    public function index(){
      return view('admin.products.index');
    }

    //show add product form
    public function create(){
      return view('admin.products.create');
    }

    //save new product in database
    public function store(Request $request){
      $this->validate($request,[
        'name'=>'required|max:255',
        'image'=>'required',
        'show'=>'required',
        'init_image'=>'required',
      ]);
      //image
      $image = $request->file('image');
      if($image){
        $image_name =rand().'.'.$image->getClientOriginalExtension();
      }
      //init_image
      $init_image = $request->file('init_image');
      if($init_image){
        $init_image_name ='init_image.'.$init_image->getClientOriginalExtension();
      }
      $data = array(
        'name'=>$request->name,
        'image'=>$image_name,
        'show'=>$request->show,
        'init_image'=>$init_image_name,
      );
      $product = Product::create($data);
      $image->move('products/'.$product->id, $image_name);
      $init_image->move('products/'.$product->id.'/history', $init_image_name);
      return redirect()->route("products.index")->with("success","The product created successfully");
    }

    //show form to delete&edit product
    public function show($id){
      $product = Product::find($id);
      return view('admin.products.view',compact('product'));
    }
    //edit exiting product
    public function update(Request $request, $id){
      $product = Product::find($id);
      $image = $request->file('image');
      $init_image = $request->file('init_image');
      //image
      if($image){
        File::delete(public_path('products/'.$product->id.'/'.$product->image));
        $image_name =rand().'.'.$image->getClientOriginalExtension();
        $image->move('products/'.$product->id, $image_name);
      }else{
         $image_name = $product->image;
      }
      //init_image
      if($init_image){
        File::delete(public_path('products/'.$product->id.'/history'.$product->init_image));
        $init_image_name ='init_image.'.$init_image->getClientOriginalExtension();
        $init_image->move('products/'.$product->id.'/history', $init_image_name);
      }else{
        $init_image_name = $product->init_image;
      }
      $data = array(
        'name'=>$request->name,
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
        foreach($product->layers as $layer){
          foreach($layer->images as $image){
            File::delete(public_path('products/'.$id.'/image/'.$image->image));
            File::delete(public_path('products/'.$id.'/color/'.$image->color));
            $image->delete();
          }
          $layer->delete();
        }
        File::deleteDirectory(public_path('products/'.$id));
        $product->delete();
        return redirect()->route("products.index")->with("success","The Product deleted successfully");
    }

    //datatables
    public function data(){
      $product = Product::all();
      return DataTables::of($product)
      ->editColumn('name',function($model){
        return $model->name;
      })
      ->editColumn('view',function($model){
         return \Html::link('/admin/products/'.$model->id,'View');
      })
      ->editColumn('add_layer',function($model){
         return \Html::link('/admin/product_layers/create/'.$model->id,'Add layers');
      })

      ->make(true);
    }
}
