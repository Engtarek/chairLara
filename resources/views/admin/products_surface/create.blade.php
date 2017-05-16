
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
        {!! Form::open(['route' => 'products_surface.store', 'files' => true]) !!}
          <div class="box-body">
            @include('admin.products_surface.form')
            {!!Form::submit('Save',['class'=>'btn btn-primary pull-right'])!!}
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</section>
@endsection
