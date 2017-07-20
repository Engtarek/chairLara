@if(!empty($product_id))
{{ Form::hidden('product_id', $product_id) }}
@endif
 <div class="form-group {{ $errors->has('rankname') ? ' has-error' : '' }}">
  <label for="">Layer Name</label>
  {!!Form::text('rankname',null,['class'=>'form-control','placeholder'=>'Enter Layer Name'])!!}
  @if ($errors->has('rankname'))
      <span class="help-block">
          <strong>{{ $errors->first('rankname') }}</strong>
      </span>
  @endif
</div>
<div class="form-group {{ $errors->has('rank') ? ' has-error' : '' }}">
  <label for="">Layer order</label>
  {!!Form::text('rank',null,['class'=>'form-control','placeholder'=>'Enter Layer Order'])!!}
  @if ($errors->has('rank'))
      <span class="help-block">
          <strong>{{ $errors->first('rank') }}</strong>
      </span>
  @endif
</div>

<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
  {!! Form::label('image', 'Layer image')!!}
  {{ Form::hidden('image', '') }}
  <!-- start model -->
  <button type="button" class="btn btn-default " data-toggle="modal" data-target="#layer_image">Choose image </button>
  <div class="modal fade" id="layer_image" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div>
            @foreach($images as $key=>$image)
              <img class="img-responsive img-thumbnail"src="/images/sub_{{$image->name}}" data-value="{{$image->id}}">
            @endforeach
          </div>
          <button class="btn btn-primary btn-img pull-right" id="layer_image_btn" >select</button>
          <div style="clear:both"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- end model -->
  <div><img class="layer_image" src=""></div>
  @if(!empty($layer->image))
 <img class="exit_layer_image" src="/images/sub_{{$layer->layer_image->name}}">
 @endif
  @if ($errors->has('image'))
    <span class="help-block">
    <strong>{{ $errors->first('image') }}</strong>
    </span>
  @endif
</div>
