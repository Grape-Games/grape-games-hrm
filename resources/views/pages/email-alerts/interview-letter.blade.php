@extends('layouts.master')

@push('extended-css')

    @include('vendors.toastr')
    @include('vendors.select2')
    @include('vendors.date-time-picker')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <x-email-alerts.interview-letter-form />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/email-alerts/interview-letter.js') }}"></script>
@endpush
