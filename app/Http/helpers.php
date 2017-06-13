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
  return  $name = $customer->name;
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
function merge_image($images,$product_id,$image_index){
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
    imagejpeg($outputImage, 'products/'.$product_id.'/history/' .$imagename.'.jpg',40);
    return $array = array(
                        'image' => cutImage('products/'.$product_id.'/history/' .$imagename.'.jpg',$image_index),
                        'name'=>$imagename
                      );
  //  return $imagename;

}
function cutImage($src,$image_index){
    $position =explode(" ",$image_index);
    $startX = abs(substr($position[0], 0, -2));
    $startY = abs(substr($position[1], 0, -2));

    $image = imagecreatefromjpeg($src);
    $cropImage = imagecrop($image,['x'=>$startX,'y'=>$startY,'width'=>700,'height'=>700]);
    ob_start();
    imagejpeg($cropImage);
    $data=ob_get_contents();
    ob_end_clean();
    $data='data:image/jpg;base64,'.base64_encode($data);
    return $data;
}

?>
