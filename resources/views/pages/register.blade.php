@extends('pages.layout')
@section('title')
  Login
@endsection
@section('style')
<style>
.header,
.marketing,
.footer {
  padding-right: 15px;
  padding-left: 15px;
}

/* Custom page header */
.header {
  border-bottom: 1px solid #e5e5e5;
}
/* Make the masthead heading the same height as the navigation */
.header h3 {
  padding-bottom: 19px;
  margin-top: 0;
  margin-bottom: 0;
  line-height: 40px;
}

/* Custom page footer */
.footer {
  padding-top: 19px;
  color: #777;
  border-top: 1px solid #e5e5e5;
}

/* Customize container */
@media (min-width: 768px) {
  .container {
    max-width: 730px;
  }
}
.container-narrow > hr {
  margin: 30px 0;
}

/* Main marketing message and sign up button */
.jumbotron {
  text-align: center;
  border-bottom: 1px solid #e5e5e5;
}
.jumbotron .btn {
  padding: 14px 24px;
  font-size: 21px;
}

/* Supporting marketing content */
.marketing {
  margin: 40px 0;
}
.marketing p + h4 {
  margin-top: 28px;
}

/* Responsive: Portrait tablets and up */
@media screen and (min-width: 768px) {
  /* Remove the padding we set earlier */
  .header,
  .marketing,
  .footer {
    padding-right: 0;
    padding-left: 0;
  }
  /* Space out the masthead */
  .header {
    margin-bottom: 30px;
  }
  /* Remove the bottom border on the jumbotron for visual effect */
  .jumbotron {
    border-bottom: 0;
  }
}
</style>
@endsection

@section('content')
{{Session::put('backUrl', URL::previous())}}
<div class="container">
    <h3 class="well">Registration</h3>
	<div class="col-lg-12 well">
	<div class="row">
				<form method="post" action="{{url('/user/register')}}">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-6 form-group">
								<label>First Name</label>
								<input type="text" name="first_name" placeholder="Enter First Name Here.." class="form-control" required>
							</div>
							<div class="col-sm-6 form-group">
								<label>Last Name</label>
								<input type="text" name="last_name" placeholder="Enter Last Name Here.." class="form-control" required>
							</div>
						</div>
            <div class="form-group">
  						<label>Phone</label>
  						<input type="text" name="phone" placeholder="Enter Phone Here.." class="form-control" required>
  					</div>
            <div class="form-group">
  						<label>Country</label>
  						<input type="text" name="country" placeholder="Enter Country Here.." class="form-control" required>
  					</div>
            <div class="form-group">
  						<label>City</label>
  						<input type="text" name="city" placeholder="Enter City Here.." class="form-control" required>
  					</div>
            <div class="form-group">
  						<label>Address</label>
  						<input type="text" name="address" placeholder="Enter Address Here.." class="form-control" required>
  					</div>
  					<div class="form-group">
  						<label>Email Address</label>
  						<input type="text" name="email" placeholder="Enter Email Address Here.." class="form-control" required>
  					</div>
  					<div class="form-group">
  						<label>password</label>
  						<input type="password" name="password" placeholder="Enter Password Here.." class="form-control" required >
  					</div>
            	<input type="submit" name="login" class="btn" style="background-color:#357ae8" value="Register">
					</div>
				</form>
				</div>
	</div>
	</div>
@endsection
@section('script')

@endsection
