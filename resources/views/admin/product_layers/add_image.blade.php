
@extends('admin.master')
@section('title')
    Add Layer Image
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
          <h3 class="box-title">Add Layer Image</h3>
        </div>
        {!! Form::open(['url' => 'admin/product_layers/addimages', 'files' => true]) !!}
          <div class="box-body">
            {{ Form::hidden('layer_id', $id) }}
            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
              {!! Form::label('image', 'Layer Image')!!}
              {{ Form::hidden('image', '') }}
              <!-- start model -->
              <button type="button" class=" images_image btn btn-default " data-toggle="modal" data-target="#images_image">Choose image </button>
              <div class="modal fade" id="images_image" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div>
                        @foreach($images as $key=>$image)
                          <img data-toggle="tooltip" data-placement="bottom" title="{{$image->name}}" class="img-responsive img-thumbnail"src="/images/sub_{{$image->name}}" id="img_{{$image->id}}" data-value="{{$image->id}}">
                        @endforeach
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-primary btn-img pull-right" id="images_image_btn" >select</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end model -->
              <div><img class="images_image" src=""></div>
              @if ($errors->has('image'))
                <span class="help-block">
                <strong>{{ $errors->first('image') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
              {!! Form::label('color', 'Layer Color')!!}
              {{ Form::hidden('color', '') }}
              <!-- start model -->
              <button type="button" class=" images_color btn btn-default " data-toggle="modal" data-target="#images_color">Choose image </button>
              <div class="modal fade" id="images_color" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div>
                        @foreach($images as $key=>$image)
                          <img data-toggle="tooltip" data-placement="bottom" title="{{$image->name}}" class="img-responsive img-thumbnail"src="/images/sub_{{$image->name}}" id="img_{{$image->id}}" data-value="{{$image->id}}">
                        @endforeach
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-primary btn-img pull-right" id="images_color_btn" >select</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end model -->
              <div><img class="images_color" src=""></div>
              @if ($errors->has('color'))
                <span class="help-block">
                <strong>{{ $errors->first('color') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('item_name_en') ? ' has-error' : '' }}">
              {!! Form::label('item_name_en', 'English Item Name')!!}
              {!!Form::text('item_name_en',null,['class'=>'form-control'])!!}
              @if ($errors->has('item_name_en'))
                <span class="help-block">
                <strong>{{ $errors->first('item_name_en') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('item_name_ar') ? ' has-error' : '' }}">
              {!! Form::label('item_name_ar', 'Arabic Item Name')!!}
              {!!Form::text('item_name_ar',null,['class'=>'form-control'])!!}
              @if ($errors->has('item_name_ar'))
                <span class="help-block">
                <strong>{{ $errors->first('item_name_ar') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('item_distributer_name_en') ? ' has-error' : '' }}">
              {!! Form::label('item_details_name_en', 'English Item Details')!!}
              {!!Form::text('item_distributer_name_en',null,['class'=>'form-control'])!!}
              @if ($errors->has('item_distributer_name_en'))
                <span class="help-block">
                <strong>{{ $errors->first('item_distributer_name_en') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('item_distributer_name_ar') ? ' has-error' : '' }}">
              {!! Form::label('item_details_name_ar', 'Arabic Item Details')!!}
              {!!Form::text('item_distributer_name_ar',null,['class'=>'form-control'])!!}
              @if ($errors->has('item_distributer_name_ar'))
                <span class="help-block">
                <strong>{{ $errors->first('item_distributer_name_ar') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('item_price') ? ' has-error' : '' }}">
              {!! Form::label('item_price', 'Item Price')!!}
              {!!Form::text('item_price',null,['class'=>'form-control'])!!}
              @if ($errors->has('item_price'))
                <span class="help-block">
                <strong>{{ $errors->first('item_price') }}</strong>
                </span>
              @endif
            </div>
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
    // add selected class as default
    $(".images_image").click(function(){
      var image_id = $("[name='image']").val();
      var image_id_prev = "<?php echo $image->image;?>";
      if(image_id != ""){
        $("#images_image").find(".modal-body").find("div").find("#img_"+image_id).addClass("selected");
      }
    });
    $(".images_color").click(function(){
      var color_id = $("[name='color']").val();
      var color_id_prev = "<?php echo $image->color;?>";
      if(color_id != ""){
          $("#images_color").find(".modal-body").find("div").find("#img_"+color_id).addClass("selected");
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
    });
    $("#images_color_btn").click(function(e){
      e.preventDefault();
      var img_src = $("img.selected").attr("src");
      var id = $("img.selected").attr("data-value");
      $('#images_color').modal('hide');
      $("input[name='color']").val(id);
      $('.images_color').attr("src",img_src);
    });

});

</script>
@endsection
