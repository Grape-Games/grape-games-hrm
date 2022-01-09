@extends('layouts.master')

@push('extended-css')

    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    @can('is-admin')
        <x-admin-profile-component />
    @endcan

    @can('is-employee')
        <x-profile-top-component />
    @endcan

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/profile/main.js') }}"></script>
@endpush
