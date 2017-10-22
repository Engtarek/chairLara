@extends('admin.master')
@section('title')
    Licenses
@endsection
@section('header')

  <link rel="stylesheet" type="text/css" href="/admin/sweetalert.css">
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

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
    <li class="active">Licenses</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row ">
    <div class="col-xs-6">


      <span style="font-weight: bold;font-size: 21px;">Licenses</span>

    </div>
    <div class="col-xs-4 col-xs-offset-2">
      <!-- <a href="{{url('/admin/users/create')}}" class="btn btn-default pull-right">add</a> -->
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
      <table class="table table-striped table-responsive ">
        <thead>
          <tr>
            <th> # </th>
            <th> license </th>
            <th> website_url </th>
            <th>  </th>
            <th>  </th>
          </tr>
        </thead>
        <tbody>
          @foreach($licenses as $key=>$license)
            <tr id="lic_{{$license->id}}">
              <td> {{$key+1}} </td>
              <td> {{$license->license}} </td>
              <td> {{$license->website_url}} </td>
              <td>
                @if($license->enable == 1)
                  <input type="checkbox" name="check" class="enable" id="{{$license->id}}" checked  data-toggle="toggle">
                @else
                  <input type="checkbox" name="check" class="enable" id="{{$license->id}}"  data-toggle="toggle">
                @endif
              </div>
              </td>
              <td><button class='btn btn-danger glyphicon glyphicon-remove delete_license' data-id ='{{$license->id}}' ></button></td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div>
    </div>
    </div>
  </div>
</section>

@endsection
@section('footer')
<script src="/admin/sweetalert.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
$(".enable").change(function(){
  console.log($(this).attr('checked'));
  var id = $(this).attr('id');
  if(this.checked){
    $.ajax({url: "/admin/enable_update/"+id,data: {enable:1},
      success: function(result){
      }});
  }else{
    $.ajax({url: "/admin/enable_update/"+id,data: {enable:0},
      success: function(result){
      }});
  }
});

$(document).on('click','.delete_license',function(e){
  e.preventDefault();
  var license_id = $(this).attr("data-id");
  swal({
   title: "Are you sure you want to delete this license ?",
   showCancelButton: true,
   confirmButtonColor: "#DD6B55",
   confirmButtonText: "Delete",
   cancelButtonText: "Cancel",
   closeOnConfirm: false,
   closeOnCancel: false
 },
 function(isConfirm){
   if (isConfirm) {
     $.ajax({url: "/admin/licenses/delete/"+license_id,
       success: function(result){
         $(".sweet-overlay").hide();
         $("div.sweet-alert").css('display','none');
         $("#lic_"+license_id).hide();
       }
     });
   } else {
     $(".sweet-overlay").hide();
     $("div.sweet-alert").css('display','none');
   }
 });
});
</script>
@endsection
