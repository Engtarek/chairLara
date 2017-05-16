<form>
  <div class="form-group">
    <label for="">FIRST NAME </label>
    <input type="text" class="form-control"  placeholder="">
  </div>
  <div class="form-group">
    <label for="">LAST NAME </label>
    <input type="text" class="form-control"  placeholder="">
  </div>
  <div class="form-group">
    <label for="">COMPANY NAME</label>
    <input type="text" class="form-control"  placeholder="">
  </div>
  <div class="form-group">
    <label for="">EMAIL ADDRESS</label>
    <input type="email" class="form-control"  placeholder="">
  </div>
  <div class="form-group">
    <label for="">PHONE</label>
    <input type="tel" class="form-control"  placeholder="">
  </div>
  <div class="form-group">
    <label for="">ADDRESS</label>
    <input type="text" class="form-control"  placeholder="">
  </div>
  <div class="form-group">
    <label for="">TOWN / CITY</label>
    <input type="text" class="form-control"  placeholder="">
  </div>
  <div class="form-group">
    <label for="">STATE / COUNTY</label>
    <input type="text" class="form-control"  placeholder="">
  </div>
  <div class="form-group">
    <label for="">POSTCODE / ZIP</label>
    <input type="text" class="form-control"  placeholder="">
  </div>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
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
     <tfoot>
       <tr>
         <th>Product</th>
         <th>Total</th>
       </tr>
     </tfoot>
   </tbody>
 </table>
