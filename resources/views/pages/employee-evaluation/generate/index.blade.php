@extends('layouts.master')

@push('extended-css')

    @include('vendors.toastr')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <x-employee-evaluation-table :result=$result /> 

@endsection

@push('extended-js')
    
@endpush
