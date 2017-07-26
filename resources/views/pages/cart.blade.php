@extends('pages.master')
@section('style')
@if(App::isLocale('ar'))
<style>
@media(min-width:767px){
	.table-right{
float: right;
	}
	.table-left{
float: left;
	}
}
</style>
@endif
<style>
.parent{
  width:65px;
  height:85px;
  display:inline-block;
}
.chair{
  width: 575px;
  height: 655px;
  position: absolute;
  transform: scale(.13);
  margin-top: -283px;
  background-position: 0px 0px;
}
/*            */
.cart_quantity_input{
	width: 60%;
	/*padding: 0 12px;*/
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
  width: 20%;
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
@media(max-width:767px){
  .cart_quantity_input{
  	width: 40%;
  }
  .cart_quantity_up ,
  .cart_quantity_down {
    width:13px;
  }
}
</style>
@endsection
@section('content')

			 <div class="container-fluid title">
				<div class="row">
					<div class="col-sm-12">
						<h2>{{trans('keys.shopping_cart')}}</h2>
					</div>
				</div>
			</div>

			<div class="container-fluid cart-list" ng-controller="cartController">
          @if(count($items))
				<div class="row">
					<div class="col-sm-8 col-xs-12 table-right table-responsive">
						<table class="table" style="overflow: auto;">
						  <thead>
							<tr>
                <th class="text-center"></th>
							  <th class="text-center">{{trans('keys.item')}}</th>
							  <th class="text-center">{{trans('keys.unit_cost')}}</th>
                <th class="text-center">{{trans('keys.Size')}}</th>
							  <th class="text-center">{{trans('keys.quantity')}}</th>
							  <th class="text-center">{{trans('keys.total')}}</th>
							  <th class="text-center"></th>
							</tr>
						  </thead>
						  <tbody>
              @foreach($items as $item)
              <?php
                  $id = explode("&",$item->id)[0];
                  $imagename="";
                  $array = explode("-",$id);
                  foreach ($array as $value){
                    $product_id=$array[0];
                    foreach(explode(".",$value) as $data){
                      $imagename .= $data;
                    }
                 }
              ?>

							<tr>
                <td>
                  <div class="parent">
                    <?php if( file_exists("products/".$product_id."/history/".$imagename.".png")){?>
                      <div class="chair" style="@if(App::isLocale('ar')) margin-right: -245px; @else margin-left: -245px; @endif background: url(/products/{{$product_id}}/history/{{$imagename}}.png)"></div>
                    <?php } else{  ?>
                      <div class="chair" style="@if(App::isLocale('ar')) margin-right: -245px; @else margin-left: -245px; @endif background: url(/images/{{\App\Product::find($product_id)->product_init_image->name}})"></div>
                    <?php  }?>
                  </div>
                </td>
	  	 					<td class="text-center">@if(App::isLocale('ar')) {{$item->name['name_ar']}} @else {{$item->name['name_en']}} @endif</td>
								<td class="text-center">{{$item->price}}</td>
                <td class="text-center">{{$item->attributes['size']}}</td>
								<td class="text-center cart_quantity">
                  <?php
                   $id = explode("&",$item->id)[0];
                   foreach (explode("-",$id) as $key => $first_id) {
                     if($key==0){$item_id = $first_id;}
                     else{foreach (explode(".",$first_id) as $key => $second_id) {
                       $item_id .= $second_id;
                     }}
                  }?>
                  @if(App::isLocale('ar'))
                  <div class="cart_quantity_button" style="white-space: nowrap;">
                    <a class="cart_quantity_down" data-mergeid="{{$item_id}}" data-id="{{$item->id}}"  href="{{route('decrease.qty',['id'=>$item->id])}}"> - </a>

                      <input class="cart_quantity_input qty_{{$item_id}}" type="text" name="quantity" value="{{$item->quantity}}" autocomplete="off" size="2">
                      <a class="cart_quantity_up" data-mergeid="{{$item_id}}" data-id="{{$item->id}}"  href="{{route('increase.qty',['id'=>$item->id])}}"> + </a>

                  </div>
                  @else
                    <div class="cart_quantity_button" style="white-space: nowrap;">
                        <a class="cart_quantity_up" data-mergeid="{{$item_id}}" data-id="{{$item->id}}"  href="{{route('increase.qty',['id'=>$item->id])}}"> + </a>
                        <input class="cart_quantity_input qty_{{$item_id}}" type="text" name="quantity" value="{{$item->quantity}}" autocomplete="off" size="2">
                        <a class="cart_quantity_down" data-mergeid="{{$item_id}}" data-id="{{$item->id}}"  href="{{route('decrease.qty',['id'=>$item->id])}}"> - </a>
                    </div>
                    @endif
                </td>
								<td class="text-center cart_total_price_{{$item_id}}"> {{ $item->quantity * $item->price }}</td>
                <td class="cart_delete text-center">
                    <a class="cart_quantity_delete remove-item" href="{{route('item.delete',['id'=>$item->id])}}"><i class="icon-close"></i></a>
                </td>
							</tr>
              @endforeach
						  </tbody>
						</table>

						<h4>{{trans('keys.INTERNATIONAL ORDERS')}}</h4>
						<p>Shipping costs for international orders will be displayed at checkout.<br>
						All international orders must have a ship-to destination outside of the United States. We cannot support customers with international billing addresses shipping to U.S. addresses.
						</p>

					</div>
					<div class="col-sm-4 col-xs-12 table-left">
							<table class="table">
							  <thead>
								<tr>
								  <th colspan="3" class="text-center">{{trans('keys.Order sumary')}}</th>
								</tr>
							  </thead>
							  <tbody>
								<tr>
								  <td>{{trans('keys.Sub total')}}:</td>
								  <td></td>
								  <td class="text-right sub_total"><b> {{Cart::getTotal()}} </b></td>
								</tr>
								<tr>
								  <td>{{trans('keys.Shipping cost')}}:</td>
								  <td></td>
								  <td class="text-right"> 0 </td>
								</tr>
								<tr>
								  <td>{{trans('keys.total')}}:</td>
								  <td></td>
								  <td id="total" class="text-right"><span> {{Cart::getTotal() +0}} </span></td>
								</tr>
							  </tbody>
							</table>

							<a href="{{url('/checkout')}}" class="btn btn-right">{{trans('keys.Checkout')}}</a>
					</div>
				</div>
        @else
        <div class="row">
          <div class="col-sm-12">
              <h2 class="text-center">{{trans('keys.Your cart is empty')}}.</h2>
          </div>
        </div>
        @endif

				<div class="row">
					<div class="col-sm-12 text-center show-more">
						<a href="{{url('/')}}" class="btn btn-outline">{{trans('keys.Cancel and return to store')}}</a>
					</div>
				</div>

			</div>

@endsection
@section('script')
<script>
$(document).ready(function(){
    $(".cart_quantity_up").click(function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var mergeid = $(this).attr('data-mergeid');
      $.ajax({url: "/increase_qty/"+id, success: function(result){
      $(".qty_"+mergeid).val(result.single.quantity);
       $(".cart_total_price_"+mergeid).text(result.single.quantity * result.single.price);
       $(".sub_total").find("b").text(result.total);
       $("#total").find("span").text(result.total + 0);
       $(".nav-header").find(".cart").find("span.badge").text(result.total_quantity);
     }});
    });
    $(".cart_quantity_down").click(function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var mergeid = $(this).attr('data-mergeid');
      $.ajax({url: "/decrease_qty/"+id, success: function(result){
        $(".qty_"+mergeid).val(result.single.quantity);
         $(".cart_total_price_"+mergeid).text(result.single.quantity * result.single.price);
         $(".sub_total").find("b").text(result.total);
         $("#total").find("span").text(result.total + 0);
         $(".nav-header").find(".cart").find("span.badge").text(result.total_quantity);
     }});
    });

});
</script>
@endsection
