<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLayer extends Model
{
  protected $fillable = ['rank','rankname_en','rankname_ar','image','product_id'];
  public function product()
  {
     return $this->belongsTo('App\Product');
  }
  public function Images()
  {
      return $this->hasMany('App\ProductLayerImage','product_layers_id');
  }

  public function layer_image(){
        return $this->hasOne(Images::class, 'id','image');
  }
}
