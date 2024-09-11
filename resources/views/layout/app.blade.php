<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>

<body class="bg-gray-50 flex flex-col min-h-screen">
    <header class="bg-white p-4 font-medium">
        <div class="max-w-screen-lg mx-auto flex justify-between items-center p-2">
            <a href="{{route('home')}}">Home</a>
            <div class="flex gap-5 items-center">
                @auth
                    <a href="{{route('myspace')}}">Dashboard</a>
                    <a href="{{route('logout')}}">Logout</a>
                @else
                    <a href="{{route('login')}}">Login</a>
                    <a href="{{route('register')}}" class="bg-gray-900 hover:bg-black text-white p-2 rounded-md">Register</a>
                @endauth
            </div>
        </div>
    </header>
    <main class="grow flex">
        @yield('content')
    </main>
    <footer></footer>
</body>

</html>