<!doctype html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>
{{--            @if (!request()->segment(1))--}}
{{--            {{ config('app.name') }}--}}
{{--            @else--}}
{{--            {{ config('app.name') }} |--}}
{{--            @yield('page-title')--}}
{{--            @endif--}}
        </title>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ url('assets/images/favicon.png') }}" />

        <!-- Google fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
            rel="stylesheet">

        <!-- Bootstrap icons -->
        <link rel="stylesheet" href="{{ url('dist/icons/bootstrap-icons-1.4.0/bootstrap-icons.min.css') }}"
            type="text/css">
        <!-- Bootstrap Docs -->
        <link rel="stylesheet" href="{{ url('dist/css/bootstrap-docs.css') }}" type="text/css">
        {{-- Font Awesome --}}
        <link rel="stylesheet" href="{{ url('dist/icons/font-awesome/css/font-awesome.min.css') }}" type="text/css">


        @yield('head')

        <!-- Main style file -->
        <link rel="stylesheet" href="{{ url('dist/css/app.min.css') }}" type="text/css">

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="{{ url('assets/css/switchery.css') }}">
        <link rel="stylesheet" href="{{ url('assets/css/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/css/custom.css') }}">

    </head>

    <body>

        <!-- preloader -->
        <div class="preloader">
            <img src="{{ url('assets/images/logo.png') }}" alt="logo">
            <div class="preloader-icon"></div>
        </div>
        <!-- ./ preloader -->



        <!-- menu -->
        @include('components.menu')
        <!-- ./  menu -->

        <!-- layout-wrapper -->
        <div class="layout-wrapper">

            <!-- header -->
            @include('components.header-basic')
            <!-- ./ header -->

            <!-- content -->
            <div class="content @yield('contentClassName')">
                @yield('content')
            </div>
            <!-- ./ content -->

            <!-- content-footer -->
            <footer class="content-footer">
                <div>© {{ date('Y') }} GEMGEM - <a href="https://gemgem.com/en?srsltid=AfmBOopg27w-evwCERR35qpuHI_GfUxe8toPYRfBsYe6wjH_o0ZH6_x9" target="_blank">GEMGEM</a></div>
                <div>
                    <nav class="nav gap-4">

                        <a href="#" class="nav-link">#</a>

                        <a href="#" target="_blank" class="nav-link">#</a>
                    </nav>
                </div>
            </footer>
            <!-- ./ content-footer -->

        </div>
        <!-- ./ layout-wrapper -->

        <!-- Bundle scripts -->
        <script src="{{ url('libs/bundle.js') }}"></script>

        <!-- Main Javascript file -->
        <script src="{{ url('dist/js/app.min.js') }}"></script>

        <script src="{{ url('assets/js/switchery.js') }}"></script>
        <script src="{{ url('libs/toastr/toastr.min.js') }}"></script>

        @yield('script')
    </body>

</html>
