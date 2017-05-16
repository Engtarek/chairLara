<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductLayerImage extends Model
{
  public function productlayer()
  {
     return $this->belongsTo('App\ProductLayer','product_layers_id');
  }
}
