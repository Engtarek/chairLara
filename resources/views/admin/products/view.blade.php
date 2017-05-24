@extends('admin.master')

@section('title')
    Product - {{$product->name}}
@endsection

@section('header')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
@endsection

@section('content')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href ="{{url('/admin/products')}}">Products</a></li>
    <li class="active">{{$product->name}}</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$product->name}} product</h3>
        </div>
        {!! Form::model($product,['route'=>['products.update',$product->id],'files'=>true,'method'=>'patch'])!!}
          <div class="box-body">
            @include ('admin.products.form')
          </div>

          <div class="box-footer">
            {!! Form::submit('Save',['class'=>'btn btn-primary pull-right '])!!}
            {!! Form::close()!!}

            {!! Form::model($product,['route'=>['products.destroy',$product->id],'method'=>'delete','style'=>'display:inline-block'])!!}
              {!! Form::submit('Delete product',['class'=>'btn btn-primary'])!!}
            {!! Form::close()!!}
          </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('footer')


@endsection
