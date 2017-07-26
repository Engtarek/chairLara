<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLayerImage extends Model
{
  protected $fillable = ['image','color','item_name_en','item_name_ar','item_distributer_name_en','item_distributer_name_ar','item_price','product_layers_id'];
  public function productlayer()
  {
     return $this->belongsTo('App\ProductLayer','product_layers_id');
  }
  public function get_image(){
        return $this->hasOne(Images::class, 'id','image');
  }
  public function get_color(){
        return $this->hasOne(Images::class, 'id','color');
  }

}
