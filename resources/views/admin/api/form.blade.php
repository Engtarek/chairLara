
<div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
  {!! Form::label('name', 'Name')!!}
  {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Name'])!!}
  @if ($errors->has('name'))
      <span class="help-block">
          <strong>{{ $errors->first('name') }}</strong>
      </span>
  @endif
</div>

<div class="form-group {{ $errors->has('company_name') ? ' has-error' : '' }}">
  {!! Form::label('company_name', 'Company Name')!!}
  {!!Form::text('company_name',null,['class'=>'form-control','placeholder'=>'Company Name'])!!}
  @if ($errors->has('company_name'))
      <span class="help-block">
          <strong>{{ $errors->first('company_name') }}</strong>
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

<div class="form-group {{ $errors->has('active') ? ' has-error' : '' }}">
  {!! Form::label('active', 'Enable')!!}
  {!!Form::select('active',[0=>'unactive',1=>'active'],null,['class'=>'form-control','placeholder'=>'Enable'])!!}
  @if ($errors->has('active'))
      <span class="help-block">
          <strong>{{ $errors->first('active') }}</strong>
      </span>
  @endif
</div>

@if(!empty($token))
<div class="form-group {{ $errors->has('api_token') ? ' has-error' : '' }}">
  {!! Form::label('api_token', 'Api Token')!!}
  {!!Form::text('api_token',null,['class'=>'form-control','placeholder'=>'Api Token'])!!}
  @if ($errors->has('api_token'))
      <span class="help-block">
          <strong>{{ $errors->first('api_token') }}</strong>
      </span>
  @endif
</div>
@endif
