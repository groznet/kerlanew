<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Kerla'))</title>
    <script src="{{ asset('vendor/tailwind-browser.js') }}"></script>
    <script defer src="{{ asset('vendor/alpine.min.js') }}"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <main class="mx-auto flex min-h-screen w-full max-w-lg items-center px-5 py-10">
        @yield('content')
    </main>
</body>
</html>