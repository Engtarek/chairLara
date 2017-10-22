@extends('admin.master')

@section('title')
    User - {{$user->name}}
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
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href ="{{url('/admin/users')}}">users</a></li>
    <li class="active">{{$user->name}}</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$user->name}} user</h3>
        </div>
        {!! Form::model($user,['route'=>['users.update',$user->id],'files'=>true,'method'=>'patch'])!!}
          <div class="box-body">
            @include ('admin.users.form')


          </div>

          <div class="box-footer">
            {!! Form::submit('Save',['class'=>'btn btn-primary pull-right '])!!}
            {!! Form::close()!!}

            {!! Form::model($user,['route'=>['users.destroy',$user->id],'method'=>'delete','style'=>'display:inline-block'])!!}
              {!! Form::submit('Delete user',['class'=>'btn btn-primary delete_user', 'data-id' => $user->id])!!}
            {!! Form::close()!!}
            <a href="/admin/licenses/create/{{$user->id}}" class='btn btn-primary'>create license</a>
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
  //delete product
  $(".delete_user").click(function(e){
    e.preventDefault();
    var user_id = $(this).attr("data-id");
    swal({
      title: "Are you sure you want to delete this product ?",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Delete",
      cancelButtonText: "Cancel",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {
        $.ajax({url: "/admin/users/delete/"+user_id,
          success: function(result){
            $(".sweet-overlay").hide();
            $("div.sweet-alert").css('display','none');
            location.href="/admin/users";
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
