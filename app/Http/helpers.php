<?php
function product(){
  $product = [];
  foreach(\App\Product::all() as $value){
    $product[$value->id] = $value->name;
  }
  return $product;
}
function productsurfaces(){
  $productsurface = [
    '0'=>'body',
    '1'=>'front cover',
    '2'=>'back cover'
  ];
  return $productsurface;
}
function customer_name($id){
  $customer = \App\Customer::find($id);
  return  $name = $customer->first_name." ". $customer->last_name;
}
?>
