<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">

    @yield('styles')
</head>
<body>

    @yield('content')


    @section('footer')
        @include('emails.partials.footer')
    @show

</body>
</html>
