@extends('admin.master')

@section('title')
    Image
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
    <li><a href ="{{url('/admin/layer_images')}}">Images</a></li>
    <li class="active">{{$image->item_name}}</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Image</h3>
        </div>
        {!! Form::model($image,['route'=>['layer_images.update',$image->id],'files'=>true,'method'=>'patch'])!!}
          <div class="box-body">
            @include ('admin.layer_images.form')
          </div>

          <div class="box-footer">
            {!! Form::submit('Save',['class'=>'btn btn-primary pull-right '])!!}
            {!! Form::close()!!}

            {!! Form::model($image,['route'=>['layer_images.destroy',$image->id],'method'=>'delete','style'=>'display:inline-block'])!!}
              {!! Form::submit('Delete',['class'=>'btn btn-primary delete_layer_image', 'data-id' => $image->id])!!}
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
    $(".delete_layer_image").click(function(e){
      e.preventDefault();
      var layer_image_id = $(this).attr("data-id");
      swal({
        title: "Are you sure you want to delete this image ?",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        if (isConfirm) {
          $.ajax({url: "/admin/layer_images/delete/"+layer_image_id,
            success: function(result){
              $(".sweet-overlay").hide();
              $("div.sweet-alert").css('display','none');
              location.href="/admin/layer_images";
            }
          });
        } else {
          $(".sweet-overlay").hide();
          $("div.sweet-alert").css('display','none');
        }
      });
    });

    // add selected class as default
    $(".images_image").click(function(){
      var image_id = $("[name='image']").val();
      var image_id_prev = "<?php echo $image->image;?>";
      if(image_id != ""){
        $("#images_image").find(".modal-body").find("div").find("#img_"+image_id).addClass("selected");
      }else{
        $("#images_image").find(".modal-body").find("div").find("#img_"+image_id_prev).addClass("selected");
      }
    });
    $(".images_color").click(function(){
      var color_id = $("[name='color']").val();
      var color_id_prev = "<?php echo $image->color;?>";
      if(color_id != ""){
          $("#images_color").find(".modal-body").find("div").find("#img_"+color_id).addClass("selected");
       }else{
         $("#images_color").find(".modal-body").find("div").find("#img_"+color_id_prev).addClass("selected");
       }
    });
    //image
    $("img").click(function(){
      $("img").removeClass("selected");
      $(this).addClass("selected");
    });

    $("#images_image_btn").click(function(e){
      e.preventDefault();
      var img_src = $("img.selected").attr("src");
      var id = $("img.selected").attr("data-value");
      $('#images_image').modal('hide');
      $("input[name='image']").val(id);
      $('.images_image').attr("src",img_src);
      $(".exit_images_image").css("display","none");
    });
    $("#images_color_btn").click(function(e){
      e.preventDefault();
      var img_src = $("img.selected").attr("src");
      var id = $("img.selected").attr("data-value");
      $('#images_color').modal('hide');
      $("input[name='color']").val(id);
      $('.images_color').attr("src",img_src);
        $(".exit_images_color").css("display","none");
    });

});

</script>
@endsection
