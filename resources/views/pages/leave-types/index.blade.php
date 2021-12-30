@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=true modalType="Leave Type" modalId="add_leave_type" />

    <x-table-leave-type-component />

    <x-modal-add-leave-type />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/leave-types/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/leave-types/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
