@extends('layouts.master')

@push('extended-css')
    @include('vendors.date-time-picker')
    @include('vendors.select2')
    @include('vendors.toastr')
@endpush

@section('content')
    <x-bread-crumb-component :modal=false modalType="" modalId="" showClock=false />

    <livewire:dashboard.employee.attendance-request />

    {{-- <x-employee-attendance-request-form /> --}}
@endsection

@push('extended-js')
    <script src="{{ asset('js/core/biometric-device/main.js') }}"></script>
@endpush
