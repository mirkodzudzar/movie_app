@if(Session::has('created_user'))
  <div class="alert alert-success">
    <p>{{session('created_user')}}</p>
  </div>
@elseif(Session::has('updated_user'))
  <div class="alert alert-success">
    <p>{{session('updated_user')}}</p>
  </div>
@elseif(Session::has('deleted_user'))
  <div class="alert alert-success">
    <p>{{session('deleted_user')}}</p>
  </div>
@endif
