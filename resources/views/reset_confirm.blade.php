@extends('layout.app')
@section('content')
<section class="flex m-auto max-w-screen-lg grow p-2">
    <form action="{{route('reset.post')}}" method="post" class="mx-auto p-4 bg-white rounded-sm shadow-sm flex flex-col gap-2 w-full max-w-[500px]">
        <h3 class="uppercase border-b p-1 font-medium text-center">Reset Form</h3>
        @if (session()->has('error'))
            <small class="bg-red-400 text-white p-2 rounded-md">{{session('error')}}</small>
        @endif
        @csrf
        <div class="flex flex-col">
        @if (session()->has(key: 'success'))
            <div class="flex flex-col">
                <small class="bg-green-500 text-white w-fit p-1">{{session('success')}}</small>
                <p>Go to open your mail</p>
            </div>
        @else
            <small>Enter your mail and you'll receive the link to recover your password</small>
            <label for="" class="font-medium capitalize">Email</label>
            <input type="email" class="border p-2 rounded-sm" name="email" value="{{old('email')}}" placeholder="JhonDoe@jd.com">
            @error('email')
                <small class="text-red-400">{{$message}}</small>
            @enderror
        @endif
        </div>
        <button class="bg-gray-900 hover:bg-black text-white p-2 rounded-md font-medium" @if(session()->has(key: 'success')) disabled @endif>Send</button>
    </form>
</section>
@endsection