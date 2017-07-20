
@extends('admin.master')
@section('title')
    Add Product Layer
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
  @media (min-width: 768px){
    .modal-dialog {
        width: 80%;
      }
  }

</style>
@endsection
@section('content')
 <section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add product Layer</h3>
        </div>
        {!! Form::open(['route' => 'product_layers.store', 'files' => true]) !!}
          <div class="box-body">
            @include('admin.product_layers.form')
            {!!Form::submit('Save',['class'=>'btn btn-primary pull-right'])!!}
          </div>
        {!! Form::close() !!}
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

    $("#layer_image_btn").click(function(e){
      e.preventDefault();
      var img_src = $("img.selected").attr("src");
      var id = $("img.selected").attr("data-value");
      $('#layer_image').modal('hide');
      $("input[name='image']").val(id);
      $('.layer_image').attr("src",img_src);
    });


});

</script>
@endsection
