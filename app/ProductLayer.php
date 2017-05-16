<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLayer extends Model
{
  public function product()
  {
     return $this->belongsTo('App\Product');
  }
  public function Images()
  {
      return $this->hasMany('App\ProductLayerImage','product_layers_id');
  }
}
