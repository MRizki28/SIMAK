<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>SIMAK</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('static/img/logo.svg') }}" type="image/svg+xml" />
    @include('Layouts.styles')
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <div class="logo-header position-relative" data-background-color="blue">
                <a href="/" class="logo ">
                    <span class="navbar-brand text-light font-weight-bold " style="left: 65px;">SIMAK</span>
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            @include('Layouts.Navbar')
        </div>

        @include('Layouts.Sidebar')
        <div class="main-panel">
            <div class="content">
                @yield('content')
            </div>
            @include('Layouts.footer')
        </div>
    </div>
    @include('Layouts.scripts')
    @yield('js-url')
</body>

</html>
