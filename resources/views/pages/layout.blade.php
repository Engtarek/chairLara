<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="\css\font-awesome.min.css">
    @yield('header')
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .badge-notify{
     position:relative;
     top: -14px;
     left: -5px;
   }
   .dropdown-menu{
     min-width: 220px;
     padding: 5px 15px;
}
    </style>
    @yield('style')
  </head>
  <body>
    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand" href="#">Brand</a> -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{url('/')}}">Products</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle cart_count" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-lg fa-shopping-bag" aria-hidden="true"></i><span class="badge badge-notify">{{Cart::getTotalQuantity()}}</span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @foreach(Cart::getContent() as $cart)
            <?php foreach (explode("-",$cart->id) as $key => $first_id) {
               if($key==0){$item_id = $first_id;}
               else{foreach (explode(".",$first_id) as $key => $second_id) {
                 $item_id .= $second_id;
               }}
            }?>
            <li>
              <p style="text-align:center">{{$cart->name}}</p>
              <p style="display:inline-block;float:left" class="quantity_{{$item_id}}"> QTY : <span>{{$cart->quantity}}</span></p>
              <p style="display:inline-block;float:right" class="price_{{$item_id}}">Price : <span>{{$cart->price}}</span></p>
              <p style="clear:both"></p>
            </li>
              <li role="separator" class="divider"></li>
            @endforeach
            <p class="total">Total : <span>{{Cart::getTotal()}}<span></p>
            <a href="{{route('cart.show')}}" style="text-align:center" class=" btn btn-default">View Cart</a>
            @if(Cart::getContent()->count() == 0)
              <a href="{{route('cart.show')}}" style="text-align:center" class="btn btn-default">Check Out</a>
              @else
              <a href="{{url('/checkout')}}" style="text-align:center" class="btn btn-default">Check Out</a>
              @endif
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            @if(Auth::check()) {{Auth::user()->name}} @else Account @endif
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
              @if(Auth::check())
            <li><a href="{{ url('/user/logout') }}">Logout</a></li>
            @else
            <li><a href="{{url('/user/login')}}">Login</a></li>
            @endif
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    @yield('content')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    @yield('script')
  </body>
</html>
