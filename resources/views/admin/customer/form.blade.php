<div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
  <label for="">First Name</label>
  {!!Form::text('first_name',null,['class'=>'form-control','placeholder'=>'Enter First name'])!!}
  @if ($errors->has('first_name'))
      <span class="help-block">
          <strong>{{ $errors->first('first_name') }}</strong>
      </span>
  @endif
</div>

<div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
  <label for="">Last Name</label>
  {!!Form::text('last_name',null,['class'=>'form-control','placeholder'=>'Enter Last name'])!!}
  @if ($errors->has('last_name'))
      <span class="help-block">
          <strong>{{ $errors->first('last_name') }}</strong>
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

<div class="form-group {{ $errors->has('Company') ? ' has-error' : '' }}">
  <label for="">Company</label>
  {!!Form::text('Company',null,['class'=>'form-control','placeholder'=>'Enter Company'])!!}
  @if ($errors->has('Company'))
      <span class="help-block">
          <strong>{{ $errors->first('Company') }}</strong>
      </span>
  @endif
</div>
<div class="form-group {{ $errors->has('address1') ? ' has-error' : '' }}">
  <label for="">Address 1</label>
  {!!Form::text('address1',null,['class'=>'form-control','placeholder'=>'Enter Address 1'])!!}
  @if ($errors->has('address1'))
      <span class="help-block">
          <strong>{{ $errors->first('address1') }}</strong>
      </span>
  @endif
</div>
<div class="form-group {{ $errors->has('address2') ? ' has-error' : '' }}">
  <label for="">Address 2</label>
  {!!Form::text('address2',null,['class'=>'form-control','placeholder'=>'Enter Address 2'])!!}
  @if ($errors->has('address2'))
      <span class="help-block">
          <strong>{{ $errors->first('address2') }}</strong>
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
<div class="form-group {{ $errors->has('zip') ? ' has-error' : '' }}">
  <label for="">ZIP</label>
  {!!Form::text('zip',null,['class'=>'form-control','placeholder'=>'Enter Zip'])!!}
  @if ($errors->has('zip'))
      <span class="help-block">
          <strong>{{ $errors->first('zip') }}</strong>
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
  {!!Form::text('country',null,['class'=>'form-control','placeholder'=>'Enter Country'])!!}
  @if ($errors->has('country'))
      <span class="help-block">
          <strong>{{ $errors->first('country') }}</strong>
      </span>
  @endif
</div>

<div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
  <label for="">State</label>
  {!!Form::text('state',null,['class'=>'form-control','placeholder'=>'Enter State'])!!}
  @if ($errors->has('state'))
      <span class="help-block">
          <strong>{{ $errors->first('state') }}</strong>
      </span>
  @endif
</div>
