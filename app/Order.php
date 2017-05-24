<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_number','items','total','customer_id','status_id'];
    public function customer()
     {
         return $this->belongsTo('App\Customer');
     }

     public function histories(){
       return $this->hasMany('App\OrderHistory');
     }
}
