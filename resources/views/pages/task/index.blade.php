
@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.select2')

@endpush

@section('content')
<x-bread-crumb-component :modal=true modalType="Task" modalId="add_task" />   
  <x-modal-add-task-component />
  <x-table-task-component />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/task/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
   
    <script src="{{ asset('js/core/task/table.js') }}"></script>
   
        
  
    <script src="{{ asset('js/delete.js') }}"></script>

   
@endpush
