@extends('layouts.master')

@push('extended-css')

    @include('vendors.toastr')

@endpush

@section('content')

    <x-bread-crumb-component :modal='false' />

    <x-dashboard-cards-component />

    <x-dashboard-cards-second-component />

    <x-statistics-component />

@endsection

@push('extended-js')

    @if (session()->has('toast'))
        <script>
            makeToastr('success', '👋 Hello {{ $name }} welcome to the system !', 'User logged in successfully.')
        </script>
        {{ session()->forget('toast') }}
    @endif
@endpush
