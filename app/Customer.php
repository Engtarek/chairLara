<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable=['name','email','phone','country','city','address','lat','lng'];

    public function orders(){
      return $this->hasMany('App\Order');
    }

}
