@extends('layouts.master')

@push('extended-css')

    @include('vendors.toastr')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <x-employee-print-salary-slip />

@endsection

@push('extended-js')
@endpush
