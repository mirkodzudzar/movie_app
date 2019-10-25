
@include('front.includes.header')

  <div class="container">

    @include('front.includes.navbar')

    @yield('top')

  </div>

  <main role="main" class="container">
    <div class="row">
      <div class="col-md-8 blog-main">

        @yield('content')

      </div><!-- /.blog-main -->

      <aside class="col-md-4 blog-sidebar">

        @include('front.includes.sidebar')

      </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->

  </main><!-- /.container -->

@include('front.includes.footer')
