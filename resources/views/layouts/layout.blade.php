<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Facebook | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('facebook.ico') }}" type="image/x-icon">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    
    @yield('content')
    
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>