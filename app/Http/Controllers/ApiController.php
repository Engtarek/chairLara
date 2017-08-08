<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ApiController extends Controller
{
  public function products(){
    $products = Product::all();
    return response()->json(['products'=>$products]);
  }
    //return response()->json(['key'=>'val']);
    //product function
    //give me [product_id,layers&images_id,]
    //take['layers&images_id','product','init_imagename','layers',];

    //change image function
    //give me [last_pro[last layers and images ids],product_id,layer_andimageid,layer&imagesid,img_pos]
    //take[image];

}
