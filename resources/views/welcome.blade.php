<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel + Inertia</title>

    <!-- Подключаем Vite для сборки стилей и скриптов -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Директива Inertia для подключения заголовков и стилей страниц -->
    @inertiaHead
</head>
<body class="font-sans antialiased">
<!-- Главный контейнер, в который Inertia рендерит Vue -->
@inertia
</body>
</html>
