<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = ['name','image','show','init_image'];

  public function layers(){
      return $this->hasMany('App\ProductLayer');
  }
}
