<?php
//get all products
function product(){
  $product = [];
  foreach(\App\Product::all() as $value){
    $product[$value->id] = $value->name;
  }
  return $product;
}

//get the customer name
function customer_name($id){
  $customer = \App\Customer::find($id);
  return  $name = $customer->first_name." ". $customer->last_name;
}

//get all status
function status(){
  $status = [];
  foreach(\App\OrderStatus::all() as $value){
    $status[$value->id] = $value->name;
  }
  return $status;
}

//get the order status name
function status_name($id){
  $status = \App\OrderStatus::find($id);
 return  $name = $status->name;
}

//get all employees
function employees(){
  $employees = [];
  foreach(\App\Employees::all() as $value){
    $employees[$value->id] = $value->name."  - ".$value->title;
  }
  return $employees;
}

//convert layers to one image
function merge_image($images,$product_id){
    $x=2800;
    $y=1400;
    header('Content-Type: image/png');
    $outputImage = imagecreatetruecolor(2800, 1400);
    // set background to white
    $white = imagecolorallocate($outputImage, 255, 255, 255);
    imagefill($outputImage, 0, 0, $white);
    $imagename=$product_id;
    foreach($images as $key=>$image){
      $imagename.=$image['image']['product_layers_id'].$image['image']['id'];
      $name ='img'.$image['rank'];
      $ext = pathinfo($image['image']['image'], PATHINFO_EXTENSION);
      if($ext == 'png'){
        $name= imagecreatefrompng('products/'.$product_id.'/image/'.$image['image']['image'].'');
        imagecopyresized($outputImage,$name,0,0,0,0, $x, $y,$x,$y);
      }elseif($ext == 'jpg' || $ext == 'jpeg'){
        $name= imagecreatefromjpeg('products/'.$product_id.'/image/'.$image['image']['image'].'');
        imagecopyresized($outputImage,$name,0,0,0,0, $x, $y,$x,$y);
      }
    }
    if (!file_exists('products/'.$product_id.'/history')) {
        mkdir('products/'.$product_id.'/history', 0777, true);
    }
    imagejpeg($outputImage, 'products/'.$product_id.'/history/' .$imagename.'.jpg',50);
    // if(file_exists($imagename.'.png')){
    //     File::delete(public_path('products/'.$product_id.'/history/'.$imagename.'.png'));
    //     imagejpeg($outputImage, 'products/'.$product_id.'/history/' .$imagename.'.jpg',50)
    // }else{
    //    imagepng($outputImage, 'products/'.$product_id.'/history/' .$imagename.'.png',9);
    // }
   return $imagename;

}

?>
