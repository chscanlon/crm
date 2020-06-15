@extends('layouts.app')

@section('sidebar-content')

    <x-sidebar-auth>

        @auth

            <a
            href="/customerImports/create"
            class=
            "
                font-medium
                text-indigo-600
                hover:text-indigo-500
                focus:outline-none
                focus:underline
                transition ease-in-out duration-150
            "
            >
                Customer Import
            </a>

        @endauth

    </x-sidebar-auth>



@endsection

@section('content')

    @auth
        Here we are in the landing page
    @else
        <x-main-non-auth></x-main-non-auth>
    @endauth

@endsection