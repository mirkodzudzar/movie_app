<!-- Messages for users -->
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

<!-- Messages for movies -->
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

<!-- Messages for roles -->
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

<!-- Messages for genres -->
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

<!-- Messages for professions -->
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
@elseif(Session::has('updated_profession'))
  <div class="alert alert-success">
    <p>{{session('updated_profession')}}</p>
  </div>

<!-- Messages for movie prices -->
@elseif(Session::has('updated_price'))
  <div class="alert alert-success">
    <p>{{session('updated_price')}}</p>
  </div>
@elseif(Session::has('deleted_price'))
  <div class="alert alert-success">
    <p>{{session('deleted_price')}}</p>
  </div>

<!-- Messages for celebrities -->
@elseif(Session::has('created_celebrity'))
  <div class="alert alert-success">
    <p>{{session('created_celebrity')}}</p>
  </div>
@elseif(Session::has('updated_celebrity'))
  <div class="alert alert-success">
    <p>{{session('updated_celebrity')}}</p>
  </div>
@elseif(Session::has('deleted_celebrity'))
  <div class="alert alert-success">
    <p>{{session('deleted_celebrity')}}</p>
  </div>

<!-- Messages for images -->
@elseif(Session::has('created_image'))
  <div class="alert alert-success">
    <p>{{session('created_image')}}</p>
  </div>
@elseif(Session::has('create_image_error'))
  <div class="alert alert-danger">
    <p>{{session('create_image_error')}}</p>
  </div>


<!-- Messages for news -->
@elseif(Session::has('deleted_news'))
  <div class="alert alert-success">
    <p>{{session('deleted_news')}}</p>
  </div>


@endif
