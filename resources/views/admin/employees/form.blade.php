
<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
  <label for="">Name</label>
  {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Enter Name'])!!}
  @if ($errors->has('name'))
      <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
  @endif
</div>


<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
  <label for="">Title</label>
  {!!Form::text('title',null,['class'=>'form-control','placeholder'=>'Enter Title'])!!}
  @if ($errors->has('title'))
      <span class="help-block">
          <strong>{{ $errors->first('title') }}</strong>
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


<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
  <label for="">Email</label>
  {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Enter Email'])!!}
  @if ($errors->has('email'))
      <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
      </span>
  @endif
</div>
