@extends('layouts.base')

@section('body')

<div class="w-full flex">

    <div name="sidebar" class="w-1/6 min-h-screen border-r border-gray-400">
        
        <div class="flex p-4 items-center bg-gray-200">
            <img class="h-14" src="{{ url('image\sh-logo.png') }}" alt="">
            <span class=" ml-6 text-2xl tracking-widest font-extrabold">C R M</span>
        </div>

        <div>

            @yield('sidebar-content')

        </div>
    
    </div>

    <div name="main" class="w-full bg-green-300">

        <div name="main-header" class=" bg-gray-200">Header</div>

        <div name="main-content" class=" p-10">

            @yield('content')

        </div>
       
    </div>

</div>




@endsection
