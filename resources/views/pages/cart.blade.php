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
</style>
@endsection

@section('content')
    <div class="container">
        <div class="table-responsive cart_info">
            @if(count($items))
            <table class="table table-striped table-condensed">
                <thead>
                    <tr class="cart_menu">
                      <th class="description">Product Name</th>
                      <th class="price">Price</th>
                      <th class="quantity">Quantity</th>
                      <th class="total">Total</th>
                      <th></th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($items as $item)
                    <tr>
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
                          <p class="cart_total_price">{{ $item->quantity * $item->price }}</p>
                      </td>
                      <td class="cart_delete">
                          <a class="cart_quantity_delete" href="{{route('item.delete',['id'=>$item->id])}}"><i class="glyphicon glyphicon-remove"></i></a>
                      </td>
                  </tr>
                @endforeach
              </tbody>
          </table>
          <div class="col-sm-12">
          <button class="update_cart" style="float:right">Update Cart</button>
        </div>
          <div class="col-sm-6" style="border-top:1px solid #ddd;margin-top:10px;float:right">
              <p>Cart Sub Total <span>{{Cart::getSubTotal()}}</span></p>
              <p>Total <span>{{Cart::getTotal()}}</span></p>
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
       $(".qty_"+id).val(result);
     }});
    });
    $(".cart_quantity_down").click(function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      $.ajax({url: "/decrease_qty/"+id, success: function(result){
        console.log("qty"+id);
       $(".qty_"+id).val(result);
     }});
    });
    $('.update_cart').click(function(e){
        e.preventDefault();
        location.reload();
    });
});
</script>
@endsection
