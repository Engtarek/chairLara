<html>
  <head>
    <style>
      .parent{
        width:235px;
        height:235px;
        display:inline-block;
      }
      .chair{
        width: 700px;
        height: 700px;
        position: absolute;
        transform: scale(.32);
        margin-top: -200px;
        margin-left: -233px;
      }
      .table{
        width:705px;
      }
      .table th,.table td{
        width:235px;
      }
      .table th{
        border-top:1px solid #DDD;
        border-bottom: 1px solid #DDD;
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: left;
      }
      .table{
        margin-bottom: 20px;
      }
    </style>

  </head>
  <body>

    @foreach($order as $data)
      <p>Product : {{$data['cart']['name']}}</p>
      <p>
        <span style="padding-right:40px"> Quentity : {{$data['cart']['quantity']}}</span>
        <span>Total Price : {{$data['cart']['quantity'] *$data['cart']['price']}}</span>
      </p>
      <p>Images : </p>
      <?php
          $imagename="";
          $array = explode("-",$data['cart']['id']);
          foreach ($array as $value){
            $product_id=$array[0];
            foreach(explode(".",$value) as $name){
              $imagename .= $name;
            }
         }
      ?>

      <div class="parent">
        <div class="chair" style="background: url(/products/{{$product_id}}/history/{{$imagename}}.png);background-position: 0px -700px"></div>
      </div>
      <div class="parent">
        <div class="chair" style="background: url(/products/{{$product_id}}/history/{{$imagename}}.png);background-position: 0px 0px"></div>
      </div>
      <div class="parent">
        <div class="chair" style="background: url(/products/{{$product_id}}/history/{{$imagename}}.png);background-position: -700px 0px;"></div>
      </div>
      <p>Details </p>
      <table class="table">
        <tr>
          <th>Item</th>
          <th>Distributor</th>
          <th>Price</th>
        </tr>
        @foreach($data['cart']['attributes'] as $layer )
        <tr>
          <td>{{$layer['item_name']}}</td>
          <td>{{$layer['item_distributer_name']}}</td>
          <td>{{$layer['item_price']}}</td>
        </tr>
        @endforeach
      </table>
      <p>URL : {{$data['url']}} </p>
      <hr>
    @endforeach
  </body>
</html>



<!-- <html>
  <head>
    <style>
      .parent{
        width:235px;
        height:235px;
        display:inline-block;
      }
      .chair{
        width: 700px;
        height: 700px;
        position: absolute;
        transform: scale(.32);
        margin-top: -240px;
        margin-left: -233px;
      }
      .table{
        width:705px;
      }
      .table th,.table td{
        width:235px;
      }
      .table th{
        border-top:1px solid #DDD;
        border-bottom: 1px solid #DDD;
        padding-top: 10px;
        padding-bottom: 10px;
        text-align: left;
      }
      .table{
        margin-bottom: 20px;
      }
    </style>

  </head>
  <body>
    @foreach($order as $data)
    <p>Product : {{$data['cart']['name']}}</p>
    <p>quantity: {{$data['cart']['quantity']}}</p>
    <p>Total Price : {{$data['cart']['quantity'] * $data['cart']['price']}}</p>

    <p>Images : </p>

    <div class="parent">
      @foreach($data['cart']['attributes'] as $layer )
          <div class="chair" style="background: url(/products/{{$layer['product_id']}}/image/{{$layer['image']}});background-position: 0px -700px;z-index:{{$layer['rank']}}"></div>
      @endforeach
    </div>
     <div class="parent">
      @foreach($data['cart']['attributes'] as $layer )
          <div class="chair" style="background: url(/products/{{$layer['product_id']}}/image/{{$layer['image']}});background-position: 0px 0px;z-index:{{$layer['rank']}}"></div>
      @endforeach
    </div>
    <div class="parent">
      @foreach($data['cart']['attributes'] as $layer )
          <div class="chair" style="background: url(/products/{{$layer['product_id']}}/image/{{$layer['image']}});background-position: -700px 0px;z-index:{{$layer['rank']}}"></div>
      @endforeach
    </div>

    <p>Details </p>
    <table class="table">
      <tr>
        <th>Item</th>
        <th>Distributor</th>
        <th>Price</th>
      </tr>
       @foreach($data['cart']['attributes'] as $layer )
        <tr>
          <td>{{$layer['item_name']}}</td>
          <td>{{$layer['item_distributer_name']}}</td>
          <td>{{$layer['item_price']}}</td>
        </tr>
      @endforeach
    </table>
      <p>URL :{{$data['url']}} </p>
    <hr>
      @endforeach
  </body>
</html> -->
