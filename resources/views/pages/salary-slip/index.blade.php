@extends('layouts.master')

@push('extended-css')

    @include('vendors.toastr')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <x-pay-slip-component :salaryDetails=$slip />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/salary-slip/main.js') }}"></script>
@endpush
