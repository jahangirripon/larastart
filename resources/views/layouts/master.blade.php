
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Lara Starter</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/css/app.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper"  id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
      <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                  <p>
                    {{ __('Logout') }}
                  </p>            
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </a>
          </li>
    </ul>

    <!-- SEARCH FORM -->
      <div class="input-group input-group-sm form-inline ml-3">
        <input class="form-control form-control-navbar" v-model="search" @keyup="searchit" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" @click="searchit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>

    <!-- Right navbar links -->
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="./img/user.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">DurbarEx</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./img/logo.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info brand-link">
          <span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Management
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                <router-link to="/agents" class="nav-link">
                  <i class="nav-icon fa fa-user"></i>
                  <p>
                    Agents
                  </p>
                </router-link>
              </li>

              <li class="nav-item">
                  <router-link to="/orders" class="nav-link">
                      <i class="nav-icon fa fa-users"></i>
                      <p>
                        Orders
                      </p>
                    </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/status" class="nav-link">
                  <i class="nav-icon fa fa-columns"></i>
                  <p>
                    Status
                  </p>
                </router-link>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Profile
              </p>
            </router-link>
          </li>

          @can('isAdmin')
          <li class="nav-item">
            <router-link to="/developer" class="nav-link">
              <i class="nav-icon fa fa-cogs"></i>
              <p>
                Developer
              </p>
            </router-link>
          </li>
          @endcan

          <li class="nav-item">
              <router-link to="/users" class="nav-link">
                  <i class="nav-icon fa fa-users"></i>
                  <p>
                    Users
                  </p>
                </router-link>
          </li>

          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
              <i class="nav-icon fa fa-columns"></i>
              <p>
                Dashboard
              </p>
            </router-link>
          </li>



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">


      <router-view></router-view>
      <vue-progress-bar></vue-progress-bar>


      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2018 <a href="https://rtbd.com">RTBD</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

@auth
  <script>
    window.user = @json(auth()->user())
  </script>
@endauth

<!-- jQuery -->
<script src="/js/app.js"></script>
</body>
</html>
