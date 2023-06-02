@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.select2')

@endpush

@section('content')

  <x-bread-crumb-component :modal=true modalType="Sand wich Rule" modalId="add_sandwichRule" /> 
  
     <x-modal-add-sand-wich-rule-component />
      <x-table-sand-wich-rule-component />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/sandwich/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
   
    <script src="{{ asset('js/core/sandwich/table.js') }}"></script>
   
        
  
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
