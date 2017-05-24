@extends('admin.master')
@section('title')
    Order-{{$order->order_number}}
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
            <th> Product Name </th>
            <th> Price </th>
            <th> Quantity </th>
            <th> Total </th>
          </tr>
        </thead>
        <tbody>
          <?php $i=1;?>
          @foreach($order_items as $data)
          <tr>
            <td> {{$i++}} </td>
            <td> {{$data->name}}</td>
            <td> {{$data->price}}</td>
            <td> {{$data->quantity}}</td>
            <td> {{$data->quantity * $data->price}} </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div>
    </div>
    </div>
  </div>
</section>

@endsection
