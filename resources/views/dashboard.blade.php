@extends('layouts.master')

@push('extended-css')

    @include('vendors.toastr')

@endpush

@section('content')

    <x-bread-crumb-component :modal='false' />

    @can('is-admin')

        <x-dashboard-cards-first-admin-component />

        <x-dashboard-cards-second-admin-component />

        <x-statistics-component />

    @endcan

    @can('is-employee')

        <x-dashboard-employee-first-component />

    @endcan

@endsection

@push('extended-js')

    @if (session()->has('toast'))
        <script>
            makeToastr('success', '👋 Hello {{ $name }} welcome to the system !', 'User logged in successfully.')
        </script>
        {{ session()->forget('toast') }}
    @endif

@endpush
