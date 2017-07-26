
<div class="form-group {{ $errors->has('name_en') ? ' has-error' : '' }}">
  {!! Form::label('name_en', 'English Product Name')!!}
  {!!Form::text('name_en',null,['class'=>'form-control','placeholder'=>'Enter english product name'])!!}
  @if ($errors->has('name_en'))
      <span class="help-block">
          <strong>{{ $errors->first('name_en') }}</strong>
      </span>
  @endif
</div>
<div class="form-group {{ $errors->has('name_ar') ? ' has-error' : '' }}">
  {!! Form::label('name_ar', 'Arabic Product Name')!!}
  {!!Form::text('name_ar',null,['class'=>'form-control','placeholder'=>'Enter arabic product name'])!!}
  @if ($errors->has('name_ar'))
      <span class="help-block">
          <strong>{{ $errors->first('name_ar') }}</strong>
      </span>
  @endif
</div>
<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
  {!! Form::label('image', 'Product Image')!!}
  {{ Form::hidden('image', '') }}
  <!-- start model -->
  <button type="button" class=" pro_image image_picker btn btn-default " data-toggle="modal" data-target="#pro_image">Choose image </button>
  <div class="modal fade" id="pro_image" role="dialog">
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
          <button class="btn btn-primary btn-img pull-right" id="pro_image_btn" >select</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end model -->
  <div><img class="pro_image" src=""></div>
  @if ($errors->has('image'))
      <span class="help-block">
          <strong>{{ $errors->first('image') }}</strong>
      </span>
  @endif
</div>
@if(!empty($product))
<img class="exit_pro_image" src="/images/sub_{{$product->product_image->name}}" style="width:150px">
@endif
<div class="form-group {{ $errors->has('init_image') ? ' has-error' : '' }}">
  {!! Form::label('init_image', 'Initial Image')!!}
  {{ Form::hidden('init_image', '') }}
  <!-- start model -->
  <button type="button" class=" pro_init_image image_picker btn btn-default " data-toggle="modal" data-target="#pro_init_image">Choose initial image  </button>
  <div class="modal fade" id="pro_init_image" role="dialog">
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
         <button class="btn btn-primary btn-img pull-right" id="pro_init_image_btn" >select</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end model -->
  <div><img class="pro_init_image" src=""></div>
  @if ($errors->has('init_image'))
      <span class="help-block">
          <strong>{{ $errors->first('init_image') }}</strong>
      </span>
  @endif
</div>
@if(!empty($product))
 <img class="exit_pro_init_image" src="/images/sub_{{$product->product_init_image->name}}" style="width:150px">
@endif
<div class="form-group {{ $errors->has('show') ? ' has-error' : '' }}">
  {!! Form::label('show', 'Product Apperance')!!}
  {!!Form::select('show',appearnce(),null,['class'=>'form-control','placeholder'=>'Enter product appearance'])!!}
  @if ($errors->has('show'))
      <span class="help-block">
          <strong>{{ $errors->first('show') }}</strong>
      </span>
  @endif
</div>
