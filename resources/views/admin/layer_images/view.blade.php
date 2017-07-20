@extends('admin.master')

@section('title')
    Image
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
              {!! Form::submit('Delete',['class'=>'btn btn-primary'])!!}
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
