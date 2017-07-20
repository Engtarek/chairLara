<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $fillable =['name'];

    public function product_images(){
        return $this->hasMany(Product::class ,'image','id');
    }
    public function product_init_images(){
        return $this->hasMany(Product::class ,'init_image','id');
    }
    public function layer_images(){
        return $this->hasMany(ProductLayer::class ,'image','id');
    }
    public function images_image(){
        return $this->hasMany(ProductLayerImage::class ,'image','id');
    }
    public function images_color(){
        return $this->hasMany(ProductLayerImage::class ,'color','id');
    }
}
