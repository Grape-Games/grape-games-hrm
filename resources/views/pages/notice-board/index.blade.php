@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=true modalType="Notice" modalId="add_notice" />

    <x-table-notice-board-component />

    <x-modal-add-notice-component />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/notice-board/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/notice-board/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
