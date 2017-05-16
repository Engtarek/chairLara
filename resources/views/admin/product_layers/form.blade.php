 <div class="form-group {{ $errors->has('product_id') ? ' has-error' : '' }}">
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
@if(!empty($product_id))
{{ Form::hidden('product_id', $product_id) }}
@endif
