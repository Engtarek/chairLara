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
 @if(!empty($layer->image))
<img src="/products/{{$layer->product_id}}/layers/{{$layer->image}}">
@endif
<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
  {!! Form::label('image', 'Layer image')!!}
  {!!Form::file('image',null,['class'=>'form-control'])!!}
  @if ($errors->has('image'))
    <span class="help-block">
    <strong>{{ $errors->first('image') }}</strong>
    </span>
  @endif
</div>
@if(!empty($product_id))
{{ Form::hidden('product_id', $product_id) }}
@endif
