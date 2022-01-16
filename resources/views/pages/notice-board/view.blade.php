@extends('layouts.master')

@push('extended-css')

    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <x-notice-board-component />

@endsection

@push('extended-js')
@endpush
