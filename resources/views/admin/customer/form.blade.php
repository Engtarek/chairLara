


<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
  <label for="">name</label>
  {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Last name'])!!}
  @if ($errors->has('name'))
      <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
  @endif
</div>


<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
  <label for="">Email</label>
  {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter Email'])!!}
  @if ($errors->has('email'))
      <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
      </span>
  @endif
</div>


<div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
  <label for="">Phone</label>
  {!!Form::text('phone',null,['class'=>'form-control','placeholder'=>'Enter Phone'])!!}
  @if ($errors->has('phone'))
      <span class="help-block">
          <strong>{{ $errors->first('phone') }}</strong>
      </span>
  @endif
</div>

<div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
  <label for="">Country</label>
  {!!Form::text('country',null,['class'=>'form-control','placeholder'=>'Enter State'])!!}
  @if ($errors->has('country'))
      <span class="help-block">
          <strong>{{ $errors->first('country') }}</strong>
      </span>
  @endif
</div>

<div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
  <label for="">City</label>
  {!!Form::text('city',null,['class'=>'form-control','placeholder'=>'Enter City'])!!}
  @if ($errors->has('city'))
      <span class="help-block">
          <strong>{{ $errors->first('city') }}</strong>
      </span>
  @endif
</div>

<div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
  <label for="">Address</label>
  {!!Form::text('address',null,['class'=>'form-control','placeholder'=>'Enter Address'])!!}
  @if ($errors->has('address'))
      <span class="help-block">
          <strong>{{ $errors->first('address') }}</strong>
      </span>
  @endif
</div>
