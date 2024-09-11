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
        <div class="max-w-screen-sm mx-auto flex justify-around font-medium">
        <a href="{{route('user.index')}}">Dashboard</a>
        <a href="{{route('tasks.index')}}">Tasks</a>
        <a href="{{route('projects.index')}}">Projects</a>
        <a href="{{route('logout')}}">Logout</a>
        </div>
    </header>
    <main class="grow flex">
        @yield('content')
    </main>
    <footer></footer>
</body>
</html>