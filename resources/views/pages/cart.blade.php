@extends('pages.master')
@section('style')
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
  margin-left: -245px;
  margin-top: -283px;
  background-position: 0px 0px;
}
/*            */
.cart_quantity_input{
	width: 70%;
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
  width: 15px;
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
						<h2>Shopping Cart</h2>
					</div>
				</div>
			</div>

			<div class="container-fluid cart-list" ng-controller="cartController">
          @if(count($items))
				<div class="row">
					<div class="col-sm-8">

						<table class="table table-responsive" style="width:100%;overflow: auto;">
						  <thead>
							<tr>
                <th class="hidden-xs"></th>
							  <th>Item</th>
							  <th>Unit Cost</th>
							  <th class="text-center">Quantity</th>
							  <th class="text-right">Total</th>
							  <th></th>
							</tr>
						  </thead>
						  <tbody>
              @foreach($items as $item)
              <?php
                  $imagename="";
                  $array = explode("-",$item->id);
                  foreach ($array as $value){
                    $product_id=$array[0];
                    foreach(explode(".",$value) as $data){
                      $imagename .= $data;
                    }
                 }
              ?>
							<tr>
                <td class="hidden-xs">
                  <div class="parent">
                    <div class="chair" style="background: url(/products/{{$product_id}}/history/{{$imagename}}.png)"></div>
                  </div>
                </td>
	  	 					<td class="vert-align">{{$item->name}}</td>
								<td class="vert-align">{{$item->price}}</td>
								<td class="text-center vert-align cart_quantity">
                  <?php foreach (explode("-",$item->id) as $key => $first_id) {
                     if($key==0){$item_id = $first_id;}
                     else{foreach (explode(".",$first_id) as $key => $second_id) {
                       $item_id .= $second_id;
                     }}
                  }?>
                    <div class="cart_quantity_button">
                        <a class="cart_quantity_up" data-mergeid="{{$item_id}}" data-id="{{$item->id}}"  href="{{route('increase.qty',['id'=>$item->id])}}"> + </a>
                        <input class="cart_quantity_input qty_{{$item_id}}" type="text" name="quantity" value="{{$item->quantity}}" autocomplete="off" size="2">
                        <a class="cart_quantity_down" data-mergeid="{{$item_id}}" data-id="{{$item->id}}"  href="{{route('decrease.qty',['id'=>$item->id])}}"> - </a>
                    </div>
                </td>
								<td class="text-right vert-align cart_total_price_{{$item_id}}"> {{ $item->quantity * $item->price }}</td>
                <td class="cart_delete text-center vert-align">
                    <a class="cart_quantity_delete remove-item" href="{{route('item.delete',['id'=>$item->id])}}"><i class="icon-close"></i></a>
                </td>
							</tr>
              @endforeach
						  </tbody>
						</table>

						<h4>INTERNATIONAL ORDERS</h4>
						<p>Shipping costs for international orders will be displayed at checkout.<br>
						All international orders must have a ship-to destination outside of the United States. We cannot support customers with international billing addresses shipping to U.S. addresses.
						</p>

					</div>
					<div class="col-sm-4 ">
							<table class="table">
							  <thead>
								<tr>
								  <th colspan="3" class="text-center">Order sumary</th>
								</tr>
							  </thead>
							  <tbody>
								<tr>
								  <td>Sub total:</td>
								  <td></td>
								  <td class="text-right sub_total"><b> {{Cart::getTotal()}} </b></td>
								</tr>
								<tr>
								  <td>Shipping cost:</td>
								  <td></td>
								  <td class="text-right"> 0 </td>
								</tr>
								<tr>
								  <td>Total:</td>
								  <td></td>
								  <td id="total" class="text-right"><span> {{Cart::getTotal() +0}} </span></td>
								</tr>
							  </tbody>
							</table>

							<a href="{{url('/checkout')}}" class="btn btn-right">Checkout</a>
					</div>
				</div>
        @else
        <div class="row">
          <div class="col-sm-12">

                  <h2 class="text-center">Your cart is empty.</h2>

          </div>
        </div>
        @endif

				<div class="row">
					<div class="col-sm-12 text-center show-more">
						<a href="{{url('/')}}" class="btn btn-outline">Cancel and return to store</a>
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
