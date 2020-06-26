@extends('layouts.app')

@section('sidebar-content')
    <x-sidebar-auth />
@endsection

@section('content')

    <x-layout.section>
    
        <livewire:customer.index />

    </x-layout.section>

@endsection