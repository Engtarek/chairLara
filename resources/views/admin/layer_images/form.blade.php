

<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
  {!! Form::label('image', 'Layer Image')!!}
  {{ Form::hidden('image', '') }}
  <!-- start model -->
  <button type="button" class="btn btn-default " data-toggle="modal" data-target="#images_image">Choose image </button>
  <div class="modal fade" id="images_image" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div>
            @foreach($images as $key=>$img)
              <img class="img-responsive img-thumbnail"src="/images/sub_{{$img->name}}" data-value="{{$img->id}}">
            @endforeach
          </div>
          <button class="btn btn-primary btn-img pull-right" id="images_image_btn" >select</button>
          <div style="clear:both"></div>
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
@if(!empty($image))
<img class="exit_images_image" src="/images/sub_{{$image->get_image->name}}" >
@endif

<div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
  {!! Form::label('color', 'Layer Color')!!}
  {{ Form::hidden('color', '') }}
  <!-- start model -->
  <button type="button" class="btn btn-default " data-toggle="modal" data-target="#images_color">Choose image </button>
  <div class="modal fade" id="images_color" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div>
            @foreach($images as $key=>$img)
              <img class="img-responsive img-thumbnail"src="/images/sub_{{$img->name}}" data-value="{{$img->id}}">
            @endforeach
          </div>
          <button class="btn btn-primary btn-img pull-right" id="images_color_btn" >select</button>
          <div style="clear:both"></div>
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
@if(!empty($image))
<img class="exit_images_color" src="/images/sub_{{$image->get_color->name}}" >
@endif
<div class="form-group {{ $errors->has('item_name') ? ' has-error' : '' }}">
  {!! Form::label('item_name', 'Item Name')!!}
  {!!Form::text('item_name',null,['class'=>'form-control'])!!}
  @if ($errors->has('item_name'))
    <span class="help-block">
    <strong>{{ $errors->first('item_name') }}</strong>
    </span>
  @endif
</div>
<div class="form-group {{ $errors->has('item_distributer_name') ? ' has-error' : '' }}">
  {!! Form::label('item_details_name', 'Item Details')!!}
  {!!Form::text('item_distributer_name',null,['class'=>'form-control'])!!}
  @if ($errors->has('item_distributer_name'))
    <span class="help-block">
    <strong>{{ $errors->first('item_distributer_name') }}</strong>
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
@if(!empty($image))
<div class="form-group {{ $errors->has('product_layers_id') ? ' has-error' : '' }}">
  {!! Form::label('product_layers_id', 'Layer Name')!!}
  {!!Form::select('product_layers_id',layers(),null,['class'=>'form-control'])!!}
  @if ($errors->has('product_layers_id'))
    <span class="help-block">
    <strong>{{ $errors->first('product_layers_id') }}</strong>
    </span>
  @endif
</div>
@endif
