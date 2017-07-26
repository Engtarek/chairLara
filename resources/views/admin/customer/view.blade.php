@extends('admin.master')

@section('title')
    Customer
@endsection

@section('header')
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
    <li><a href ="{{url('/admin/customers')}}">customers</a></li>
    <li class="active">{{$customer->name}}</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Customer</h3>
        </div>
        {!! Form::model($customer,['route'=>['customers.update',$customer->id],'files'=>true,'method'=>'patch'])!!}
          <div class="box-body">
            @include ('admin.customer.form')
          </div>

          <div class="box-footer">
            {!! Form::submit('Save',['class'=>'btn btn-primary pull-right '])!!}
            {!! Form::close()!!}

            {!! Form::model($customer,['route'=>['customers.destroy',$customer->id],'method'=>'delete','style'=>'display:inline-block'])!!}
              {!! Form::submit('Delete',['class'=>'btn btn-primary delete_customer', 'data-id' => $customer->id])!!}
            {!! Form::close()!!}
          </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('footer')
<script src="/admin/sweetalert.min.js"></script>
<script>
$(document).ready(function(){

    //delete layer image
    $(".delete_customer").click(function(e){
      e.preventDefault();
      var customer_id = $(this).attr("data-id");
      swal({
        title: "Are you sure you want to delete this customer ?",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        if (isConfirm) {
          $.ajax({url: "/admin/customers/delete/"+customer_id,
            success: function(result){
              $(".sweet-overlay").hide();
              $("div.sweet-alert").css('display','none');
              location.href="/admin/customers";
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
