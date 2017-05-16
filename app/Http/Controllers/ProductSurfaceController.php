<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Yajra\Datatables\Facades\Datatables;
use App\ProductSurface;
use App\Product;
use App\ProductSurfaceImages;
use File;

class ProductSurfaceController extends Controller
{
      //show all products
      public function index(){
        return view('admin.products_surface.index');
      }
      //show add product form
      public function create(){
        return view('admin.products_surface.create');
      }
      //save new product in database
      public function store(Request $request){
        $this->validate($request,[
          // 'image'=>'required',
          // 'color'=>'required',
          'rank' => 'required',
          'product_id' => 'required',
        ]);
        $product_id = $request->product_id;
        $rank = $request->rank;
        $rankname = $request->rankname;
        //  $image = $request->file('image');
        //  $color = $request->file('color');
        //  $name = time().rand();
        // if($image){
        // $image_name =$name.'.'.$image->getClientOriginalExtension();
        //   $image->move('products/'.$product_id.'/image', $image_name);
        // }
        // if($color){
        //   $color_name =$name.'.'.$color->getClientOriginalExtension();
        //   $color->move('products/'.$product_id.'/color', $color_name);
        // }
        $Product_surface= new ProductSurface;
        $Product_surface->rank= $rank;
        $Product_surface->rankname= $rankname;
        $Product_surface->product_id= $product_id;
        $Product_surface->save();

        // $surface_image = new ProductSurfaceImages;
        // $surface_image->image = $image_name;
        // $surface_image->color = $color_name;
        // $surface_image->product_surfaces_id = $Product_surface->id;
        // $surface_image->save();
       return redirect()->route("products_surface.index")->with("success","The product created successfully");
      }

      //show form to delete&edit product
      public function show($id)
      {
        $product = ProductSurface::find($id);
        return view('admin.products_surface.view',compact('product'));
      }

      //delete product
      public function destroy($id)
      {
          $product = ProductSurface::find($id);
          // if(!empty($product->image)){
          //      File::delete(public_path('products/'.$product->product_id.'/f/image/'.$product->image));
          // }
          // if(!empty($product->color)){
          //      File::delete(public_path('products/'.$product->product_id.'/f/color/'.$product->color));
          // }
          $product->delete();
          return redirect()->route("products_surface.index")->with("success","The Product deleted successfully");
      }

      //edit exiting product
      public function update(Request $request, $id)
      {
        $this->validate($request,[
          // 'image'=>'required',
          // 'color'=>'required',
          'product_id' => 'required',
        ]);
         $product = ProductSurface::find($id);

        //  $image = $request->file('image');
        //  $color = $request->file('color');
        //
        //  $name = time().rand();
        //
        // if($image){
        //     File::delete(public_path('products/'.$product->product_id.'/f/image/'.$product->image));
        //     $image_name =$name.'.'.$image->getClientOriginalExtension();
        //     $image->move('products/'.$product->product_id.'/f/image', $image_name);
        // }else{
        //   $image_name = $product->image;
        // }

        // if($color){
        //   File::delete(public_path('products/'.$product->product_id.'/f/color/'.$product->color));
        //   $color_name =$name.'.'.$color->getClientOriginalExtension();
        //   $color->move('products/'.$product->product_id.'/f/color', $color_name);
        // }else{
        //   $color_name = $product->color;
        // }
        // $product->image = $image_name;
        // $product->color = $color_name;
        $product->product_id= $product->product_id;
        $product->save();
        return redirect()->route("products_surface.show",$id)->with("success","The product updated successfully");

      }
        //datatables
      public function data(){
        $product = ProductSurface::all();
        return DataTables::of($product)

        // ->editColumn('image',function($model){
        //   return '<img class="img-responsive" style="width:150px;height:auto" src="/products/'.$model->product_id.'/image/'.$model->images.'">';
        // })
        // ->editColumn('color',function($model){
        //   return '<img class="img-responsive" style="width:50px;height:auto" src="/products/'.$model->product_id.'/color/'.$model->images.'">';
        // })
        ->editColumn('rank',function($model){
          return $model->rankname;
         })
         ->editColumn('product_id',function($model){
          return product()[$model->product_id];
         })
         ->editColumn('add',function($model){
           return \Html::link('/admin/products_surface/addimages/'.$model->id,'Add Images');
         })
        ->editColumn('view',function($model){
          return \Html::link('/admin/products_surface/'.$model->id,'view');
        })
        ->rawColumns(['image','color', 'confirmed'])
        // ->rawColumns(['color', 'confirmed'])
        ->make(true);
      }

      public function add_image($id){

        return view('admin.products_surface.add_image',compact('id'));

      }

      public function save_image(Request $request){
         $product_id = ProductSurface::find($request->sur_id)->product_id;
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
        $surface_image = new ProductSurfaceImages;
        $surface_image->image = $image_name;
        $surface_image->color = $color_name;
        $surface_image->product_surfaces_id = $request->sur_id;
        $surface_image->save();
      }
  }
