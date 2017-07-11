@extends('admin.master')

@section('title')
    Setting
@endsection

@section('header')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
@endsection

@section('content')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Setting</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Setting</h3>
        </div>
        {!! Form::model($setting,['route'=>['setting.update',$setting->id],'files'=>true,'method'=>'patch'])!!}
        <div class="box-body">
        <div class="form-group {{ $errors->has('slider_show') ? ' has-error' : '' }}">
          {!! Form::label('slider_show', 'Slider appearance')!!}
          {!!Form::select('slider_show',['1'=>'appearnce','2'=>'not-appearnce'],null,['class'=>'form-control','placeholder'=>'Enter slider appearance'])!!}
          @if ($errors->has('slider_show'))
              <span class="help-block">
                  <strong>{{ $errors->first('slider_show') }}</strong>
              </span>
          @endif
        </div>
</div>

          <div class="box-footer">
            {!! Form::submit('Update',['class'=>'btn btn-primary pull-right '])!!}
            {!! Form::close()!!}
          </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('footer')


@endsection
