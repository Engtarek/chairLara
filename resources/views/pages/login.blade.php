@extends('pages.master')
@section('content')
{{Session::put('backUrl', URL::previous())}}
			<div class="container-fluid cart-list">
				<div class="row">
          @include('pages.alert')
					<div class="col-sm-6">
            {!! Form::open(['url' => '/user/login', 'files' => true,'class'=>'myform']) !!}
							<h2 class="text-center">Login to shop</h2>
							<div class="form-group">
								<label class="control-label">Email</label>
                  {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Email'])!!}
							</div>
							<div class="form-group">
								<label class="control-label">Password</label>
                {!!Form::password('password',['class'=>'form-control','placeholder'=>'Password'])!!}
							</div>

							<div class="checkbox">
							  <label>
							    <input name="remember" type="checkbox">
							      <span>Remember Me</span>
							  </label>
							</div>

							<p><button name="submit" type="submit" class="btn btn-store btn-block">Login</button></p>
						  {!! Form::close() !!}
					</div>
          <!-- register section  -->
					<div class="col-sm-6">
            {!! Form::open(['url' => '/user/register', 'files' => true,'class'=>'myform']) !!}
							<h2 class="text-center">Create account</h2>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group  {{ $errors->has('name') ? ' has-error' : '' }}">
										<label class="control-label">First name</label>
                      {!!Form::text('name',null,['class'=>'form-control','placeholder'=>'First Name'])!!}
                      @if ($errors->has('name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group  {{ $errors->has('last_name') ? ' has-error' : '' }}">
										<label class="control-label">Last Name</label>
                      {!!Form::text('last_name',null,['class'=>'form-control','placeholder'=>'Last Name'])!!}
                      @if ($errors->has('last_name'))
                          <span class="help-block">
                              <strong>{{ $errors->first('last_name') }}</strong>
                          </span>
                      @endif
									</div>
								</div>
							</div>

							<div class="form-group  {{ $errors->has('email') ? ' has-error' : '' }}">
								<label class="control-label">Email</label>
                  {!!Form::email('email',null,['class'=>'form-control','placeholder'=>'Email'])!!}
                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
							</div>
							<div class="form-group  {{ $errors->has('password') ? ' has-error' : '' }}">
								<label class="control-label">Password</label>
                  {!!Form::password('password',['class'=>'form-control','placeholder'=>' Password'])!!}
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
							</div>

							<p><button name="submit" type="submit" class="btn btn-store btn-block">Create an account</button></p>
						  {!! Form::close() !!}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12 text-center show-more">
						<a href="{{url('/')}}" class="btn btn-outline">Cancel and return to store</a>
					</div>
				</div>

			</div>

		@endsection
