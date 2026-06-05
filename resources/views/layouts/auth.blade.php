<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">
    <div class="min-h-screen flex items-center justify-center">
        @yield('content')
    </div>
</body>

</html>