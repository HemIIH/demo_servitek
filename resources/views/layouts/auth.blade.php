<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    <style>
        html, body {
        background-color: #e8e8e8;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        height: 100vh;
        margin: 0;
        }

        .full-height {
        height: 100vh;
        }

        .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
        }

        .position-ref {
        position: relative;
        }

        .content {
        text-align: center;
        }

        .links > a {
        color: #605ca8;
        padding: 0 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
        }
        
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div>
            <img style="width: 240px; height: auto;" src="{{ '/assets/img/logo_big.png' }}" alt="Servite GmbH">
        </div>

        @yield('content')

    </div>
</div>
<span id="google_translate_element"></span>
<script>
    
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

</body>
</html>
