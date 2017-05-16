<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public static function addProduct($name){
      $product = new Product;
      $product->name = $name;
      $product->save();
    }
  public static function editProduct($id,$name){
    $product = Product::find($id);
    $product->name = $name;
    $product->save();
  }

  public function layers()
  {
      return $this->hasMany('App\ProductLayer');
  }
}
