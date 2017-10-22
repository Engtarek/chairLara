<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = ['name_en','name_ar','image','show','init_image','wooCommerce_product_id','uuid','is_wooCommerce_product','price','user_id'];

  public function layers(){
      return $this->hasMany('App\ProductLayer');
  }

  public function product_image(){
        return $this->hasOne(Images::class, 'id','image');
  }

  public function product_init_image(){
        return $this->hasOne(Images::class,'id', 'init_image');
  }

  public function user(){
        return $this->belongsTo('App\User');
  }
}
