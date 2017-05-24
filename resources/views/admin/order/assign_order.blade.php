@extends('admin.master')

@section('title')
    Assign Order
@endsection

@section('header')
@endsection

@section('content')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{url('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href ="{{url('/admin/orders')}}">Orders</a></li>
    <li class="active">Assign Order</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Assign Order</h3>
        </div>
        {!! Form::open(['url' => '/admin/orders/assign'])!!}
        {!!Form::hidden('order_id',$id)!!}
          <div class="box-body">
            <div class="form-group">
              <label for="">Employee</label>
              {!!Form::select('employee_id',employees(),null,['class'=>'form-control','placeholder'=>'Choose the employee','required'=>'required'])!!}
            </div>
          </div>

          <div class="box-footer">
            {!! Form::submit('Save',['class'=>'btn btn-primary pull-right '])!!}
            {!! Form::close()!!}
          </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('footer')

<script src="/admin/js/jquery.datetimepicker.full.min.js"></script>
<script>


$('#datetimepicker').datetimepicker({});
</script>
@endsection
