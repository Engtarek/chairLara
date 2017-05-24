
@if(!empty($image))
<img src="/products/{{$product_id}}/image/{{$image->image}}" style="width:250px">
@endif
<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
  {!! Form::label('image', 'Layer Image')!!}
  {!!Form::file('image',null,['class'=>'form-control'])!!}
  @if ($errors->has('image'))
    <span class="help-block">
    <strong>{{ $errors->first('image') }}</strong>
    </span>
  @endif
</div>
@if(!empty($image))
<img src="/products/{{$product_id}}/color/{{$image->color}}" style="width:150px">
@endif
<div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
  {!! Form::label('color', 'Layer Color')!!}
  {!!Form::file('color',null,['class'=>'form-control'])!!}
  @if ($errors->has('color'))
    <span class="help-block">
    <strong>{{ $errors->first('color') }}</strong>
    </span>
  @endif
</div>
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
