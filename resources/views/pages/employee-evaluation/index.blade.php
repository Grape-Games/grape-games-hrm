@extends('layouts.master')

@push('extended-css')

    @include('vendors.toastr')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <x-employee-see-evaluation />

@endsection 

@push('extended-js')
@endpush