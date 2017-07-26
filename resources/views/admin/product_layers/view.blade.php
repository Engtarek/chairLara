@extends('admin.master')

@section('title')
    Product Layer
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
    <li><a href="{{url('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href ="{{url('/admin/product_layers')}}">Layers</a></li>
    <li class="active">{{$layer->rankname}}</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Product Layer</h3>
        </div>
        {!! Form::model($layer,['route'=>['product_layers.update',$layer->id],'files'=>true,'method'=>'patch'])!!}
          <div class="box-body">
            @include ('admin.product_layers.form')
          </div>

          <div class="box-footer">
            {!! Form::submit('Save',['class'=>'btn btn-primary pull-right '])!!}
            {!! Form::close()!!}

            {!! Form::model($layer,['route'=>['product_layers.destroy',$layer->id],'method'=>'delete','style'=>'display:inline-block'])!!}
              {!! Form::submit('Delete',['class'=>'btn btn-primary delete_layer', 'data-id' => $layer->id])!!}
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
    //delete layer
    $(".delete_layer").click(function(e){
      e.preventDefault();
      var layer_id = $(this).attr("data-id");
      swal({
        title: "Are you sure you want to delete this layer ?",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        if (isConfirm) {
          $.ajax({url: "/admin/product_layers/delete/"+layer_id,
            success: function(result){
              $(".sweet-overlay").hide();
              $("div.sweet-alert").css('display','none');
              location.href="/admin/product_layers";
            }
          });
        } else {
          $(".sweet-overlay").hide();
          $("div.sweet-alert").css('display','none');
        }
      });
    });

    // add selected class as default
    $(".layer_image").click(function(){
      var image_id = $("[name='image']").val();
      var image_id_prev = "<?php echo $layer->image;?>";
      if(image_id != ""){
        $("#layer_image").find(".modal-body").find("div").find("#img_"+image_id).addClass("selected");
      }else{
          $("#layer_image").find(".modal-body").find("div").find("#img_"+image_id_prev).addClass("selected");
      }
    });
    //image
    $("img").click(function(){
      $("img").removeClass("selected");
      $(this).addClass("selected");
    });

    $("#layer_image_btn").click(function(e){
      e.preventDefault();
      var img_src = $("img.selected").attr("src");
      var id = $("img.selected").attr("data-value");
      $('#layer_image').modal('hide');
      $("input[name='image']").val(id);
      $('.exit_layer_image').css("display","none");
      $('.layer_image').attr("src",img_src);
    });

});

</script>
@endsection
