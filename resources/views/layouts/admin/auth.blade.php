<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf" content="{{ csrf_token() }}">
        <title>@yield('pageName')</title>
        @include('layouts.admin.style')
    </head>
    <body class="@yield('classBodyAuth')" style="min-height: 496.781px;"
        data-action="@yield('action')">
        @include('sweetalert::alert')

        <div class="@yield('classWrapperAuth')">
            <div class="@yield('classLogoAuth')">
                <a href="../../index2.html">
                    <b>
                        Admin
                    </b>
                    LTE
                </a>
            </div>
            <!-- /.login-logo -->
            @yield('content')
           
        </div>
        <!-- /.login-box -->
        <!-- jQuery -->
        @include('layouts.admin.script')
    </body>
</html>
