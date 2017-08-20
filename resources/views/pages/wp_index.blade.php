@extends('pages.master')
@section('style')
<style>
.menu-wrapper{
	display: none;
}
.footer{
	display: none;
}
#main-nav{
	display: none;
}
</style>
@endsection
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

@endsection
@section('script')
<script>


</script>
@endsection
