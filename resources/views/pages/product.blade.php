@extends('pages.master')
@section('style')
<link rel="stylesheet" type="text/css" href="\css\jssocials.css" />
<link rel="stylesheet" type="text/css" href="\css\jssocials-theme-minima.css" />
<link rel="stylesheet" type="text/css" href="\css\font-awesome.min.css" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
<style>
.parent{
	position: relative;
	height: 700px;
	width: 700px;
}
#load{
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
	.parent{
		width: 700px;
		height: 700px;
		left: 50%;
		margin-left: -350px;


	}
}
/*increament and decrement input*/
.cart_quantity_button{
	margin-bottom: 20px;
}
* {
  box-sizing: border-box;
}
.cart_quantity_input{
	width: 80%;
	padding: 0 12px;
	vertical-align: top;
	text-align: center;
	outline: none;
}
.cart_quantity_input,
.cart_quantity_up ,
.cart_quantity_down {
  border: 1px solid #ccc;
  height: 40px;
  user-select: none;
}

.cart_quantity_up ,
.cart_quantity_down {
  display: inline-block;
  width: 8%;
  line-height: 38px;
  background: #f1f1f1;
  color: #444;
  text-align: center;
  font-weight: bold;
  cursor: pointer;
}
.cart_quantity_up :active,
.cart_quantity_down:active {
  background: #ddd;
}

.cart_quantity_up {
  border-right: none;
  border-radius: 4px 0 0 4px;
}

