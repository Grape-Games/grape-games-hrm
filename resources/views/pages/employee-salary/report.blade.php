@extends('layouts.master')

@push('extended-css')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <x-employee-salary-details-component />

@endsection

@push('extended-js')
@endpush
