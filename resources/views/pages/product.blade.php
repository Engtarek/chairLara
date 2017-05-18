@extends('pages.layout')
@section('title')
  Product-{{$product->name}}
@endsection

@section('header')
  <link rel="stylesheet" type="text/css" href="\css\jssocials.css" />
  <link rel="stylesheet" type="text/css" href="\css\jssocials-theme-minima.css" />
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
  <script>
      $(document).bind('mobileinit',function(){
          $.mobile.keepNative = "select,input,div";
      });
  </script>
  <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

@endsection

@section('style')
  <style>
  .container2{
    width: 100%;
    overflow: hidden;
  }
  h1{
    text-align: center;
  }
  .parent{
    position: relative;
    height: 700px;
    width: 700px;
    left: 50%;
    margin-left: -350px;
  }
  .chair{
    height: 100%;
    width: 100%;
    background-position: 0px 0px;
    transform: scale(1);
    text-align: center;
    background-size: auto;
  }
  @media(max-width:767px){
  .chair{
      transform: scale(.7);
    }
  }
  .colors{
    height: 100%;
    width: 100%;
    text-align: center;
  }
  .colors p{
    text-justify: auto
  }
  .img-circle{
    display: inline-block;
  }
  .img-circle img{
      width: 50px;
      height: 50px;
      border-radius: 50%;
      margin: 10px;
  }
  .social{
    text-align:center;
    padding-bottom: 20px;
  }
  .social a{
    padding: 10px;
  }
  </style>
@endsection
@section('content')
  <div class="container2">
    <h1>{{$product->name}}</h1>
     <div id="chair" class="parent">
      @foreach($defaultimages as $value)
        <div class="chair img_{{$value['rank']}}"  style="position:absolute;z-index:{{$value['rank']}};background-image: url('/products/{{$product->id}}/image/{{$value['image']['image']}}')"></div>
      @endforeach
    </div>
    <div class="social"></div>
    <div class="colors">
       @foreach($layers as $data)
         <p style="display:inline-block">{{$data->rankname}}</p>
          @foreach($data->images as $image)
             <div class="img-circle color_{{$data->rank}}"><img data-product='{{$product->id}}' id="{{$data->id}}.{{$image->id}}" src="/products/{{$product->id}}/color/{{$image->color}}"></div>
          @endforeach
        </br>
       @endforeach
    </div>
  </div>
  <div style="text-align:center">
    <div class="cart_quantity_button" style="display:inline-block;padding-right:30px">
        <a class="cart_quantity_up"   href=""> + </a>
        <input style="text-align:center" class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
        <a class="cart_quantity_down"  href=""> - </a>
    </div>
    <a href="/add/{{$product->id}}/{{$id2}}" style="width:150px;" class="btn btn-primary add-to-cart" data-role="none">
      <i class="fa fa-shopping-cart"></i>Add to cart
    </a>
  </div>
@endsection
@section('script')

    <script src="/js/jssocials.min.js"></script>
    <script src="/js/chair.js"></script>
    <script src="/js/custom.js"></script>
    <script src="/js/touch.js"></script>
    <script src="/js/social.js"></script>
    <script>
    $(document).ready(function(){
      $('.cart_quantity_up').click( function(e) {
          e.preventDefault();
          var counter = $('.cart_quantity_input').val();
          counter++ ;
          $('.cart_quantity_input').val(counter);
          var qty= $('.cart_quantity_input').val();
           $(".add-to-cart").attr("href", url+"/"+qty);
      });
       $('.cart_quantity_down').click( function(e) {
         e.preventDefault();
            var counter = $('.cart_quantity_input').val();
           if(counter >1){
             counter-- ;
           }
         $('.cart_quantity_input').val(counter);
         var qty= $('.cart_quantity_input').val();
          $(".add-to-cart").attr("href", url+"/"+qty);
       });
        var url = $(".add-to-cart").attr("href");
        var qty= $('.cart_quantity_input').val();
         $(".add-to-cart").attr("href", url+"/"+qty);

   });
       </script>
       <script>
    var default_param = "<?php echo $id2; ?>";
     var url4 ="";
    $(".img-circle").click(function(){
        var layer_id = $(this).find("img").attr("id");
        var product_id = $(this).find("img").attr("data-product");
        var url = window.location.pathname.split('/');
        if(url.length === 4 && url[3] === ""){
          url[3] = default_param;
        }else if(url.length === 3){
          url[3] = default_param;
        }
        var last_element_in_url = url[3];
        var  ch_layer_id="/product/"+product_id+'/';
        var  ch_layer_id2="";
        for (var i=0; i<last_element_in_url.split('&').length; i++){
          if(last_element_in_url.split('&')[i].split('.')[0] == layer_id.split('.')[0]){
            ch_layer_id += layer_id;
            ch_layer_id2 += layer_id;
          }else{
            ch_layer_id += last_element_in_url.split('&')[i];
            ch_layer_id2 += last_element_in_url.split('&')[i];
          }
          if(i < last_element_in_url.split('&').length -1 ){
            ch_layer_id +="&";
            ch_layer_id2 +="&";
          }
        }
        history.pushState(null, null,ch_layer_id);
        social(window.location.href,product_name);
        var qty= $('.cart_quantity_input').val();
        $(".add-to-cart").attr("href", "/add/"+product_id+"/"+ch_layer_id2+"/"+qty);
    });
    social(window.location.href,product_name);
    //  start code for change image
      <?php foreach($layers as $key=>$data){if($key == 0){?>
          changeimage("color_<?php echo $data->rank; ?>","img_<?php echo $data->rank; ?>",'jpg','<?php echo $data->product_id;?>');
      <?php  }else{?>
          changeimage("color_<?php echo $data->rank; ?>","img_<?php echo $data->rank; ?>",'png','<?php echo $data->product_id;?>');
      <?php  } }?>
    //  end change image

      <?php foreach($layers as $data){?>
          chair("img_<?php echo $data->rank; ?>");
      <?php }?>
      //check if device touch or not
      function isTouchDevice(){
          return true == ("ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch);
      }

      if(isTouchDevice()===true) {
        <?php foreach($layers as $data){?>
          lefttouch("img_<?php echo $data->rank; ?>","<?php echo $data->product_id;?>");
        <?php }?>
        <?php foreach($layers as $data){?>
          righttouch("img_<?php echo $data->rank; ?>","<?php echo $data->product_id;?>");
        <?php }?>
        <?php foreach($layers as $data){?>
          clicktouch("img_<?php echo $data->rank; ?>","<?php echo $data->product_id;?>");
        <?php }?>
      }else{
        //change position of product
        <?php foreach($layers as $data){?>
            changepostion("img_<?php echo $data->rank; ?>","<?php echo $data->product_id;?>");
        <?php }?>
        //end position
      }
    </script>
@endsection
