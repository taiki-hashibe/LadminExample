<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/scrollbooster@2/dist/scrollbooster.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>{{ config('app.name') }}</title>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        {{ $header }}
        {{ $content }}
        {{ $footer }}
    </div>
</body>

</html>
