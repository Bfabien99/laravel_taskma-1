@extends('layout.app')
@section('content')
<section class="flex flex-col mx-auto max-w-screen-lg grow p-2">
    <h1 class="text-4xl w-fit mx-auto">my awesome task manager</h1>
    <div class="flex flex-col mx-auto my-8 justify-around p-8">
        <div class="m-10 bg-white p-8 rounded-sm shadow-sm">
            <h3 class="text-lg capitalize font-medium text-center">Task</h3>
            <p class="text-blue-400 font-bold text-right">. Create many task</p>
        </div>
        <div class="m-10 bg-white p-8 rounded-sm shadow-sm">
            <h3 class="text-lg capitalize font-medium text-center">Project</h3>
            <p class="text-blue-400 font-bold text-right">. Create many project</p>
            <p class="text-blue-400 font-bold text-right">. Add many task to project</p>
        </div>
        <div class="m-10 bg-white p-8 rounded-sm shadow-sm">
            <h3 class="text-lg capitalize font-medium text-center">Enjoy</h3>
            <p class="text-blue-400 font-bold text-right">. Have fun</p>
        </div>
    </div>
</section>
@endsection