@extends('layouts.master')

@push('extended-css')

    @include('vendors.toastr')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />
    <x-modal-task-details-view-component />
    <x-employee-task-component />

@endsection 

@push('extended-js')
@endpush