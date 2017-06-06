<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  {!! Html::style('admin/bootstrap/css/bootstrap.min.css') !!}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  {!! Html::style('admin/dist/css/AdminLTE.min.css') !!}
  {!! Html::style('admin/dist/css/skins/_all-skins.min.css') !!}
  {!! Html::style('admin/plugins/iCheck/flat/blue.css') !!}
  {!! Html::style('admin/plugins/morris/morris.css') !!}
  {!! Html::style('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') !!}
  {!! Html::style('admin/plugins/datepicker/datepicker3.css') !!}
  {!! Html::style('admin/plugins/daterangepicker/daterangepicker.css') !!}
  {!! Html::style('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') !!}
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
      @yield('header')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="/admin/images/avatar.png" style="width:30px;height:30px" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="/admin/images/avatar.png" style="width:30px;height:30px"  class="img-circle" alt="User Image">

                <p>
                  {{Auth::user()->name}}
                  <!-- Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small> -->
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">

                      <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                        Sign out
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>

                  <!-- <a href="#" ></a> -->
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/admin/images/avatar.png" style="width:45px;height:45px"  class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="">
            <i class="fa fa-dashboard"></i> <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/admin/products"><i class="fa fa-circle-o"></i> Products</a></li>
            <li class=""><a href="/admin/product_layers"><i class="fa fa-circle-o"></i> Product Layer</a></li>
            <li class=""><a href="/admin/layer_images"><i class="fa fa-circle-o"></i>Layer Images</a></li>

          </ul>
        </li>
        <li class="treeview">
          <a href="{{url('/admin/customers')}}">
            <i class="fa fa-users"></i> <span>Customers</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{url('/admin/orders')}}">
            <i class="fa fa-users"></i> <span>Orders</span>
          </a>
        </li>
        <li class="treeview">
          <a href="{{url('/admin/employees')}}">
            <i class="fa fa-users"></i> <span>Employees</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @include('admin/partial/alert')
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->

 {!! Html::script('admin/plugins/jQuery/jquery-2.2.3.min.js')!!}
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
{!! Html::script('admin/bootstrap/js/bootstrap.min.js')!!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
{!! Html::script('admin/plugins/sparkline/jquery.sparkline.min.js')!!}
{!! Html::script('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')!!}
{!! Html::script('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')!!}
{!! Html::script('admin/plugins/knob/jquery.knob.js')!!}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
{!! Html::script('admin/plugins/daterangepicker/daterangepicker.js')!!}
{!! Html::script('admin/plugins/datepicker/bootstrap-datepicker.js')!!}
{!! Html::script('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')!!}
{!! Html::script('admin/plugins/slimScroll/jquery.slimscroll.min.js')!!}
{!! Html::script('admin/plugins/fastclick/fastclick.js')!!}
{!! Html::script('admin/dist/js/app.min.js')!!}
<!-- {!! Html::script('admin/dist/js/pages/dashboard.js')!!} -->
{!! Html::script('admin/dist/js/demo.js')!!}
  @yield('footer')
</body>
</html>
