@extends('layouts.master')

@push('extended-css')

    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <x-activities-component />

@endsection

@push('extended-js')
    {{-- <script src="{{ asset('js/core/biometric-device/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/biometric-device/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script> --}} 
@endpush
