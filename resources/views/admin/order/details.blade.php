@extends('admin.master')
@section('title')
    Order - Details
@endsection

@section('content')
<section class="content-header">
  <ol class="breadcrumb">
    <li><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url('/admin/orders')}}"><i class="fa fa-dashboard"></i> Orders</a></li>
    <li class="active">Details</li>
  </ol>
</section>
<hr>
<section class="content">
  <div class="row ">
    <div class="col-xs-6">
      <span style="font-weight: bold;font-size: 21px;">Details</span>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-body">
          <ul>
            @foreach($history as $data)
              @if($data->text != "")
              <li>
                {{date('d-m-Y h:i A',strtotime($data->date))}}
                {{$data->username}}
                sent order email to {{($data->text)}}
              </li>
              @else
              <li>
                {{date('d-m-Y h:i A',strtotime($data->date))}}
                {{$data->username}}
                change {{status_name($data->previous_status)}}
                to {{status_name($data->current_status)}}
              </li>
              @endif

            @endforeach
          </ul>
    </div>
  </div>
</div>
</div>
</section>

@endsection
