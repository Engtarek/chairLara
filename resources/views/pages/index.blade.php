@extends('pages.master')
@section('content')
			<div class="container-fluid productlist">
        <div class="row">
          @foreach($products as $product)
          @if($loop->iteration % 8 == 0 || $loop->iteration % 8 == 7 )
            <div class="col-sm-6 en_dir ">
              <a href="{{url('/product/'.$product->id)}}">
                <img src="/images/{{$product->product_image->name}}"  class="img-responsive" alt="item">
              </a>
            </div>
            @elseif($loop->iteration % 8 == 1 || $loop->iteration % 8 == 6 )
            <div class="col-sm-8 ar_dir">
              <a href="{{url('/product/'.$product->id)}}">
                <img src="/images/{{$product->product_image->name}}" class="img-responsive" alt="item">
              </a>
            </div>
            @elseif($loop->iteration % 8 == 4 )
            <div class="col-sm-4 special ar_dir">
  						<div class="col-sm-12">
  							<a href="{{url('/product/'.$product->id)}}">
  								<img src="/images/{{$product->product_image->name}}"  class="img-responsive" alt="item">
  							</a>
  						</div>
              @elseif($loop->iteration % 8 == 5)
              <div class="col-sm-12">
  							<a href="{{url('/product/'.$product->id)}}">
  								<img src="/images/{{$product->product_image->name}}"  class="img-responsive" alt="item">
  							</a>
  						</div>
  					</div>
            @else
            <div class="col-sm-4 ar_dir">
              <a href="{{url('/product/'.$product->id)}}">
                <img src="/images/{{$product->product_image->name}}"  class="img-responsive" alt="item">
              </a>
            </div>
            @endif
          @endforeach
        </div>
			</div>
      <div class="row">
				@if($more == 1)
	       <div class="col-sm-12 text-center show-more">
	         <a href="#" class="btn btn-outline" id="show_more">{{ trans('keys.show_more')}}</a>
	       </div>
			 @endif
     </div>
@endsection
@section('script')
<script>
$(document).ready(function(){
    var numofelement = 0;
    $("#show_more").click(function(e){
      e.preventDefault();
      numofelement += 8;
        $.ajax({url: "/showmore", data : { numofelement : numofelement }, success: function(result){
						if(result['more'] == 0){
							  $("#show_more").hide();
						}
          let el=`<div class="col-sm-4 special ar_dir">`;
          result['products'].forEach(function(element,index) {
            if(result['products'].length >= 5){
              if((index+1) % 8 == 4 ){
                el += display(element,index);
              }else if((index+1) % 8 == 5){
                el += display(element,index);
                $(".productlist").find(".row").append(el);
              }else{
                $(".productlist").find(".row").append(display(element,index));
              }
            }else{
              if((index+1) % 8 == 4 ){
                el += display(element,index);
                $(".productlist").find(".row").append(el);
              }else{
                $(".productlist").find(".row").append(display(element,index));
              }
            }
});
    }});
    });

    function display(element,index){
      let className="col-sm-4 ar_dir";
      let image = element.image;
      let id = element.id;
    if((index+1) % 8 == 0 || (index+1) % 8 == 7 ){
      className="col-sm-6 en_dir ";
    }else if((index+1) % 8 == 1 || (index+1) % 8 == 6 ){
      className ="col-sm-8 ar_dir ";
    }else if((index+1) % 8 == 4 ){
      className="col-sm-12 ";

    }else if((index+1) % 8 == 5){
      className="col-sm-12 ";
    }
    let html =`<div class="${className}">
        <a href="/product/${id}">
				  <img src="/images/${image}"  class="img-responsive" alt="item">
        </a>
      </div>`;
      return html;
  }

});

</script>
@endsection
