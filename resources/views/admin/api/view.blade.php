@extends('admin.master')

@section('title')
    Token - {{$token->name}}
@endsection

@section('header')
  <link rel="stylesheet" type="text/css" href="/admin/sweetalert.css">
  <style>
  .image_picker{
    display: block !important;
  }
  .img-thumbnail{
    border: 5px solid #ddd;
    margin: 5px;
    padding: 0px;
  }
  .selected{
    border: 5px solid #0088cc;
  }
  .modal-body{
      height:600px;
      overflow:auto;
  }
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
    <li><a href ="{{url('/admin/api_tokens')}}">Tokens</a></li>
    <li class="active">{{$token->name}}</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">{{$token->name}}</h3>
        </div>
        {!! Form::model($token,['route'=>['api_tokens.update',$token->id],'files'=>true,'method'=>'patch'])!!}
          <div class="box-body">
            @include ('admin.api.form')
          </div>

          <div class="box-footer">
            {!! Form::submit('Save',['class'=>'btn btn-primary pull-right '])!!}
            {!! Form::close()!!}

            {!! Form::model($token,['route'=>['api_tokens.destroy',$token->id],'method'=>'delete','style'=>'display:inline-block'])!!}
              {!! Form::submit('Delete token',['class'=>'btn btn-primary delete_token', 'data-id' => $token->id])!!}
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
  //delete product
  $(".delete_token").click(function(e){
    e.preventDefault();

    var token_id = $(this).attr("data-id");
    swal({
      title: "Are you sure you want to delete this token ?",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Delete",
      cancelButtonText: "Cancel",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm){
      if (isConfirm) {
        $.ajax({url: "/admin/api_tokens/delete/"+token_id,
          success: function(result){
            $(".sweet-overlay").hide();
            $("div.sweet-alert").css('display','none');
            location.href="/admin/api_tokens";
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
