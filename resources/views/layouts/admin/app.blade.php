<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf" content="{{ csrf_token() }}">
        <title>@yield('pageName')</title>
        @include('layouts.admin.style')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed" 
        data-action="@yield('action')">
        @include('sweetalert::alert')

        <div class="wrapper">
            <!-- Preloader -->
            <div class="preloader flex-column justify-content-center align-items-center">
                <img alt="AdminLTELogo" class="animation__shake" height="60" src="{{ asset('template/dist/img/AdminLTELogo.png') }}" width="60">
                </img>
            </div>

            <!-- Navbar -->
            @include('layouts.admin.navbar')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            @include('layouts.admin.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                @include('layouts.admin.content-header')
                <!-- /.content-header -->

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            @include('layouts.admin.footer')
            
            <!-- Control Sidebar -->
            @include('layouts.admin.control-sidebar')
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        @include('layouts.admin.script')
    </body>
</html>