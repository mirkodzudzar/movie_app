<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('admin.index') }}" class="brand-link">
    <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">Movie Application</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <!-- Change this later -->
        <a href="#" class="d-block">LOGIN USER</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
         <a href="{{ route('admin.index')}}" class="nav-link">
           <i class="nav-icon fas fa-th"></i>
           <p>
             Dashboard
           </p>
         </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-film"></i>
            <p>
              Movies
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="text-indent: 15px;">
            <li class="nav-item">
              <a href="{{ route('admin.movies.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>See all movies</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.movies.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add new movie</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.genres.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Genres</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.prices.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Prices</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-tie"></i>
            <p>
              Celebrities
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="text-indent: 15px;">
            <li class="nav-item">
              <a href="{{ route('admin.celebrities.index' )}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>See all celebrities</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.celebrities.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add new celebrity</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.professions.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Professions</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Users
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="text-indent: 15px;">
            <li class="nav-item">
              <a href="{{ route('admin.users.index' )}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>See all users</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.users.create') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Add new user</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.roles.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Roles</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-image"></i>
            <p>
              Images
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="text-indent: 15px;">
            <li class="nav-item">
              <a href="{{ route('admin.images.index') }}#celebrities" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Images for celebrities</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.images.index') }}#movies" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Images for movies</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.images.index') }}#create_image" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Create new image</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin.news.index') }}" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              News by authors
            </p>
          </a>
        </li>
        <li class="nav-header">LABELS</li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                           <i class="nav-icon far fa-circle text-danger"></i>
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
