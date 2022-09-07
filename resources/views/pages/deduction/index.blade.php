@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
     @include('vendors.select2')
@endpush

@section('content')

    <x-bread-crumb-component :modal=true modalType="Deduction" modalId="add_deduction" />
    <x-modal-add-deduction-component />
    <x-table-deduction-component />
    

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/deduction/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/deduction/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
