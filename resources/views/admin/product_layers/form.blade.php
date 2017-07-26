@if(!empty($product_id))
{{ Form::hidden('product_id', $product_id) }}
@endif
 <div class="form-group {{ $errors->has('rankname_en') ? ' has-error' : '' }}">
  <label for="">English Layer Name</label>
  {!!Form::text('rankname_en',null,['class'=>'form-control','placeholder'=>'Enter english Layer Name'])!!}
  @if ($errors->has('rankname_en'))
      <span class="help-block">
          <strong>{{ $errors->first('rankname_en') }}</strong>
      </span>
  @endif
</div>

<div class="form-group {{ $errors->has('rankname_ar') ? ' has-error' : '' }}">
 <label for="">Arabic Layer Name</label>
 {!!Form::text('rankname_ar',null,['class'=>'form-control','placeholder'=>'Enter arabic Layer Name'])!!}
 @if ($errors->has('rankname_ar'))
     <span class="help-block">
         <strong>{{ $errors->first('rankname_ar') }}</strong>
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
  <button type="button" class=" layer_image image_picker btn btn-default " data-toggle="modal" data-target="#layer_image">Choose image </button>
  <div class="modal fade" id="layer_image" role="dialog">
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
          <button class="btn btn-primary btn-img pull-right" id="layer_image_btn" >select</button>
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
