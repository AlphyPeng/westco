<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Westco</title>

    @vite(['resources/css/app.css', 'resources/js/main.js'])

</head>

<body>
    <div id="app">
        {{-- Your Vue app will render here --}}
    </div>
</body>

</html>