<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $fillable = ['name','image','show'];

  public function layers(){
      return $this->hasMany('App\ProductLayer');
  }
}
