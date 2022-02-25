@extends('layouts.master')

@push('extended-css')
    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.select2')
@endpush

@section('content')
    <x-bread-crumb-component :modal=false />

    <x-dashboard.late-minutes.main-component />

    @if (Request::has('employee_id') || Request::has('company_id'))
        <x-dashboard.late-minutes.show-result :employeeId="request()->get('employee_id')"
            :companyId="request()->get('company_id')" :date="request()->get('date')">
        </x-dashboard.late-minutes.show-result>
    @endif
@endsection

@push('extended-js')
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/late-minutes/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
