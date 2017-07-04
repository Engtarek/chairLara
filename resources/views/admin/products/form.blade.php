
<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
  {!! Form::label('name', 'Product Name')!!}
  {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter product name'])!!}
  @if ($errors->has('name'))
      <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
  @endif
</div>

<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
  {!! Form::label('image', 'Product Image')!!}
  {!!Form::file('image',null,['class'=>'form-control','placeholder'=>'Enter product image'])!!}
  @if ($errors->has('image'))
      <span class="help-block">
          <strong>{{ $errors->first('image') }}</strong>
      </span>
  @endif
</div>
@if(!empty($product))
<img src="/products/{{$product->id}}/{{$product->image}}" style="width:150px">
@endif
<div class="form-group {{ $errors->has('init_image') ? ' has-error' : '' }}">
  {!! Form::label('init_image', 'Initial Image')!!}
  {!!Form::file('init_image',null,['class'=>'form-control','placeholder'=>'Enter Initial image'])!!}
  @if ($errors->has('init_image'))
      <span class="help-block">
          <strong>{{ $errors->first('init_image') }}</strong>
      </span>
  @endif
</div>
@if(!empty($product))
 <img src="/products/{{$product->id}}/history/{{$product->init_image}}" style="width:150px">
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
