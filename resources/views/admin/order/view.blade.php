@extends('admin.master')

@section('title')
    Order
@endsection

@section('header')
<link rel="stylesheet" type="text/css" href="/admin/css/jquery.datetimepicker.css"/>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  <link rel="stylesheet" type="text/css" href="/admin/sweetalert.css">
  <style>
  .sweet-alert h2{
    font-size: 22px;
    margin: 0;
  }

  </style>
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
              {!! Form::submit('Delete',['class'=>'btn btn-primary delete_order', 'data-id' => $order->id])!!}
            {!! Form::close()!!}
          </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('footer')

<script src="/admin/js/jquery.datetimepicker.full.min.js"></script>
<script src="/admin/sweetalert.min.js"></script>
<script>

$('#datetimepicker').datetimepicker({});
$(document).ready(function(){

    //delete layer image
    $(".delete_order").click(function(e){
      e.preventDefault();
      var order_id = $(this).attr("data-id");
      swal({
        title: "Are you sure you want to delete this order ?",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        if (isConfirm) {
          $.ajax({url: "/admin/orders/delete/"+order_id,
            success: function(result){
              $(".sweet-overlay").hide();
              $("div.sweet-alert").css('display','none');
              location.href="/admin/orders";
            }
          });
        } else {
          $(".sweet-overlay").hide();
          $("div.sweet-alert").css('display','none');
        }
      });
    });
  });



</script>
@endsection
