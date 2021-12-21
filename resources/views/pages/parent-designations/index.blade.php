@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=true modalType="Parent Designations" modalId="add_parent_designation" />

    <x-table-parent-designations-component />

    <x-modal-add-parent-desgination-component />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/designations/parent-designations/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/designations/parent-designations/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
