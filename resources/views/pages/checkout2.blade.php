@extends('pages.master')
@section('content')

			<div class="container-fluid title">
				<div class="row">
					<div class="col-sm-12">
						<h2>{{trans('keys.Checkout')}} / {{trans('keys.Step')}} 2 {{trans('keys.of')}} 2</h2>
					</div>
				</div>
			</div>

			<div class="container-fluid cart-list">
				<div class="row">
					<div class="col-sm-6 col-xs-12 @if(App::isLocale('ar')) pull-right @endif">
					   <form action="checkout2.html" method="post" novalidate class="myform">
							<h3 class="text-center">{{trans('keys.Payment Method')}}</h3>

								<div class="panel-group" id="accordion">
								 <!-- <div class="panel panel-default">
									<div class="panel-heading">
									  <h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
										  MasterCard
										</a>
									  </h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse in">
									  <div class="panel-body">

										<div class="row">
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">First name</label>
													<input name="name" placeholder="First Name" class="form-control" type="text">
												</div>
											</div>
											<div class="col-sm-6">
												<div class="form-group">
													<label class="control-label">Last Name</label>
													<input name="name2" placeholder="Last Name" class="form-control" type="text">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-8 col-md-8">
												<div class="form-group">
													<label class="control-label">Name</label>
													<input name="Card number" placeholder="Card number" class="form-control input-lg" type="text">
												</div>
											</div>
											<div class="col-sm-4 col-md-4">
												<div class="form-group">
													<label class="control-label">Code</label>
													<input name="Code" placeholder="Code" class="form-control input-lg" type="text" >
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-6 col-md-6">
												<div class="form-group">
													<label class="control-label">month</label>
													<div class=" controls">
														<select class="form-control">
														  <option>January</option>
														  <option>February</option>
														  <option>March</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-sm-6 col-md-6">
												<div class="form-group">
													<label class="control-label">year</label>
													<div class=" controls">
														<select class="form-control">
														  <option>2014</option>
														  <option>2015</option>
														  <option>2016</option>
														  <option>2017</option>
														  <option>2018</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									  </div>
									</div>
								  </div> -->

								   <div class="panel panel-default">
									<div class="panel-heading">
									  <h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
										  {{trans('keys.Cash on Delivery')}}
										</a>
									  </h4>
									</div>
									<div id="collapseTwo" class="panel-collapse collapse">
									  <div class="panel-body">
										<div class="form-group">
											<label class="control-label" for="contact-message">{{trans('keys.Message')}}</label>
											<div class="controls">
												<textarea id="contact-message" name="comments" placeholder="Add Comments About Your Order" class="form-control input-lg requiredField" rows="5"></textarea>
											</div>
										</div>
									  </div>
									</div>
								  </div>

								  <!-- <div class="panel panel-default">
									<div class="panel-heading">
									  <h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
										  PayPal
										</a>
									  </h4>
									</div>
									<div id="collapseThree" class="panel-collapse collapse">
									  <div class="panel-body">
										<div class="form-group">
											<label class="control-label">PayPal Account</label>
											<input name="email" placeholder="PayPal Account" class="form-control" type="text">
										</div>
									  </div>
									</div>
								  </div> -->
								</div>



						   </form>
						<form action="checkout2.html" method="post" novalidate id="order-form" class="myform">
							<h3 class="text-center">{{trans('keys.If you have Coupon code')}}</h3>
							<div class="input-group ">
								<input placeholder="{{trans('keys.Coupon code')}}" class="form-control input-lg" type="text" >
								<span class="input-group-btn">
									<button name="submit" type="submit" class="btn btn-store">{{trans('keys.check')}}!</button>
								</span>
							</div>
						</form>
					</div>
					<div class="col-sm-6 col-xs-12 @if(App::isLocale('ar')) pull-left @endif">
							<table class="table">
							  <thead>
								<tr>
								  <th colspan="3" class="text-center">{{trans('keys.You\'re purchasing this')}}…</th>
								</tr>
							  </thead>

							   <tbody>
                   @foreach($cart as $data)
    								<tr>
    								  <td class="vert-align">@if(App::isLocale('ar')) {{$data->name['name_ar']}} @else {{$data->name['name_en']}} @endif</td>
    								  <td class="vert-align">{{$data->quantity}}x</td>
    								  <td class="vert-align text-right">{{$data->price * $data->quantity}}</td>
    								</tr>
                    @endforeach

    								<tr>
    								  <td class="vert-align"><b>{{trans('keys.Sub total')}}</b></td>
    								  <td class="vert-align"></td>
    								  <td class="vert-align text-right"><b>{{Cart::getTotal()}}</b></td>
    								</tr>
    								<tr>
    								  <td class="vert-align">{{trans('keys.Shipping cost')}}:</td>
    								  <td class="vert-align"></td>
    								  <td class="vert-align text-right">0</td>
    								</tr>
    								<!-- <tr>
    								  <td class="vert-align">Tax:</td>
    								  <td class="vert-align"></td>
    								  <td class="vert-align text-right">$20.00</td>
    								</tr> -->
    								<!-- <tr>
    								  <td class="vert-align">Coupon:</td>
    								  <td class="vert-align"></td>
    								  <td class="vert-align text-right">- $15.00</td>
    								</tr> -->
    								<tr>
    								  <td class="vert-align">{{trans('keys.total')}}:</td>
    								  <td class="vert-align"></td>
    								  <td class="vert-align text-right" id="total">{{Cart::getTotal() + 0}}</td>
    								</tr>
							  </tbody>
							</table>
              {{Session::put('customer',$customer )}}
							<a href="{{url('/pay')}}" class="btn btn-right">{{trans('keys.Complete my purchase')}}</a>
					</div>


				</div>

				<div class="row">
					<div class="col-sm-12 text-center show-more">
						<a href="{{url('/')}}" class="btn btn-outline">{{trans('keys.Cancel and return to store')}}</a>
					</div>
				</div>

			</div>

@endsection
