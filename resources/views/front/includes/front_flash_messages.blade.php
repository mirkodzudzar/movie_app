<!-- Messages for news -->
@if(Session::has('created_news'))
  <div class="alert alert-success">
    <p>{{session('created_news')}}</p>
  </div>
@endif
