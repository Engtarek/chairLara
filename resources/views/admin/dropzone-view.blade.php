@extends('admin.master')

@section('title')
    Images area
@endsection

@section('header')
<link rel="stylesheet" href="/admin/image-picker.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="/admin/sweetalert.css">

 <style>
.tab-content{
  padding-top: 25px;
}

.img-thumbnail{
  border: 5px solid #ddd;
  margin: 5px;
  padding: 0px;
}
.selected{
  border: 5px solid #0088cc;
}
.pic{
  position: relative;
  display: inline-block;
}
.pic-delete{
position: absolute;
right: 15px;
top: 15px;
/*border: 1px solid #000;
padding: 1px 2px;*/
cursor: pointer;
}
.sweet-alert h2{
  font-size: 23px;
  margin: 0;
}
 </style>

@endsection

@section('content')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Images area</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Images area</h3>
        </div>

          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#images">Images</a></li>
            <li ><a data-toggle="tab" href="#upload">Upload image</a></li>
          </ul>

          <div class="tab-content">
            <div id="upload" class="tab-pane fade ">
              {!! Form::open([ 'route' => [ 'dropzone.store' ], 'files' => true, 'enctype' => 'multipart/form-data', 'class' => 'dropzone', 'id' => 'image-upload' ]) !!}
              {!! Form::close() !!}
            </div>
            <div id="images" class="tab-pane fade in active">
              <div>
                @foreach($images as $key=>$image)
                  <div class="pic" id="{{$image->id}}">
                      <img data-toggle="tooltip" data-placement="bottom" title="{{$image->name}}" class="img-responsive img-thumbnail"src="/images/sub_{{$image->name}}"  data-value="{{$image->id}}">
                      <p class="pic-delete" data-image-id="{{$image->id}}"><i class="glyphicon glyphicon-remove"></i></p>
                  </div>

                @endforeach
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('footer')
 <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<script src="/admin/image-picker.js"></script>
<script src="/admin/sweetalert.min.js"></script>
<script>
$(document).ready(function(){
  //tooltip
  $('[data-toggle="tooltip"]').tooltip();
    //drag and drop images
    Dropzone.options.imageUpload = {
      acceptedFiles: ".jpeg,.jpg,.png",
      success: function(file, response){}
    };

    //image picker
    $("select").imagepicker();

    //image
    $("img").click(function(){
      $("img").removeClass("selected");
      $(this).addClass("selected");
      $("#image_selected").removeAttr('disabled');
    });

    //delete
    $(".pic-delete").click(function(){
      var image_id = $(this).attr("data-image-id");
      swal({
        title: "Are you sure you want to delete this image ?",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Delete",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm){
        if (isConfirm) {
          $.ajax({url: "/admin/dropzone/delete",data:{image_id:image_id},
            success: function(result){
              if(result['key'] == "not_delete"){
                  var text = "";
                  var names = Object.keys(result['product']).map(function (key) { return result['product'][key]; });
                  for (var i = 0; i < names.length; i++) {
                    if(i+1 == names.length){
                      text += names[i];
                    }else{
                      text += names[i] + " , ";
                    }
                  }
                  swal("Not Deleted!", "Image has not been deleted because of using in other products such as "+ text+" .");
              }else if(result['key'] == "delete"){
                $(".sweet-overlay").hide();
                $("div.sweet-alert").css('display','none');
                $("#"+result['product']).hide();
              }
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
