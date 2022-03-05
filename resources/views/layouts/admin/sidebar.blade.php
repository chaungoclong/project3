<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a class="brand-link" href="index3.html">
        <img alt="AdminLTE Logo" class="brand-image img-circle elevation-3" src="{{ asset('template/dist/img/AdminLTELogo.png') }}" style="opacity: .8">
            <span class="brand-text font-weight-light">
                AdminLTE 3
            </span>
        </img>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img alt="User Image" class="img-circle elevation-2" src="{{ asset('template/dist/img/user2-160x160.jpg') }}">
                </img>
            </div>
            <div class="info">
            </div>
      </div> --}}
        
        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input aria-label="Search" class="form-control form-control-sidebar" placeholder="Search" type="search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw">
                            </i>
                        </button>
                    </div>
                </input>
            </div>
        </div> --}}
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-accordion="false" data-widget="treeview" role="menu">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                <li class="nav-item" style="border-bottom: 1px solid gray;">
                    <a class="nav-link" href="#">
                        <img alt="User Image" class="img-circle elevation-2" src="{{ asset('template/dist/img/user2-160x160.jpg') }}" width="30px">
                        </img>
                        <p class="">
                            {{ auth()->user()->name }}
                            <i class="fas fa-angle-left right">
                            </i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="pages/layout/top-nav.html">
                                <i class="fas fa-user-circle nav-icon"></i>
                                <p>
                                    Profile
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.logout') }}">
                                <i class="fas fa-sign-out-alt nav-icon"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">
                    EXAMPLES
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/calendar.html">
                        <i class="nav-icon far fa-calendar-alt">
                        </i>
                        <p>
                            Calendar
                            <span class="badge badge-info right">
                                2
                            </span>
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon far fa-envelope">
                        </i>
                        <p>
                            User Manager
                            <i class="fas fa-angle-left right">
                            </i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="far fa-circle nav-icon">
                                </i>
                                <p>
                                    User
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.roles.index') }}">
                                <i class="far fa-circle nav-icon">
                                </i>
                                <p>
                                    Role
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">
                    MULTI LEVEL EXAMPLE
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="nav-icon fas fa-circle">
                        </i>
                        <p>
                            Level 1
                            <i class="right fas fa-angle-left">
                            </i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="far fa-circle nav-icon">
                                </i>
                                <p>
                                    Level 2
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="far fa-circle nav-icon">
                                </i>
                                <p>
                                    Level 2
                                    <i class="right fas fa-angle-left">
                                    </i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="far fa-dot-circle nav-icon">
                                        </i>
                                        <p>
                                            Level 3
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="far fa-dot-circle nav-icon">
                                        </i>
                                        <p>
                                            Level 3
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        <i class="far fa-dot-circle nav-icon">
                                        </i>
                                        <p>
                                            Level 3
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="far fa-circle nav-icon">
                                </i>
                                <p>
                                    Level 2
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>