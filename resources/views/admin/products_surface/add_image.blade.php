
@extends('admin.master')
@section('title')
    Add Product surface
@endsection
@section('header')
<style>
  input{
    margin-bottom: 20px;
  }
</style>
@endsection
@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add product surface</h3>
        </div>
        {!! Form::open(['url' => 'admin/products_surface/addimages', 'files' => true]) !!}
          <div class="box-body">
{{ Form::hidden('sur_id', $id) }}
            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
            {!! Form::label('image', 'Product Surface Image')!!}

            {!!Form::file('image',null,['class'=>'form-control'])!!}
              @if ($errors->has('image'))
                  <span class="help-block">
                      <strong>{{ $errors->first('image') }}</strong>
                  </span>
              @endif
            </div>

            <div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
            {!! Form::label('color', 'Color')!!}

            {!!Form::file('color',null,['class'=>'form-control'])!!}
              @if ($errors->has('color'))
                  <span class="help-block">
                      <strong>{{ $errors->first('color') }}</strong>
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
