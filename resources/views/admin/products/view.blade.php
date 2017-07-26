@extends('admin.master')

@section('title')
    Product - {{$product->name}}
@endsection

@section('header')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  <link rel="stylesheet" type="text/css" href="/admin/sweetalert.css">
  <style>
  .image_picker{
    display: block !important;
  }
  .img-thumbnail{
    border: 5px solid #ddd;
    margin: 5px;
    padding: 0px;
  }
  .selected{
    border: 5px solid #0088cc;
  }
  .modal-body{
      height:600px;
      overflow:auto;
  }
  .sweet-alert h2{
    font-size: 22px;
    margin: 0;
  }
  </style>
@endsection

@section('content')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href ="{{url('/admin/products')}}">Products</a></li>
    <li class="active">{{$product->name}}</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$product->name}} product</h3>
        </div>
        {!! Form::model($product,['route'=>['products.update',$product->id],'files'=>true,'method'=>'patch'])!!}
          <div class="box-body">
            @include ('admin.products.form')
          </div>

          <div class="box-footer">
            {!! Form::submit('Save',['class'=>'btn btn-primary pull-right '])!!}
            {!! Form::close()!!}

            {!! Form::model($product,['route'=>['products.destroy',$product->id],'method'=>'delete','style'=>'display:inline-block'])!!}
              {!! Form::submit('Delete product',['class'=>'btn btn-primary delete_product', 'data-id' => $product->id])!!}
            {!! Form::close()!!}

            {!! Form::open(['url'=>['/admin/cache/'.$product->id],'method'=>'get','style'=>'display:inline-block'])!!}
              {!! Form::submit('Delete cache',['class'=>'btn btn-primary delete_cache', 'data-id' => $product->id])!!}
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
  //delete product
  $(".delete_product").click(function(e){
    e.preventDefault();
    var product_id = $(this).attr("data-id");
    swal({
      title: "Are you sure you want to delete this product ?",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Delete",
      cancelButtonText: "Cancel",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {
        $.ajax({url: "/admin/products/delete/"+product_id,
          success: function(result){
            $(".sweet-overlay").hide();
            $("div.sweet-alert").css('display','none');
            location.href="/admin/products";
          }
        });
      } else {
        $(".sweet-overlay").hide();
        $("div.sweet-alert").css('display','none');
      }
    });
  });

  //delete cache
  $(".delete_cache").click(function(e){
    e.preventDefault();
    var product_id = $(this).attr("data-id");
    swal({
      title: "Are you sure you want to delete cache ?",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Delete",
      cancelButtonText: "Cancel",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {
        $.ajax({url: "/admin/cache/"+product_id,
          success: function(result){
            swal("Deleted!", "Cache has been deleted.");
          }
        });
      } else {
        $(".sweet-overlay").hide();
        $("div.sweet-alert").css('display','none');
      }
    });
  });
    // add selected class as default
    $(".pro_image").click(function(){
      var image_id = $("[name='image']").val();
      var image_id_prev = "<?php echo $product->image;?>";
      if(image_id != ""){
        $("#pro_image").find(".modal-body").find("div").find("#img_"+image_id).addClass("selected");
      }else{
        $("#pro_image").find(".modal-body").find("div").find("#img_"+image_id_prev).addClass("selected");
      }
    });
    $(".pro_init_image").click(function(){
      var init_image_id = $("[name='init_image']").val();
      var init_image_id_prev = "<?php echo $product->init_image;?>";
      if(init_image_id != ""){
          $("#pro_init_image").find(".modal-body").find("div").find("#img_"+init_image_id).addClass("selected");
       }else{
         $("#pro_init_image").find(".modal-body").find("div").find("#img_"+init_image_id_prev).addClass("selected");
       }
    });
    //image
    $("img").click(function(){
      $("img").removeClass("selected");
      $(this).addClass("selected");
    });

    $("#pro_image_btn").click(function(e){
      e.preventDefault();
      var img_src = $("img.selected").attr("src");
      var id = $("img.selected").attr("data-value");
      $('#pro_image').modal('hide');
      $("input[name='image']").val(id);
      $(".exit_pro_image").css("display","none");
      $('.pro_image').attr("src",img_src);
    });
    $("#pro_init_image_btn").click(function(e){
      e.preventDefault();
      var img_src = $("img.selected").attr("src");
      var id = $("img.selected").attr("data-value");
      $('#pro_init_image').modal('hide');
      $("input[name='init_image']").val(id);
      $(".exit_pro_init_image").css("display","none");
      $('.pro_init_image').attr("src",img_src);

    });

});

</script>

@endsection
