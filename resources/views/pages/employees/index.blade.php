@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <x-table-employees-component />

@endsection

@push('extended-js')
    <script src="{{ asset('js/data-table-init.js') }}"></script>
    <script src="{{ asset('js/core/employees/table.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
    <script>
        let EmployeeEdit = "{{ route('dashboard.employees.edit', [1]) }}";
    </script>
@endpush
