@extends('pages.master')
@section('style')
<link rel="stylesheet" type="text/css" href="\css\jssocials.css" />
<link rel="stylesheet" type="text/css" href="\css\jssocials-theme-minima.css" />
<link rel="stylesheet" type="text/css" href="\css\font-awesome.min.css" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css" />
@if(App::isLocale('ar'))
<style>
@media(max-width:767px){
	.parent{
		right: 50%;
		margin-right: -350px;
	}
}
@media(min-width:992px){
	.chair-right{
float: right;
	}
	.layer-left{
float: left;
	}
}
</style>
@else
<style>
@media(max-width:767px){
	.parent{
		left: 50%;
		margin-left: -350px;
	}
}
</style>
@endif
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
#sm_load{
	display: none;
	position: absolute;
	top:50px;
	right:50px;
}
#load_360{
	display: none;
	position: absolute;
	top: 0;
	right: 0;
}
#load_360 img{
		float: right;
		width: 12%;
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

.social a{
	padding: 5px;
	font-size: 20px;
}

.jssocials-share-pinterest .jssocials-share-link{
	color:#000 !important;
}
.jssocials-share-googleplus .jssocials-share-link{
	color:#000 !important;
}
.jssocials-share-facebook .jssocials-share-link{
	color:#000 !important;
}
.jssocials-share-twitter .jssocials-share-link{
	color:#000 !important;
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
/* Start the slider */
.box-rounded{
	background-color: #ebebeb;
	border: 1px solid #ddd;
	border-radius: 3px;

	margin-bottom: 15px;
	clear: both;
}
.attributes{
			position: relative;
}
.attributes .next-attribute{
	right: 15px;
}
.attributes .next-attribute, .attributes .prev-attribute{
	position: absolute;
	top: 3px;
	z-index: 1000;
	cursor: pointer;
}
.attributes .prev-attribute {
left: 15px;
}
.attribute h4 {
	display: block;
}
.box-rounded h4{
text-align: center;
}
.attribute{
display:none;
}
.active2{
display: block;
}
.configurations{
	background: #fff;
		padding: 15px;
}
/* End the slider */
</style>
@endsection
@section('content')
			<!-- breadcrumb -->
			<div class="container-fluid hidden-xs">
				<div class="row">
					<ol class="breadcrumb">
					  <li><a href="{{url('/')}}">{{trans('menue.Shop')}} </a></li>
					  <li class="active">
							@if(App::isLocale('ar')) {{$product->name_ar}} @else {{$product->name_en}} @endif
						</li>
					</ol>
				</div>
			</div>

			<div class="container-fluid product">
				<div class="row visible-xs product-mobile" style="padding-bottom:0px">
					<div class="col-xs-12 text-center">
						<h2 class="product-title">@if(App::isLocale('ar')) {{$product->name_ar}} @else {{$product->name_en}} @endif</h2>
					</div>
				</div>

				<div class="row clearfix" >
					<div class="col-md-8 col-xs-12 chair-right" style="overflow: hidden;" >
						<!-- chair -->
						<div class="parent">
							@if(!empty($init_imagename))
								<div class="chair" style="background-image:url('/images/{{$init_imagename}}.png')"></div>
							@elseif(!empty($imagename))
								<div class="chair" style="background-image:url('/products/{{$product->id}}/history/{{$imagename}}.png')"></div>
							@endif
							 <div id="load"></div>
							 <div id="sm_load"></div>
							 <div id="load_360"><img src="/img/media-360-600.png" ></div>
						</div>
					</div>
					 <div class="col-md-4 col-xs-12 layer-left">
						<h2 class="product-title hidden-xs">	@if(App::isLocale('ar')) {{$product->name_ar}} @else {{$product->name_en}} @endif</h2>
						<!-- layers of color -->
						<label class="control-label">{{trans('keys.Change_the_colors')}}</label>
						<div class="panel-group" id="accordion" style="@if($setting->slider_show == 2) display:block @else display:none @endif">
							 @foreach($layers as $key=>$data)
									<div class="panel panel-default">
										<a data-toggle="collapse" data-parent="#accordion" href="#{{$data->id}}">
											<div class="panel-heading">
												@if(!empty($data->image))
												<img src="/images/{{$data->layer_image->name}}" width:"25" height="25">
												@endif
												<h4 class="panel-title">@if(App::isLocale('ar')){{$data->rankname_ar}} @else {{$data->rankname_en}} @endif </h4>
											</div>
										</a>
										@if($key == 0)
										<div id="{{$data->id}}" class="panel-collapse collapse in">
											<div class="panel-body">
												<ul class="product-colors">
												 @foreach($data->images as $key=>$image)
														<li class="img-circle color_{{$data->rank}}">
															<img data-product='{{$product->id}}' class="{{$data->id}}{{$image->id}}" id="{{$data->id}}.{{$image->id}}" src="/images/{{$image->get_color->name}}">
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
																<img data-product='{{$product->id}}' class="{{$data->id}}{{$image->id}}" id="{{$data->id}}.{{$image->id}}" src="/images/{{$image->get_color->name}}">
															</li>
												@endforeach
												</ul>
											</div>
										</div>
										@endif
									</div>
								@endforeach
							</div>
							<!-- Slider of color -->
							 <div class="box-rounded attributes" style="@if($setting->slider_show == 1) display:block @else display:none @endif">
									<div class="next-attribute" data-count="{{count($layers)}}">
										<i class="fa fa-chevron-right" aria-hidden="true" style="padding-top: 50%;font-size: 20px;"></i>
										<!-- <img src="http://urbike.de/wp-content/themes/urbike/img/arrow-right.svg" width="32" height="32"> -->
									</div>
									<div class="prev-attribute" data-count="{{count($layers)}}">
										<i class="fa fa-chevron-left" aria-hidden="true" style="padding-top: 50%;font-size: 20px;"></i>
										<!-- <img src="http://urbike.de/wp-content/themes/urbike/img/arrow-left.svg" width="32" height="32"> -->
									</div>
									@foreach($layers as $key=>$data)

												<div class="attribute @if($key == 0) active2 @endif" data-key="{{$key+1}}" id="attr_{{$key+1}}">

													<h4>
														@if(!empty($data->image))
													<img src="/images/{{$data->layer_image->name}}" width:"25" height="25">
													@endif @if(App::isLocale('ar')){{$data->rankname_ar}} @else {{$data->rankname_en}} @endif
												</h4>
													<div class="configurations">
														<ul class="product-colors">
														 @foreach($data->images as $key=>$image)
																	<li class="img-circle color_{{$data->rank}}">
																		<img data-product='{{$product->id}}' class="{{$data->id}}{{$image->id}}" id="{{$data->id}}.{{$image->id}}" src="/images/{{$image->get_color->name}}">
																	</li>
														@endforeach
														</ul>
													</div>
												 </div>
									 @endforeach

								</div>

							<!-- ++++++++++++++ -->
							<!-- Size -->
							<div class="form-group clearfix" style="margin-top:15px;">
						 		<label class="control-label">{{trans('keys.Size')}}</label>
								<select class="form-control">
									<option value="40">40</option>
									<option value="41">41</option>
									<option value="42">42</option>
									<option value="43">43</option>
									<option value="44">44</option>
									<option value="45">45</option>
								</select>
							</div>


							<!-- add-to-cart -->
							<div class="product-btn">
								<a href="" class="btn add-to-cart" data-role="none">{{trans('keys.add_to_cart')}}</a>
							</div>

							<!-- social sharing -->
							<label class="control-label"> {{trans('keys.share_this_design')}} </label>
							<div class="social"></div>

							<!-- design url -->
							<div class="form-group clearfix" style="margin-top:15px;">
								<input type="text" class="form-control design_url" value="">
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
<script src="/js/spin.min.js"></script>
<script src="{{ mix('/custom/js/chair-click.js') }}"></script>
<script src="{{ mix('/custom/js/chair-move.js') }}"></script>
<script src="{{ mix('/custom/js/change-image.js') }}"></script>
<script>
$(document).ready(function(){
	//color of slider
	$(".next-attribute").click(function(){
			var id =  $(".active2").attr("data-key");
			var id2 = parseInt(id) + 1;
			 var count = $(this).attr("data-count");
			 if(id2 > count){id2 =1;}
			$("#attr_"+id).removeClass("active2");
			$("#attr_"+id2).addClass("active2");
		});
	$(".prev-attribute").click(function(){
			var id =  $(".active2").attr("data-key");
			var id2 = parseInt(id) - 1;
			var count = $(this).attr("data-count");
			if(id2 == 0){id2 =count;}
			$("#attr_"+id).removeClass("active2");
			$("#attr_"+id2).addClass("active2");
		});

		// 360° rotation when mouse move in mobile and desktop
		chair();

		//360° rotation when click in mobile and desktop
		changepostion();

		//second parameter contain layer_id and image_id
		var default_param = "<?php echo $id2; ?>";
		var product_id = "<?php echo $product->id;?>";
		var img_pos = "0px 0px";

		//social sharing
		$(".social").jsSocials({
			shares: ["twitter", "facebook", "googleplus", "pinterest"],
			url: window.location.origin+"/product/"+product_id+"/"+default_param,
			text: "",
			showLabel: false,
			showCount: false,
		});
		$(".design_url").val(window.location.origin+"/product/"+product_id+"/"+default_param);
		//add select class
		$(".img-circle").removeClass("selected");
		default_param.split("&").forEach(function(element,index) {
			var param = element.split(".");
			$("."+param[0]+param[1]).parent().addClass("selected");
		});
			//change image
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

				//loading
				$('#load').css('display','flex');
				$('#sm_load').css('display','none');
				$('#load_360').css('display','none');
				var opts = {   lines: 17 // The number of lines to draw
					, length: 0 // The length of each line
					, width: 8 // The line thickness
					, radius: 30 // The radius of the inner circle
					, scale: 2.25 // Scales overall size of the spinner
					, corners: 1 // Corner roundness (0..1)
					, color: '#000' // #rgb or #rrggbb or array of colors
					, opacity: 0.15 // Opacity of the lines
					, rotate: 0 // The rotation offset
					, direction: 1 // 1: clockwise, -1: counterclockwise
					, speed: 1.7 // Rounds per second
					, trail: 49 // Afterglow percentage
					, fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
					, zIndex: 2e9 // The z-index (defaults to 2000000000)
					, className: 'spinner' // The CSS class to assign to the spinner
					, top: '50%' // Top position relative to parent
					, left: '50%' // Left position relative to parent
					, shadow: false // Whether to render a shadow
					, hwaccel: false // Whether to use hardware acceleration
					, position: 'absolute' // Element positioning
 				}
				var target = document.getElementById('load')
				var spinner = new Spinner(opts).spin(target);

				//small load
				var opts = {
					  lines: 17 // The number of lines to draw
					, length: 0 // The length of each line
					, width: 8 // The line thickness
					, radius: 42 // The radius of the inner circle
					, scale: 0.25 // Scales overall size of the spinner
					, corners: 1 // Corner roundness (0..1)
					, color: '#000' // #rgb or #rrggbb or array of colors
					, opacity: 0.15 // Opacity of the lines
					, rotate: 0 // The rotation offset
					, direction: 1 // 1: clockwise, -1: counterclockwise
					, speed: 1.7 // Rounds per second
					, trail: 49 // Afterglow percentage
					, fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
					, zIndex: 2e9 // The z-index (defaults to 2000000000)
					, className: 'spinner' // The CSS class to assign to the spinner
					, top: '7%' // Top position relative to parent
					, left: '93%' // Left position relative to parent
					, shadow: false // Whether to render a shadow
					, hwaccel: false // Whether to use hardware acceleration
					, position: 'absolute' // Element positioning
					}
					var target = document.getElementById('sm_load');
					var spinner = new Spinner(opts).spin(target);

				//change image
				var img_pos = $(".chair").css('background-position');
				$.ajax({url: "/change_image",data:{last_pro:last_pro,ch_layer_id2: ch_layer_id2,product_id:product_id,layer_id:layer_id,img_pos:img_pos},
					success: function(result){
						last_pro=ch_layer_id2;
						let sm_img =new Image();
						sm_img.onload=function(){
							$('.chair').css('background-image','url('+$(this).attr("src")+')');
							$('#load').css('display','none');
							$('#sm_load').css('display','flex');
							let img=new Image();
							img.onload=function(){
								$('.chair').css('background-image','url('+$(this).attr("src")+')');
								$('#sm_load').css('display','none');
								$('#load_360').css('display','block');
							}
							img.src='/products/'+product_id+'/history/'+result+'.png';
						}
						sm_img.src='/products/'+product_id+'/small_image/'+result+'.jpg';
					}
				});

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
				$(".design_url").val(window.location.href);
			});

			//quantity
			$('.cart_quantity_up').click( function(e) {
				e.preventDefault();
				var counter = $('.cart_quantity_input').val();
				counter++ ;
				$('.cart_quantity_input').val(counter);
			});
			$('.cart_quantity_down').click( function(e) {
				e.preventDefault();
				var counter = $('.cart_quantity_input').val();
				if(counter > 1){counter-- ;}
				$('.cart_quantity_input').val(counter);
			});
			//add to cart
			$(".add-to-cart").click(function(e){
				e.preventDefault();
				var size = $("select").val();
				if(window.location.pathname.split('/').length == 3){
					var id2 = default_param;
				}else{
					var id2 = window.location.pathname.split('/')[3];
				}
				// var qty = $('.cart_quantity_input').val();
				var qty = 1;
				$.ajax({url: "/add",data:{size:size,product_id:product_id,id2:id2,quantity:qty},
					success: function(result){
						window.location.href=result;
					}
				});
			});
		});

</script>
@endsection
