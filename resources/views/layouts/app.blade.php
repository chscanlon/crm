@extends('layouts.base')

@section('body')

<div class="w-full flex">

    <div name="sidebar" class=" w-64 min-h-screen bg-indigo-200 border-indigo-300 border-r">
        
        <div class="flex p-4 h-20 items-center">
            <img class="h-14" src="{{ url('image\sh-logo.png') }}" alt="">
            <span class=" ml-4 text-2xl tracking-wide font-extrabold">C R M</span>
        </div>

        <div class="">

            @yield('sidebar-content')

        </div>
    
    </div>

    <div name="main" class="w-full">

        <div name="main-header" class=" h-20 bg-indigo-200 border-indigo-300 border-b">Header</div>

        <div name="main-content" class=" px-5 py-10">

            @yield('content')

        </div>
       
    </div>

</div>




@endsection
