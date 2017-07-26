@extends('admin.master')

@section('title')
    Employee
@endsection

@section('header')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
  <link rel="stylesheet" type="text/css" href="/admin/sweetalert.css">
  <style>
    .sweet-alert h2{
      font-size: 22px;
      margin: 0;
    }
  </style>
@endsection

@section('content')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{url('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href ="{{url('/admin/employees')}}">Employees</a></li>
    <li class="active">{{$employee->name}}</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Employee</h3>
        </div>
        {!! Form::model($employee,['route'=>['employees.update',$employee->id],'files'=>true,'method'=>'patch'])!!}
          <div class="box-body">
            @include ('admin.employees.form')
          </div>

          <div class="box-footer">
            {!! Form::submit('Save',['class'=>'btn btn-primary pull-right '])!!}
            {!! Form::close()!!}

            {!! Form::model($employee,['route'=>['employees.destroy',$employee->id],'method'=>'delete','style'=>'display:inline-block'])!!}
              {!! Form::submit('Delete',['class'=>'btn btn-primary  delete_employee', 'data-id' => $employee->id])!!}
            {!! Form::close()!!}
          </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('footer')
<script src="/admin/sweetalert.min.js"></script>
<script>
$(document).ready(function(){

    //delete layer image
    $(".delete_employee").click(function(e){
      e.preventDefault();
      var employee_id = $(this).attr("data-id");
      swal({
        title: "Are you sure you want to delete this employee ?",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        if (isConfirm) {
          $.ajax({url: "/admin/employees/delete/"+employee_id,
            success: function(result){
              $(".sweet-overlay").hide();
              $("div.sweet-alert").css('display','none');
              location.href="/admin/employees";
            }
          });
        } else {
          $(".sweet-overlay").hide();
          $("div.sweet-alert").css('display','none');
        }
      });
    });
});
</script>

@endsection
