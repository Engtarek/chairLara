
<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
  {!! Form::label('name', 'Product Name')!!}
  {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter product name'])!!}
  @if ($errors->has('name'))
      <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
  @endif
</div>
