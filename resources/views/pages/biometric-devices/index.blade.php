@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=true modalType="Biometric Device" modalId="add_biometric_device" />

    <x-table-biometric-devices-component />

    <x-modal-add-biometric-device />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/biometric-device/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/biometric-device/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
