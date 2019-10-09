@include('admin.includes.admin_header')

  <!-- Navbar -->
    @include('admin.includes.admin_navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    @include('admin.includes.admin_sidebar')

  <!-- Content Wrapper. Contains page content -->
  <!-- Content Header (Page header) -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              @yield('heading', 'Dashboard')
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">
                @yield('description', 'Dashboard')
              </li>
            </ol>
          </div><!-- /.col -->

          @include('admin.includes.admin_flash_messages')

          @include('admin.includes.admin_errors')

          @yield('content')
    
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


  </div>
  <!-- /.content-wrapper -->

@include('admin.includes.admin_footer')
