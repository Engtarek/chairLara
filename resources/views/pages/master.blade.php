<!doctype html>
<html>
	<head>
		<title>STELLA SHOP</title>
		<meta charset="utf-8">
		<meta name="description" content="StellaShop - Elegant E-Commerce Theme from angelostudio.net">
		<meta name="author" content="ANGELOSTUDIO.NET">
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="/css/style.css?v=5">
		<link rel="stylesheet" href="/css/icomoon/style.css">
		<link rel="shortcut icon" href="/img/ico/32.png" sizes="32x32" type="image/png"/>
		<link rel="apple-touch-icon-precomposed" href="/img/ico/60.png" type="image/png"/>
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/img/ico/72.png" type="image/png"/>
		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="/img/ico/120.png" type="image/png"/>
		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="/img/ico/152.png" type="image/png"/>
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		@yield('style')
	</head>

	<body id="home"  style="overflow-x: hidden !important;">
		<div class="container-fluid">
			<div class="menu-wrapper">
				<a href="#" class="close-menu visible-xs"><i class="icon-close"></i></a>
				<h3 class="visible-xs">Navigation</h3>
				<ul class="nav-list text-center effect">
					<li  class="{{ Request::path() == '/' ? 'active' : '' }}"><a href="{{url('/')}}">Shop</a></li>
					<li   class="{{ Request::path() == 'about' ? 'active' : '' }}"><a href="{{url('/about')}}">About</a></li>
					<li  class="{{ Request::path() == 'contact' ? 'active' : '' }}"><a href="{{url('/contact')}}">Contact</a></li>

					<!-- <li class="{{ Request::path() == 'user/register' ? 'active' : '' }}"><a href="{{url('/user/register')}}">Register</a></li>
					<li class="{{ Request::path() == 'user/login' ? 'active' : '' }}" ><a href="{{url('/user/login')}}">Login</a></li> -->
				</ul>
			</div>
		</div>

		<div id="wrap"  >
			<div id="main-nav" class="">
				<div class="container-fluid">
					<div class="nav-header">
							<a href="{{url('/')}}" class="nav-brand">STELLA <span>SHOP</span></a>
							<a class="nav-icon pull-right visible-xs menu-link" href="#"><i class="icon-menu2"></i></a>
							<a class="nav-icon-outline cart pull-right" href="{{url('/cart')}}"><i class="icon-cart"></i><span class="badge">{{Cart::getTotalQuantity()}}</span></a>
						</div>
				</div>
			</div>

			@yield('content')

			<footer class="footer">
				<div class="container-fluid">
					<div class="pull-left copyright">
						<p>STELLA <b>SHOP</b> &copy; 2014. Designed by <a href="http://www.angelostudio.net" target="_blank">Angelo Studio</a>.</p>
						<ul class="nav-list effect">
							<li><a href="{{url('terms_conditions')}}">Delivery & Returns</a></li>
							<li><a href="{{url('terms_conditions')}}">Terms & Conditions</a></li>
							<li><a href="{{url('privacy')}}">Privacy</a></li>
							<li><a href="{{url('faq')}}">FAQ</a></li>
						</ul>
					</div>

					<div class="pull-right copyright">
							<ul class="social-links">
								<li><a href="#"><i class="icon-twitter"></i></a></li>
								<li><a href="#"><i class="icon-dribbble"></i></a></li>
								<li><a href="#"><i class="icon-pinterest"></i></a></li>
							</ul>
					</div>
				</div>
			</footer>

		</div>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<script type="text/javascript" src="/js/placeholders.min.js"></script>
		<script type="text/javascript" src="/js/custom.js"></script>
		@yield('script')

	</body>

</html>
