@extends('layouts.master')

@push('extended-css')

    @include('vendors.date-time-picker')
    @include('vendors.select2')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false modalType="" modalId="" />

    <x-employee-attendance-request-form />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/biometric-device/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/biometric-device/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
