@extends('layout.user')
@section('content')
<section class="flex flex-col mx-auto max-w-screen-lg grow p-2">
    <h1 class="text-8xl w-fit mx-auto">my space</h1>
    <div class="flex flex-col mx-auto my-8 justify-around p-8">
    <div class="m-10 bg-white p-8 rounded-sm shadow-sm">
            <h3 class="text-lg capitalize font-medium">Task created</h3>
            <p class="text-blue-400 font-bold text-right">{{auth()->user()->tasks->count()}}</p>
        </div>
        <div class="m-10 bg-white p-8 rounded-sm shadow-sm">
            <h3 class="text-lg capitalize font-medium">Project created</h3>
            <p class="text-blue-400 font-bold text-right">{{auth()->user()->projects->count()}}</p>
        </div>
    </div>
</section>
@endsection