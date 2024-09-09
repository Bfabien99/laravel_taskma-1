@extends('layout.app')
@section('content')
<section class="flex m-auto">
    <form method="post" class="p-4 bg-white rounded-sm shadow-sm flex flex-col gap-2 w-[500px]">
        <h3 class="uppercase border-b p-1">Login Form</h3>
        @if (session()->has('error'))
            <small class="bg-red-400 text-white p-2 rounded-md">{{session('error')}}</small>
        @endif
        @csrf
        <div class="flex flex-col">
            <label for="">Email</label>
            <input type="email" class="border p-2 rounded-sm" name="email" value="{{old('email')}}" placeholder="JhonDoe@jd.com">
            @error('email')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="">Password</label>
            <input type="password" class="border p-2 rounded-sm" name="password" placeholder="********">
            @error('password')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <button class="bg-black text-white p-2 rounded-md hover:bg-gray-900">Login</button>
    </form>
</section>
@endsection