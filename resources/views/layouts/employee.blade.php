<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">

    <style>
        [v-cloak] {display: none;}
        
    </style>

</head>

<body class="skin-purple sidebar-mini">
<div id="app" class="wrapper" v-cloak>

    <header class="main-header">
        <a href="{{ url('/e/dashboard') }}" class="logo">
            <span class="logo-mini"></span>
            <span class="logo-lg"><b>DispoM@ster</b></span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <message></message>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true"><i class="fa fa-gears"></i><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li {{ set_active('e/settings*') }}><a href="{{ url('e/settings') }}">{{trans('employee.Konto')}}</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i></a>
                    </li>

                </ul>
            </div>
        </nav>
    </header>

    @include('layouts.partials.employee.sidebar')

    <div class="content-wrapper">
        <section class="content" style="overflow: hidden;">

            @yield('content')

        </section>

    </div>

    <footer class="main-footer">
        <strong>© Servite GmbH - 2019</strong>
    </footer>


    <flash message="{{ session('message') }}" type="{{ session('type') }}"></flash>
    <modal></modal>

</div>


<script>

    if (Boolean(localStorage.getItem('sidebar-collapsed'))) {
        document.body.className += ' sidebar-collapse';
    }

</script>
<script src="{{route('assets.lang.e')}}"></script>
<script src="{{ asset('/js/employee.js') }}"></script>

<script>
    $(document).ready(function () {

        $('.sidebar-toggle').click(() => {
            if (Boolean(localStorage.getItem('sidebar-collapsed'))) {
                localStorage.setItem('sidebar-collapsed', '');
            } else {
                localStorage.setItem('sidebar-collapsed', '1');
            }
        });
    });
    
</script>

@yield('scripts')
</body>

</html>