.cart_quantity_down{
  border-left: none;
  border-radius: 0 4px 4px 0;
}
/* social sharing*/
.social{
	text-align:center;
	padding-bottom: 20px;
}
.social a{
	padding: 10px;
}
.product-colors{
	padding-top: 0px;
	margin-bottom: 0px;
}
.panel-group .panel-body{
	padding: 5px 0;
}
.panel-group .panel-collapse{
	padding: 0 5px;
}
.panel-group .panel + .panel{
	margin-top: 7px;
}
.panel-group .panel{
	border:1px solid #ddd;
	border-radius: 3px;
	-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
	box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.panel-title{
	color:#000;
	display: inline-block;
}
.product-btn{
	margin-top: 10px;
}
.panel-heading{
	padding: 7px 10px;
}
</style>
@endsection
@section('content')
			<!-- breadcrumb -->
			<div class="container-fluid hidden-xs">
				<div class="row">
					<ol class="breadcrumb">
					  <li><a href="{{url('/')}}">Shop </a></li>
					  <li class="active">{{$product->name}}</li>
					</ol>
				</div>
			</div>

			<div class="container-fluid product">
				<div class="row visible-xs product-mobile">
					<div class="col-xs-12 text-center">
						<h2 class="product-title">{{$product->name}}</h2>
					</div>
				</div>
				<div class="row" >
					<div class="col-md-8 " >
						<!-- chair -->
						<div class="parent">
							<div class="chair" style="background-image:url('/products/{{$product->id}}/history/init_image.png')"></div>
							 <div id="load"><img src="/img/loading.gif"></div>
						</div>
					</div>
					<div class="col-md-4 ">
						<h2 class="product-title hidden-xs">{{$product->name}}</h2>
						<!-- <div class="product-detail hidden-sm hidden-xs">
								<img src="/products/{{$product->id}}/{{$product->image}}" class="product-img img-responsive" alt="item">
						</div> -->
						<!-- social sharing -->
						<div class="social"></div>
						<!-- increase or decrease quantity -->
						<div class="cart_quantity_button">
				      <span class="cart_quantity_up"> + </span>
				      <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
				      <span class="cart_quantity_down"> - </span>
				    </div>
              <!-- layers -->
							<div class="panel-group" id="accordion">
								 @foreach($layers as $key=>$data)
										<div class="panel panel-default">
											<a data-toggle="collapse" data-parent="#accordion" href="#{{$data->id}}">
												<div class="panel-heading">
													@if(!empty($data->image))
													<img src="/products/{{$data->product_id}}/layers/{{$data->image}}" width:"25" height="25">
													@endif
													<h4 class="panel-title">{{$data->rankname}}</h4>
												</div>
											</a>
											@if($key == 0)
											<div id="{{$data->id}}" class="panel-collapse collapse in">
											  <div class="panel-body">
													<ul class="product-colors">
													 @foreach($data->images as $key=>$image)
															<li class="img-circle color_{{$data->rank}}">
																<img data-product='{{$product->id}}' class="{{$data->id}}{{$image->id}}" id="{{$data->id}}.{{$image->id}}" src="/products/{{$product->id}}/color/{{$image->color}}">
															</li>
													@endforeach
													</ul>
											  </div>
											</div>
											@else
											<div id="{{$data->id}}" class="panel-collapse collapse ">
												<div class="panel-body">
													<ul class="product-colors">
													 @foreach($data->images as $key=>$image)
																<li class="img-circle color_{{$data->rank}}">
																	<img data-product='{{$product->id}}' class="{{$data->id}}{{$image->id}}" id="{{$data->id}}.{{$image->id}}" src="/products/{{$product->id}}/color/{{$image->color}}">
																</li>
													@endforeach
													</ul>
												</div>
											</div>
											@endif
										</div>
									@endforeach
								</div>
							<div class="product-btn">
								<a href="/add/{{$product->id}}/{{$id2}}" class="btn add-to-cart" data-role="none">Add To Cart </a>
							</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8 ">
							<div class="paging clearfix">
								@if($last != "")
								<a class="btn btn-outline pull-left" href="{{url('/product/'.$last)}}"><i class="icon-arrow-left2 left"></i><span>Previous</span><span class="hidden-xs"> Product</span></a>
								@endif
								@if($next != "")
								<a class="btn btn-outline pull-right" href="{{url('/product/'.$next)}}"><span>Next</span><span class="hidden-xs"> Product</span><i class="icon-arrow-right2 right"></i></a>
								@endif
							</div>
						</div>
					</div>
			</div>

@endsection
@section('script')
<script src="/js/jssocials.min.js"></script>
<script src="{{ mix('/custom/js/chair-click.js') }}"></script>
<script src="{{ mix('/custom/js/chair-move.js') }}"></script>
<script src="{{ mix('/custom/js/change-image.js') }}"></script>
<script>
$(document).ready(function(){

	    // 360° rotation when mouse move in mobile and desktop
	    chair();

	    //360° rotation when click in mobile and desktop
	    changepostion();

			//social sharing
			$(".social").jsSocials({
				shares: ["twitter", "facebook", "googleplus", "pinterest"],
				url: window.location.href,
				text: "",
				showLabel: false,
				showCount: false,
			});

	    //second parameter contain layer_id and image_id
	    var default_param = "<?php echo $id2; ?>";
	    var product_id = "<?php echo $product->id;?>";
	    var img_pos = "0px 0px";
			//add select class
			// $(".img-circle").removeClass("selected");
		  // default_param.split("&").forEach(function(element,index) {
			// 	var param = element.split(".");
			// 	console.log(	$("."+param[0]+param[1]).parent());
			// 	$("."+param[0]+param[1]).parent().addClass("selected");
			// });
	    //change image
	    //  change_image(product_id,default_param,img_pos);

			 var last_pro =  default_param;
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
	       $('#load').css('display','flex');
	       var img_pos = $(".chair").css('background-position');
	      // change_image(product_id,ch_layer_id2,img_pos);
				// change_imag
				$.ajax({url: "/test",data:{
					last_pro:last_pro,
					ch_layer_id2: ch_layer_id2,
					product_id:product_id,
					layer_id:layer_id,
					img_pos:img_pos


				}, success: function(result){
					last_pro=ch_layer_id2;

			let sm_img =new Image();
				sm_img.onload=function(){
				 $('.chair').css('background-image','url('+$(this).attr("src")+')');
					$('#load').css('display','none');
					 let img=new Image();
					 img.onload=function(){
						 $('.chair').css('background-image','url('+$(this).attr("src")+')');
						 }
					 img.src='/products/'+product_id+'/history/'+result+'.png';

				 }
					sm_img.src='/products/'+product_id+'/small_image/'+result+'.jpg';

			}
			 });
				/* ---------------------*/

				 //add select class
				 //add select class
				  $(".img-circle").removeClass("selected");
		 		  ch_layer_id2.split("&").forEach(function(element,index) {
		 				var param = element.split(".");
		 				$("."+param[0]+param[1]).parent().addClass("selected");
		 			});
				 //social
	       $(".social").jsSocials({
	         shares: ["twitter", "facebook", "googleplus", "pinterest"],
	         url: window.location.href,
	         text: "",
	         showLabel: false,
	         showCount: false,
	       });

	      var qty= $('.cart_quantity_input').val();
	      $(".add-to-cart").attr("href", "/add/"+product_id+"/"+ch_layer_id2+"/"+qty);
	});

//quantity
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
