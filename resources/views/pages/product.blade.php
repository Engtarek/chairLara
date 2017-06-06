@extends('pages.layout')
@section('title')
  Product-{{$product->name}}
@endsection

@section('header')
  <link rel="stylesheet" type="text/css" href="\css\jssocials.css" />
  <link rel="stylesheet" type="text/css" href="\css\jssocials-theme-minima.css" />
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
  <!-- <script>
     $(document).bind('mobileinit',function(){
         $.mobile.keepNative = "select,input,div";
     });
 </script> -->
 <!-- <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> -->

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
  #foo{
    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
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
    <div class="parent">
      <div class="chair"  style="background-image: url('/products/{{$product->id}}/history/{{$image_name}}.jpg')"></div>
        <div id="foo"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
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
  <script src="/js/social.js"></script>
  <script src="/js/chair-click.js"></script>
  <script src="/js/chair-move.js"></script>
  <script src="/js/spin.min.js"></script>

  <script>
    // 360° rotation when mouse move in mobile and desktop
    chair();

    //360° rotation when click in mobile and desktop
    changepostion();

    //second parameter contain layer_id and image_id
    var default_param = "<?php echo $id2; ?>";

    $(".img-circle").click(function(){
      //layer_id.image_id
      var layer_id = $(this).find("img").attr("id");
      //product_id
      var product_id = $(this).find("img").attr("data-product");
      // return url in array such as  ["", "product", "product id", "layer_id.image_id&layer_id.image_id&..."]
      var url = window.location.pathname.split('/');
      //assign layer_id.image_id to url
      if(url.length === 4 && url[3] === ""){
        url[3] = default_param;
      }else if(url.length === 3){
        url[3] = default_param;
      }
      var last_element_in_url = url[3];
      var  ch_layer_id="/product/"+product_id+'/';
      var  ch_layer_id2="";
      //change the value of layer_id.image_id  when click
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
       //change image
       $('#foo').show();
      //  var target = document.getElementById('foo')
      //  var spinner = new Spinner().spin(target);
       $.ajax({url: "/change_image/"+product_id+"/"+ch_layer_id2+"", success: function(result){
         let img=new Image();
         img.onload=function(){
            $('.chair').css('background-image','url('+$(this).attr("src")+')');
            $('#foo').hide();
          }
          img.src='/products/'+product_id+'/history/'+result+'.jpg';
        }
      });
      social(window.location.href,product_name);
      var qty= $('.cart_quantity_input').val();
      $(".add-to-cart").attr("href", "/add/"+product_id+"/"+ch_layer_id2+"/"+qty);
});

social(window.location.href,product_name);
</script>
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
@endsection
