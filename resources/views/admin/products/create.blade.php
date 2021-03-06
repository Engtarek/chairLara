
@extends('admin.master')
@section('title')
    Add Product
@endsection
@section('header')
<style>
  input{
    margin-bottom: 20px;
  }
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
  .modal-body{
      height:600px;
      overflow:auto;
  }
</style>
@endsection
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add product</h3>
        </div>
        {!! Form::open(['route' => 'products.store', 'files' => true]) !!}
          <div class="box-body">
            @include('admin.products.form')
            {!!Form::submit('Save',['class'=>'btn btn-primary pull-right'])!!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>
@endsection
@section("footer")
<script>
$(document).ready(function(){

    $(".pro_image").click(function(){
      var image_id = $("[name='image']").val();
      if(image_id != ""){
        $("#pro_image").find(".modal-body").find("div").find("#img_"+image_id).addClass("selected");
      }
    });
    $(".pro_init_image").click(function(){
      var init_image_id = $("[name='init_image']").val();
      if(init_image_id != ""){
          $("#pro_init_image").find(".modal-body").find("div").find("#img_"+init_image_id).addClass("selected");
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
      $('.pro_image').attr("src",img_src);

    });
    $("#pro_init_image_btn").click(function(e){
      e.preventDefault();
      var img_src = $("img.selected").attr("src");
      var id = $("img.selected").attr("data-value");
      $('#pro_init_image').modal('hide');
      $("input[name='init_image']").val(id);
      $('.pro_init_image').attr("src",img_src);
    });

});

</script>
@endsection
