@extends('pages.layout')
@section('title')
  Cart
@endsection
@section('style')
<style>
  .table-striped>tbody>tr:nth-child(odd)>td,
  .table-striped>tbody>tr:nth-child(odd)>th {
  	background-color: #ddd;
  }
  .table-striped>tbody>tr:nth-child(even)>td,
  .table-striped>tbody>tr:nth-child(even)>th {
    background-color: #eee;
  }
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
</style>
@endsection

@section('content')
    <div class="container">
        <div class="table-responsive cart_info">
            @if(count($items))
            <table class="table table-striped table-condensed">
                <thead>
                    <tr class="cart_menu">
                      <th></th>
                      <th class="description">Product Name</th>
                      <th class="price">Price</th>
                      <th class="quantity">Quantity</th>
                      <th class="total">Total</th>
                      <th></th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($items as $item)
                  <?php
                      $imagename="";
                      $array = explode("-",$item->id);
                      foreach ($array as $value){ $product_id=$array[0]; $imagename .= $value; }
                  ?>
                    <tr>
                      <td>
                        <div class="parent">
                          <div class="chair" style="background: url(/products/{{$product_id}}/history/{{$imagename}}.jpg)"></div>
                        </div>
                      </td>
                      <td class="cart_description">
                          <h4>{{$item->name}}</h4>
                      </td>
                      <td class="cart_price">
                          <p>{{$item->price}}</p>
                      </td>
                      <td class="cart_quantity">
                          <div class="cart_quantity_button">
                              <a class="cart_quantity_up" data-id="{{$item->id}}"  href="{{route('increase.qty',['id'=>$item->id])}}"> + </a>
                              <input style="text-align:center" class="cart_quantity_input qty_{{$item->id}}" type="text" name="quantity" value="{{$item->quantity}}" autocomplete="off" size="2">
                              <a class="cart_quantity_down"  data-id="{{$item->id}}"  href="{{route('decrease.qty',['id'=>$item->id])}}"> - </a>
                          </div>
                      </td>
                       <td class="cart_total">
                          <p class="cart_total_price_{{$item->id}}">{{ $item->quantity * $item->price }}</p>
                      </td>
                      <td class="cart_delete">
                          <a class="cart_quantity_delete" href="{{route('item.delete',['id'=>$item->id])}}"><i class="glyphicon glyphicon-remove"></i></a>
                      </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
          <div class="col-sm-12">
        </div>
          <div class="col-sm-6" style="border-top:1px solid #ddd;margin-top:10px;float:right">
              <!-- <p>Cart Sub Total <span>{{Cart::getSubTotal()}}</span></p> -->
              <p class="total">Total : <span>{{Cart::getTotal()}}</span></p>
              <a class="btn btn-default check_out" href="{{url('/')}}">Continue Shopping</a>
              <a class="btn btn-default update" href="{{route('cart.clear')}}">Clear Cart</a>
              <a class="btn btn-default check_out" href="{{url('/checkout')}}">Check Out</a>
          </div>
          @else
              <p>You have no items in the shopping cart</p>
          @endif
        </div>
      </div>
@endsection
@section('script')
<script>
$(document).ready(function(){
    $(".cart_quantity_up").click(function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      $.ajax({url: "/increase_qty/"+id, success: function(result){
      $(".qty_"+id).val(result.single.quantity);
      $(".cart_total_price_"+id).text(result.single.quantity * result.single.price);
      $("p.total").find("span").text(result.total);
      $(".dropdown").find("a.cart_count").find("span.badge").text(result.total_quantity);
      $(".dropdown-menu").find(".quantity_"+id).find("span").text(result.single.quantity);
      $(".dropdown-menu").find(".price_"+id).find("span").text(result.single.quantity * result.single.price);
     }});
    });
    $(".cart_quantity_down").click(function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      $.ajax({url: "/decrease_qty/"+id, success: function(result){
        $(".qty_"+id).val(result.single.quantity);
        $(".cart_total_price_"+id).text(result.single.quantity * result.single.price);
        $("p.total").find("span").text(result.total);
        $(".dropdown").find("a.cart_count").find("span.badge").text(result.total_quantity);
        $(".dropdown-menu").find(".quantity_"+id).find("span").text(result.single.quantity);
        $(".dropdown-menu").find(".price_"+id).find("span").text(result.single.quantity * result.single.price);
     }});
    });

});
</script>
@endsection
