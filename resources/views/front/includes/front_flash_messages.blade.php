<!-- Messages for news -->
@if(Session::has('created_news'))
  <div class="alert alert-success">
    <p>{{session('created_news')}}</p>
  </div>

<!-- Messages for users -->
@elseif(Session::has('updated_user'))
  <div class="alert alert-success">
    <p>{{session('updated_user')}}</p>
  </div>
@endif
