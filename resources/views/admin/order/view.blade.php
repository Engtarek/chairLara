@extends('admin.master')

@section('title')
    Order
@endsection

@section('header')
<link rel="stylesheet" type="text/css" href="/admin/css/jquery.datetimepicker.css"/>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
@endsection

@section('content')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{url('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href ="{{url('/admin/orders')}}">Orders</a></li>
    <li class="active">{{$order->order_number}}</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Order</h3>
        </div>
        {!! Form::model($order,['route'=>['orders.update',$order->id],'files'=>true,'method'=>'patch'])!!}
          <div class="box-body">
            @include ('admin.order.form')
          </div>

          <div class="box-footer">
            {!! Form::submit('Save',['class'=>'btn btn-primary pull-right '])!!}
            {!! Form::close()!!}

            {!! Form::model($order,['route'=>['orders.destroy',$order->id],'method'=>'delete','style'=>'display:inline-block'])!!}
              {!! Form::submit('Delete',['class'=>'btn btn-primary'])!!}
            {!! Form::close()!!}
          </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('footer')

<script src="/admin/js/jquery.datetimepicker.full.min.js"></script>
<script>


$('#datetimepicker').datetimepicker({});
</script>
@endsection
