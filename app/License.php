<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $fillable = ['license','website_url','user_id','enable'];
    public function user(){
        return $this->belongsTo('App\User');
    }
}
