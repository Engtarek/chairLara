<?php
//get all products
function product(){
  $product = [];
  foreach(\App\Product::all() as $value){
    $product[$value->id] = $value->name_en;
  }
  return $product;
}

//get the customer name
function customer_name($id){
  $customer = \App\Customer::find($id);
  return  $name = $customer->first_name ." ". $customer->last_name;
}

//get all status
function status(){
  $status = [];
  foreach(\App\OrderStatus::all() as $value){
    $status[$value->id] = $value->name;
  }
  return $status;
}
//get all layers
function layers(){
  $layers = [];
  foreach(\App\ProductLayer::all() as $value){
    $layers[$value->id] = $value->rankname_en;
  }
  return $layers;
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
//product appearnce
function appearnce(){
  $appearnce = [
    0=>'hide',
    1=>'show'
  ];
  return $appearnce;
}
//get all roles
function roles(){
  $roles = [];
  foreach(\App\Role::all() as $value){
    $roles[$value->id] = $value->name;
  }
  return $roles;
}
//convert layers to one image
function merge_image($images,$product_id,$image_position){
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
    imagepng($outputImage, 'products/'.$product_id.'/history/' .$imagename.'.png',5);
    cutImage('products/'.$product_id.'/history/' .$imagename.'.png',$image_position,$product_id,$imagename);
    return $imagename;

}
function cutImage($src,$image_position,$product_id,$imagename){
    $position =explode(" ",$image_position);
    $startX = abs(substr($position[0], 0, -2));
    $startY = abs(substr($position[1], 0, -2));

    $image = imagecreatefrompng($src);
    $cropImage = imagecrop($image,['x'=>$startX,'y'=>$startY,'width'=>700,'height'=>700]);
    if (!file_exists('products/'.$product_id.'/small_image')) {
        mkdir('products/'.$product_id.'/small_image', 0777, true);
    }
    imagejpeg($cropImage,'products/'.$product_id.'/small_image/' .$imagename.'.jpg',40);


}
function createImage($product_id,$last_pro,$layer_id,$imagename,$image_position){

    $x=2800;
    $y=1400;
    $outputImage = imagecreatetruecolor(2800, 1400);
    // set background to white
    $white = imagecolorallocate($outputImage, 255, 255, 255);
    imagefill($outputImage, 0, 0, $white);

    $last_pro_name = $product_id;
    foreach(explode("&",$last_pro)as $data){
      foreach (explode(".",$data) as $value) {
        $last_pro_name .=$value;
      }
    }
    if(file_exists('products/'.$product_id.'/history/'.$last_pro_name.'.png')){
      $name= imagecreatefrompng('products/'.$product_id.'/history/'.$last_pro_name.'.png');
      imagecopyresized($outputImage,$name,0,0,0,0, $x, $y,$x,$y);
    }else{
      $img = \App\Product::find($product_id)->product_init_image->name;
      $name= imagecreatefrompng('images/'.$img);
      imagecopyresized($outputImage,$name,0,0,0,0, $x, $y,$x,$y);
    }

    $image = \App\ProductLayer::find(explode(".",$layer_id)[0])->images()->find(explode(".",$layer_id)[1])->get_image->name;

    $ext = pathinfo($image, PATHINFO_EXTENSION);
    if($ext == 'png'){
      $name= imagecreatefrompng('images/'.$image.'');
      imagecopyresized($outputImage,$name,0,0,0,0, $x, $y,$x,$y);
    }elseif($ext == 'jpg' || $ext == 'jpeg'){
      $name="2";
      $name= imagecreatefromjpeg('images/'.$image.'');
      imagecopyresized($outputImage,$name,0,0,0,0, $x, $y,$x,$y);
    }

    if (!file_exists('products/'.$product_id.'/history')) {
        mkdir('products/'.$product_id.'/history', 0777, true);
    }
   imagepng($outputImage, 'products/'.$product_id.'/history/' .$imagename.'.png');
   cutImage('products/'.$product_id.'/history/' .$imagename.'.png',$image_position,$product_id,$imagename);
}

?>
