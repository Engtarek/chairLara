<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable=['first_name','last_name','email','Company','address1','address2','city','zip','country','state','phone','lat','lng'];

    public function orders(){
      return $this->hasMany('App\Order');
    }

}
