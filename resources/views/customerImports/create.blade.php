@extends('layouts.app')

@section('sidebar-content')

    <x-sidebar-auth>

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

    </x-sidebar-auth>



@endsection

@section('content')

    <x-layout.section>
    
        <livewire:customer-import.create />

    </x-layout.section>

@endsection