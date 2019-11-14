
@include('front.includes.header')

  <div class="container">

    @include('front.includes.navbar')

    @include('front.includes.front_flash_messages')

    @include('front.includes.front_errors')

    @yield('top')

  </div>

  <main role="main" class="container">
    <div class="row">
      <div class="col-md-12 blog-main">

        @yield('content')

      </div><!-- /.blog-main -->

    </div><!-- /.row -->

  </main><!-- /.container -->

@include('front.includes.footer')
