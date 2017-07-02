
@extends('admin.master')
@section('title')
    Add Product Layer
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
          <h3 class="box-title">Add product Layer</h3>
        </div>
        {!! Form::open(['route' => 'product_layers.store', 'files' => true]) !!}
          <div class="box-body">
            @include('admin.product_layers.form')
            {!!Form::submit('Save',['class'=>'btn btn-primary pull-right'])!!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section> 
@endsection
