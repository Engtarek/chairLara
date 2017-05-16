@extends('pages.layout')
@section('title')
  Products
@endsection

@section('style')
  <style>
    .flex-container{
      width:90%;
      margin: auto;
    }
  </style>
@endsection

@section('content')
  <div class="content flex-container">
    <h1>All our products </h1>
    @foreach ($products as $product)
      <div class="flex-item">
        <a href="/product/{{$product->id}}">
        <p>{{$product->name}}</p>
      </a>

      </div>
    @endforeach

  </div>
@endsection
