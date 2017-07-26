@extends('admin.master')
@section('title')
    Order-{{$order->order_number}}
@endsection
@section('header')
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
</style>
@endsection

@section('content')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url('/admin/orders')}}"><i class="fa fa-dashboard"></i> Orders</a></li>
    <li class="active">{{$order->order_number}}</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row ">
    <div class="col-xs-6">
      <span style="font-weight: bold;font-size: 21px;">{{$order->order_number}}</span>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
      <table class="table table-bordered .table-responsive " id="data">
        <thead>
          <tr>
            <th> # </th>
            <th>  </th>
            <th> Product Name </th>
            <th> Price </th>
              <th> Size </th>
            <th> Quantity </th>
            <th> Total </th>
          </tr>
        </thead>
        <tbody>

          <?php $i=1;?>
          @foreach($order_items as $data)
          <?php
              $id = explode("&",$data->id)[0];
              $imagename="";
              $array = explode("-",$id);
              foreach ($array as $value){
                $product_id=$array[0];
                foreach(explode(".",$value) as $data2){
                  $imagename .= $data2;
                }
             }
          ?>
          <tr>
            <td> {{$i++}} </td>
            <td>
              <div class="parent">
                <?php if( file_exists("products/".$product_id."/history/".$imagename.".png")){?>
                  <div class="chair" style="background: url(/products/{{$product_id}}/history/{{$imagename}}.png)"></div>
                <?php } else{  ?>
                  <div class="chair" style="background: url(/images/{{\App\Product::find($product_id)->product_init_image->name}})"></div>
                <?php  }?>
              </div>
            </td>
            <td> {{$data->name['name_en']}} </td>
            <td> {{$data->price}}</td>
            <td> {{$data->attributes['size']}}</td>
            <td> {{$data->quantity}}</td>
            <td> {{$data->quantity * $data->price}} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <a class="btn btn-primary pull-right" href="{{url('/admin/orders/pdf/'.$order->id)}}"> Download </a>
      <div>
    </div>
    </div>
  </div>
</section>

@endsection
