@extends('admin.master')

@section('title')
    Api Outh
@endsection

@section('header')

@endsection

@section('content')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Api Outh</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title" >Api Outh</h3>
        </div>



          <div class="tab-content" id="app">
            <passport-clients></passport-clients>
            <passport-authorized-clients></passport-authorized-clients>
            <passport-personal-access-tokens></passport-personal-access-tokens>
          </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('footer')
<script src="{{mix('/custom/js/app.js')}}"></script>
@endsection
