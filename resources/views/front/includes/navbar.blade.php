<header class="blog-header py-3">
  <div class="row flex-nowrap justify-content-between align-items-center">
    <div class="col-4 pt-1">
      <!-- <a class="text-muted" href="#">Subscribe</a> -->
    </div>
    <div class="col-4 text-center">
      <p class="text-muted" style="position:relative; top:8px; left:5px;">Logged in as: <b><i>{{ Auth::user()->username }}</i></b></p>
    </div>
    <div class="col-4 d-flex justify-content-end align-items-center">
      <a class="text-muted" href="#">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
      </a>

      @guest
          <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary">Login</a>
          @if (Route::has('register'))
              <a href="{{ route('register') }}" class="btn btn-sm btn-outline-secondary">Register</a>
          @endif
      @else
          @if(Auth::user()->role_id)
            @if(Auth::user()->isAdmin())
              <a href="{{ route('admin.index') }}" class="btn btn-sm btn-outline-secondary">Admin</a>
            @endif
          @endif
              <a class="btn btn-sm btn-outline-secondary" href="{{ route('front.users.edit', Auth::user()->id) }}">Profile</a>
              <a class="btn btn-sm btn-outline-secondary" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
      @endguest
    </div>
  </div>
</header>

<div class="nav-scroller py-1 mb-2">
  <hr>
  <nav class="nav d-flex justify-content-between">
    <a class="p-1 text-muted" href="{{ route('front.news.index') }}">News</a>
    @auth
      @if(Auth::user()->role_id)
        @if(Auth::user()->isAuthor())
          <a class="p-2 text-muted" href="{{ route('front.news.index') }}#create_news">Create some news</a>
        @endif
      @endif
    @endauth
    <a class="p-1 text-muted" href="#">Movies</a>
    <a class="p-1 text-muted" href="#">Celebrities</a>
    <!-- <a class="p-2 text-muted" href="#">Culture</a>
    <a class="p-2 text-muted" href="#">Business</a>
    <a class="p-2 text-muted" href="#">Politics</a>
    <a class="p-2 text-muted" href="#">Opinion</a>
    <a class="p-2 text-muted" href="#">Science</a>
    <a class="p-2 text-muted" href="#">Health</a>
    <a class="p-2 text-muted" href="#">Style</a>
    <a class="p-2 text-muted" href="#">Travel</a> -->
  </nav>
  <hr>
</div>
