
<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
  {!! Form::label('name', 'Name')!!}
  {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Name'])!!}
  @if ($errors->has('name'))
      <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
  @endif
</div>
<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
  {!! Form::label('email', 'Email')!!}
  {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Email'])!!}
  @if ($errors->has('email'))
      <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
      </span>
  @endif
</div>
@if(empty($user))
<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
  {!! Form::label('password', 'Password')!!}
  {!!Form::password('password',['class'=>'form-control','placeholder'=>'Password'])!!}
  @if ($errors->has('password'))
      <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
      </span>
  @endif
</div>
@endif

<div class="form-group {{ $errors->has('role_id') ? ' has-error' : '' }}">
  {!! Form::label('role_id', 'Role')!!}
  {!!Form::select('role_id',roles(),null,['class'=>'form-control','placeholder'=>'Role'])!!}
  @if ($errors->has('role_id'))
      <span class="help-block">
          <strong>{{ $errors->first('role_id') }}</strong>
      </span>
  @endif
</div>
<div class="form-group {{ $errors->has('confirm') ? ' has-error' : '' }}">
  {!! Form::label('confirm', 'Status')!!}
  {!!Form::select('confirm',[0=>'Pending',1=>'Active'],null,['class'=>'form-control','placeholder'=>'Status'])!!}
  @if ($errors->has('confirm'))
      <span class="help-block">
          <strong>{{ $errors->first('confirm') }}</strong>
      </span>
  @endif
</div>
