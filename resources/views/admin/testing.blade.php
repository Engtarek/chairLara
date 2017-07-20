@extends('admin.master')

@section('title')

@endsection

@section('header')

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
button{
  display: block;
}
</style>
@endsection

@section('content')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"> </li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"> </h3>
        </div>
        <div class="box-body">
          <form  method="post" action="{{url('/admin/save')}}">
            <div class="form-group">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            </div>
            <div class="form-group">
                <input type="hidden" name="color" value="">
                <!-- start model -->
                <button type="button" class="btn btn-default " data-toggle="modal" data-target="#color">choose color </button>
                <div class="modal fade" id="color" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div>
                          @foreach($images as $key=>$image)
                            <img class="img-responsive img-thumbnail"src="/images/sub_{{$image->name}}" data-value="{{$image->id}}">
                          @endforeach
                        </div>
                        <button class="btn btn-primary btn-img" id="color-btn" >select</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end model -->
                <div><img class="color" src=""></div>
            </div>
            <div class="form-group image">
                <input type="hidden" name="image" value="">
                <!-- start model -->
                <button type="button" class="btn btn-default " data-toggle="modal" data-target="#image">choose image </button>
                <div class="modal fade" id="image" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>
                      <div class="modal-body">
                        <div>
                          @foreach($images as $key=>$image)
                            <img class="img-responsive img-thumbnail"src="/images/sub_{{$image->name}}" data-value="{{$image->id}}">
                          @endforeach
                        </div>
                        <button class="btn btn-primary btn-img" id="image-btn" >select</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end model -->
                <div><img class="image" src=""></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</section>

@endsection
@section('footer')
<script>
$(document).ready(function(){
    //image
    $("img").click(function(){
      $("img").removeClass("selected");
      $(this).addClass("selected");
    });

    $("#color-btn").click(function(e){
      e.preventDefault();
      var img_src = $("img.selected").attr("src");
      var id = $("img.selected").attr("data-value");
      $('#color').modal('hide');
      $("input[name='color']").val(id);

      $('.color').attr("src",img_src);
    });

    $("#image-btn").click(function(e){
        e.preventDefault();
        var img_src = $("img.selected").attr("src");
        var id = $("img.selected").attr("data-value");
        $('#image').modal('hide');
        $("input[name='image']").val(id);
      $('.image').attr("src",img_src);

    });

});

</script>
@endsection
