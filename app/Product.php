<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = ['name','image','show','init_image'];

  public function layers(){
      return $this->hasMany('App\ProductLayer');
  }

  public function product_image(){
        return $this->hasOne(Images::class, 'id','image');
  }

  public function product_init_image(){
        return $this->hasOne(Images::class,'id', 'init_image');
  }

}
