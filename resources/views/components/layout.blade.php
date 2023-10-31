<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Fajar Timur Motor</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/scss/app.scss'])

    {{-- Script --}}
    <script src="https://kit.fontawesome.com/4419d23bf4.js" crossorigin="anonymous"></script>
    <script src="{{ asset('jquery.min.js') }}"></script>

    @livewireStyles
    @stack('css')
</head>
<body>
    {{ $slot }}

    @livewireScripts
    @stack('script')
</body>
</html>