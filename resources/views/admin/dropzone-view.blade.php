@extends('admin.master')

@section('title')
    Images area
@endsection

@section('header')
<link rel="stylesheet" href="/admin/image-picker.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.0.1/min/dropzone.min.css" rel="stylesheet">

 <style>
/*ul.thumbnails.image_picker_selector li{
  width: 150px;
  height: 150px;
}
ul.thumbnails.image_picker_selector li .thumbnail.selected{
  border-color:#0088cc;
  background: transparent;
}
ul.thumbnails.image_picker_selector li .thumbnail{
  border:5px solid #dddddd;
  padding: 0;
}
.thumbnail{
  padding: 1px;
}*/
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
                  <img class="img-responsive img-thumbnail"src="/images/sub_{{$image->name}}" data-value="{{$image->id}}">
                @endforeach
              </div>
              <!-- <button class="btn btn-primary" id="image_selected" disabled>Save</button> -->
              <!-- <form>
              <select class="image-picker">
                  @foreach($images as $key=>$image)
                      <option data-img-src=""  value="{{$image->id}}">dasdfs</option>
                  @endforeach
                </select>
                <button class="btn btn-primary" id="image_selected">Save</button>
              </form> -->
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
<script>
$(document).ready(function(){
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

    $("#image_selected").click(function(){
      window.history.back();
    });

});

</script>
@endsection
