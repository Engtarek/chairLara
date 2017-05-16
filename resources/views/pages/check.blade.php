@extends('pages.layout')
@section('title')
  checkout
@endsection
@section('style')
<style>
  .required label:after { content:"*";color:red }
</style>
@endsection
@section('content')
<div class="container">
<form method="post" action="{{url('/test')}}">
  <input type="hidden" name="_token" value="{{csrf_token()}}">
  <div class="form-group required">
    <label for="">FIRST NAME </label>
    <input type="text"  name="first_name" class="form-control"  placeholder="" required>
  </div>
  <div class="form-group required">
    <label for="">LAST NAME </label>
    <input type="text" name="last_name" class="form-control"  placeholder="" required>
  </div>
  <div class="form-group required">
    <label for="">COMPANY NAME </label>
    <input type="text" name="company_name" class="form-control"  placeholder="" required>
  </div>
  <div class="form-group required">
    <label for="">EMAIL ADDRESS </label>
    <input type="email" name="email" class="form-control"  placeholder="" required>
  </div>
  <div class="form-group required">
    <label for="">PHONE </label>
    <input type="tel" name="phone" class="form-control"  placeholder="" required>
  </div>
  <div class="form-group required">
    <label for="">ADDRESS </label>
    <input type="text" name="address" class="form-control"  placeholder="" required>
  </div>
  <div class="form-group required">
    <label for="">TOWN / CITY </label>
    <input type="text" name="city" class="form-control"  placeholder="" required>
  </div>
  <div class="form-group required">
    <label for="">STATE / COUNTY </label>
    <input type="text" name="state" class="form-control"  placeholder="" required>
  </div>
  <div class="form-group required">
    <label for="">POSTCODE / ZIP </label>
    <input type="text" name="ZIP" class="form-control"  placeholder="" required>
  </div>
  <h2>Your Order</h2>
    <table class="table table-bordered">
     <thead>
       <tr>
         <th>Product</th>
         <th>Total</th>
       </tr>
     </thead>
     <tbody>
       @foreach($cart as $data)
       <tr>
         <td>{{$data->name }}<i class="fa fa-times" aria-hidden="true"></i>{{ $data->quantity}}</td>
         <td>{{$data->price * $data->quantity}}</td>
       </tr>
       @endforeach
     </tbody>
     <tfoot>
       <tr>
         <th>Total</th>
         <th>{{Cart::getTotal()}}</th>
       </tr>
     </tfoot>
   </table>
  <button type="submit" class="btn btn-defaults">Place order</button>
</form>

 </div>
 @endsection
