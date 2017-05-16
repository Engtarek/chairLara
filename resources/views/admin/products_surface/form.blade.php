<!--
<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
{!! Form::label('image', 'Product Surface Image')!!}
@if(!empty($product))
<img src="{{Request::root()}}/products/{{$product->product_id}}/f/image/{{$product->image}}" alt="" style="display:block;width:150px;height:150px">
@endif
{!!Form::file('image',null,['class'=>'form-control'])!!}
  @if ($errors->has('image'))
      <span class="help-block">
          <strong>{{ $errors->first('image') }}</strong>
      </span>
  @endif
</div>

<div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
{!! Form::label('color', 'Color')!!}
@if(!empty($product))
<img src="{{Request::root()}}/products/{{$product->product_id}}/f/color/{{$product->color}}" alt="" style="display:block;width:150px;height:150px">
@endif
{!!Form::file('color',null,['class'=>'form-control'])!!}
  @if ($errors->has('color'))
      <span class="help-block">
          <strong>{{ $errors->first('color') }}</strong>
      </span>
  @endif
</div> -->
<div class="form-group {{ $errors->has('product_id') ? ' has-error' : '' }}">
  <label for="">Product surfaces</label>
  {!!Form::text('rankname',null,['class'=>'form-control','placeholder'=>'Enter Product surface'])!!}
  @if ($errors->has('rankname'))
      <span class="help-block">
          <strong>{{ $errors->first('rankname') }}</strong>
      </span>
  @endif
</div>
<div class="form-group {{ $errors->has('product_id') ? ' has-error' : '' }}">
  <label for="">Product surfaces piority</label>
  {!!Form::text('rank',null,['class'=>'form-control','placeholder'=>'Enter Product surfaces piority'])!!}
  @if ($errors->has('rank'))
      <span class="help-block">
          <strong>{{ $errors->first('rank') }}</strong>
      </span>
  @endif
</div>

<div class="form-group {{ $errors->has('product_id') ? ' has-error' : '' }}">
  <label for="">product</label>
  {!!Form::select('product_id',product(),null,['class'=>'form-control','placeholder'=>'Enter Product'])!!}
  @if ($errors->has('product_id'))
      <span class="help-block">
          <strong>{{ $errors->first('product_id') }}</strong>
      </span>
  @endif
</div>
