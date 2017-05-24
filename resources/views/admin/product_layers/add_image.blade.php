
@extends('admin.master')
@section('title')
    Add Layer Image
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
          <h3 class="box-title">Add Layer Image</h3>
        </div>
        {!! Form::open(['url' => 'admin/product_layers/addimages', 'files' => true]) !!}
          <div class="box-body">
            {{ Form::hidden('layer_id', $id) }}
            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
              {!! Form::label('image', 'Layer Image')!!}
              {!!Form::file('image',null,['class'=>'form-control'])!!}
              @if ($errors->has('image'))
                <span class="help-block">
                <strong>{{ $errors->first('image') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}">
              {!! Form::label('color', 'Layer Color')!!}
              {!!Form::file('color',null,['class'=>'form-control'])!!}
              @if ($errors->has('color'))
                <span class="help-block">
                <strong>{{ $errors->first('color') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('item_name') ? ' has-error' : '' }}">
              {!! Form::label('item_name', 'Item Name')!!}
              {!!Form::text('item_name',null,['class'=>'form-control'])!!}
              @if ($errors->has('item_name'))
                <span class="help-block">
                <strong>{{ $errors->first('item_name') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('item_distributer_name') ? ' has-error' : '' }}">
              {!! Form::label('item_details_name', 'Item Details')!!}
              {!!Form::text('item_distributer_name',null,['class'=>'form-control'])!!}
              @if ($errors->has('item_distributer_name'))
                <span class="help-block">
                <strong>{{ $errors->first('item_distributer_name') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('item_price') ? ' has-error' : '' }}">
              {!! Form::label('item_price', 'Item Price')!!}
              {!!Form::text('item_price',null,['class'=>'form-control'])!!}
              @if ($errors->has('item_price'))
                <span class="help-block">
                <strong>{{ $errors->first('item_price') }}</strong>
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
