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


@elseif(Session::has('created_movie'))
  <div class="alert alert-success">
    <p>{{session('created_movie')}}</p>
  </div>
@elseif(Session::has('updated_movie'))
  <div class="alert alert-success">
    <p>{{session('updated_movie')}}</p>
  </div>
@elseif(Session::has('deleted_movie'))
  <div class="alert alert-success">
    <p>{{session('deleted_movie')}}</p>
  </div>


@elseif(Session::has('created_role'))
  <div class="alert alert-success">
    <p>{{session('created_role')}}</p>
  </div>
@elseif(Session::has('updated_role'))
  <div class="alert alert-success">
    <p>{{session('updated_role')}}</p>
  </div>
@elseif(Session::has('deleted_role'))
  <div class="alert alert-success">
    <p>{{session('deleted_role')}}</p>
  </div>


@elseif(Session::has('created_genre'))
  <div class="alert alert-success">
    <p>{{session('created_genre')}}</p>
  </div>
@elseif(Session::has('updated_genre'))
  <div class="alert alert-success">
    <p>{{session('updated_genre')}}</p>
  </div>
@elseif(Session::has('deleted_genre'))
  <div class="alert alert-success">
    <p>{{session('deleted_genre')}}</p>
  </div>


@elseif(Session::has('created_profession'))
  <div class="alert alert-success">
    <p>{{session('created_profession')}}</p>
  </div>
@elseif(Session::has('updated_profession'))
  <div class="alert alert-success">
    <p>{{session('updated_profession')}}</p>
  </div>
@elseif(Session::has('deleted_profession'))
  <div class="alert alert-success">
    <p>{{session('deleted_profession')}}</p>
  </div>


@elseif(Session::has('updated_price'))
  <div class="alert alert-success">
    <p>{{session('updated_price')}}</p>
  </div>
@elseif(Session::has('deleted_price'))
  <div class="alert alert-success">
    <p>{{session('deleted_price')}}</p>
  </div>


@endif
