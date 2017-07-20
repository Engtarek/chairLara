@extends('admin.master')

@section('title')
    Product - {{$product->name}}
@endsection

@section('header')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  <style>
  button{
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
  @media (min-width: 768px){
    .modal-dialog {
        width: 80%;
      }
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
              {!! Form::submit('Delete product',['class'=>'btn btn-primary'])!!}
            {!! Form::close()!!}

            {!! Form::open(['url'=>['/admin/cache/'.$product->id],'method'=>'get','style'=>'display:inline-block'])!!}
              {!! Form::submit('Delete cache',['class'=>'btn btn-primary'])!!}
            {!! Form::close()!!}
          </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('footer')

<script>
$(document).ready(function(){
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
