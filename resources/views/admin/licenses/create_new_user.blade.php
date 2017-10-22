
@extends('admin.master')
@section('title')
    Add License
@endsection
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add license</h3>
        </div>
        {!! Form::open(['url' => 'admin/create_new_user','method'=>'post', 'files' => true]) !!}
          <div class="box-body">

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

            <div class="form-group {{ $errors->has('license') ? ' has-error' : '' }}">
              {!! Form::label('license', 'license')!!}
              {!!Form::text('license',null,['class'=>'form-control','placeholder'=>'license'])!!}
              @if ($errors->has('license'))
                  <span class="help-block">
                      <strong>{{ $errors->first('license') }}</strong>
                  </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('website_url') ? ' has-error' : '' }}">
              {!! Form::label('website_url', 'website_url')!!}
              {!!Form::text('website_url',null,['class'=>'form-control','placeholder'=>'website_url'])!!}
              @if ($errors->has('website_url'))
                  <span class="help-block">
                      <strong>{{ $errors->first('website_url') }}</strong>
                  </span>
              @endif
            </div>
            {!!Form::submit('Save',['class'=>'btn btn-primary pull-right'])!!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>
@endsection
