@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.select2')

@endpush
@section('content')
<x-bread-crumb-component :modal=false/>   
<x-task-view-component />
<x-task-comment-component />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/task/task_details.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
   
    <script src="{{ asset('js/delete.js') }}"></script>

   
@endpush