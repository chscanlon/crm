@extends('layouts.app')

@section('sidebar-content')
    <x-sidebar-auth />
@endsection

@section('page-header')
    Import Customer Data
@endsection

@section('content')
    <livewire:customer-import.create />
@endsection