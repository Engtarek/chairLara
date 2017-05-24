
<div class="form-group {{ $errors->has('order_number') ? ' has-error' : '' }}">
  <label for="">Order Number</label>
  {!!Form::text('order_number',null,['class'=>'form-control','placeholder'=>'Enter Order Number','disabled'=>'disabled'])!!}
  @if ($errors->has('order_number'))
      <span class="help-block">
          <strong>{{ $errors->first('order_number') }}</strong>
      </span>
  @endif
</div>


<!-- <div class="form-group {{ $errors->has('details') ? ' has-error' : '' }}">
  <label for="">Details</label>
  {!!Form::hidden('items',null,['class'=>'form-control','placeholder'=>'Enter Details'])!!}
  @if ($errors->has('details'))
      <span class="help-block">
          <strong>{{ $errors->first('details') }}</strong>
      </span>
  @endif
</div> -->


<!-- <div class="form-group {{ $errors->has('total') ? ' has-error' : '' }}">
  <label for="">Total</label>
  {!!Form::text('total',null,['class'=>'form-control','placeholder'=>'Enter Total'])!!}
  @if ($errors->has('total'))
      <span class="help-block">
          <strong>{{ $errors->first('total') }}</strong>
      </span>
  @endif
</div>


<div class="form-group {{ $errors->has('customer_id') ? ' has-error' : '' }}">
  <label for="">Customer</label>
  <input type="text" class="form-control" name="customer_id" value="{{customer_name($order->customer_id)}}">
   {!!Form::text('customer_id',null,['class'=>'','placeholder'=>'Enter Customer'])!!}
  @if ($errors->has('customer_id'))
      <span class="help-block">
          <strong>{{ $errors->first('customer_id') }}</strong>
      </span>
  @endif
</div> -->
<div class="form-group {{ $errors->has('status_id') ? ' has-error' : '' }}">
  <label for="">Status</label>
  {!!Form::select('status_id',status(),null,['class'=>'form-control'])!!}
  @if ($errors->has('status_id'))
      <span class="help-block">
          <strong>{{ $errors->first('status_id') }}</strong>
      </span>
  @endif
</div>
<div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="date" class="form-control" value="" id="datetimepicker"/>
                </div>
                <!-- /.input group -->
              </div>
