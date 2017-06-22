@if(Session::has('fail'))
  <div class="alert alert-danger">
    {{ Session::get('fail') }}
  </div>
@endif
