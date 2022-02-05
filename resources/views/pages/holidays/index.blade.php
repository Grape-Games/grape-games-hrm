@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=true modalType="Holiday" modalId="add_holiday" />

    <x-table-holidays-component />

    <x-modal-add-holiday />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/holidays/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/holidays/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
