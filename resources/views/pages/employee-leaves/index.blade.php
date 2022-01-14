@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=true modalType="Leave" modalId="add_leave" />

    <x-table-employee-leave-component />

    <x-modal-add-employee-leave-component />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/employee-leaves/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/employee-leaves/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
