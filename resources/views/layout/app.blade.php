<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <header class="bg-white p-4">
        <a href="{{route('home')}}">Home</a>
        @auth
        <a href="{{route('logout')}}">Logout</a>
        @else
        <a href="{{route('login')}}">Login</a>
        <a href="{{route('register')}}">Register</a>
        @endauth
    </header>
    <main class="grow flex flex-col">
        @yield('content')
    </main>
    <footer></footer>
</body>
</html>