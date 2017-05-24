<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>
  </head>
  <body>
    <div class="container">
      <div class="panel panel-default">
         <div class="panel-heading"><h1>Your order</h1> </div>
         <div class="panel-body" style="padding-left:50px">
           <h2>Customer details : </h2>
           <div style="padding-left:20px">
             <p><strong>Name:</strong> {{$customer->name}} </p>
             <p><strong>Email:</strong> {{$customer->email}} </p>
             <p><strong>Phone:</strong> {{$customer->phone}} </p>
             <p><strong>Address:</strong> {{$customer->country}} , {{$customer->city}} , {{$customer->address}} </p>
             <p><strong>Google map link :</strong> <a href="http://maps.google.com/?q={{$customer->lat}},{{$customer->lng}}">google map</a> </p>
           </div>
           <h2>Order details : </h2>
           <table class="table table-bordered" style="padding-left:20px;  border: 1px solid black; border-collapse: collapse;">
            <thead>
              <tr>
                <th style="border: 1px solid black;padding:15px;">Product</th>
                <th style="border: 1px solid black;padding:15px;">Quantity</th>
                <th style="border: 1px solid black;padding:15px;">Total</th>
              </tr>
            </thead>
            <tbody>
              <?php $total = 0; ?>
              @foreach($order as $data)
              <?php $total += $data->price * $data->quantity; ?>
              <tr>
                <td style="border: 1px solid black;padding:15px;">{{$data->name }}</td>
                <td style="border: 1px solid black;padding:15px;">{{ $data->quantity}}</td>
                <td style="border: 1px solid black;padding:15px;">{{$data->price * $data->quantity}}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th style="border: 1px solid black;padding:15px;">Total</th>
                <th style="border: 1px solid black;padding:15px;text-align:center;" colspan="2" >{{ $total}}</th>
              </tr>
            </tfoot>
          </table>
         </div>
       </div>
    </div>
  </body>
</html>
