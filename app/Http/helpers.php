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
function status(){
  $status = [];
  foreach(\App\OrderStatus::all() as $value){
    $status[$value->id] = $value->name;
  }
  return $status;
}
function status_name($id){
  $status = \App\OrderStatus::find($id);
 return  $name = $status->name;
}

function employees(){
  $employees = [];
  foreach(\App\Employees::all() as $value){
    $employees[$value->id] = $value->name."  - ".$value->title;
  }
  return $employees;
}
?>
