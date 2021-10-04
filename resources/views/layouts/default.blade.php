<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facebook</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('facebook.ico') }}" type="image/x-icon">

    <style>
    .user {
    display: inline-block;
    width: 150px;
    height: 150px;
    border-radius: 50%;

    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
    }
    .three {
    background-image: url('https://via.placeholder.com/200x400');
    }
    .bg-facebook{
        background-color: #1A237E;
    }
    </style>
</head>
<body>

    @include('layouts.partials.nav')

    <div class="container">
        @yield('content')
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>