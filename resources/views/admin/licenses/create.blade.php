
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
        {!! Form::open(['route' => 'licenses.store', 'files' => true]) !!}
          <div class="box-body">

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
            {{ Form::hidden('user_id', $user_id) }}
            {!!Form::submit('Save',['class'=>'btn btn-primary pull-right'])!!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>
@endsection
