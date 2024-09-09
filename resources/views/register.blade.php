@extends('layout.app')
@section('content')
<section class="flex m-auto">
    <form method="post" class="p-4 bg-white rounded-sm shadow-sm flex flex-col gap-2 w-[500px]">
        <h3 class="uppercase border-b p-1">Register Form</h3>
        @if (session()->has('success'))
            <small class="bg-green-500 text-white p-2 rounded-md">{{session('success')}}</small>
        @endif
        @csrf
        <div class="flex flex-col">
            <label for="">Fullname</label>
            <input type="text" class="border p-2 rounded-sm" name="name" placeholder="Enter your fullname" value="{{old('name')}}">
            @error('name')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="">Email</label>
            <input type="email" class="border p-2 rounded-sm" name="email" placeholder="Enter your email" value="{{old('email')}}">
            @error('email')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="">Password</label>
            <input type="password" class="border p-2 rounded-sm" placeholder="Enter your password" name="password">
            @error('password')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <div class="flex flex-col">
            <label for="">Confirm Password</label>
            <input type="password" class="border p-2 rounded-sm" placeholder="Enter your password again" name="password_confirmation">
            @error('password_confirmation')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        </div>
        <button class="bg-black text-white p-2 rounded-md hover:bg-gray-900">Register</button>
    </form>
</section>
@endsection