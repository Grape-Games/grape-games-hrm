@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.select2')

@endpush

@section('content')

  <x-bread-crumb-component :modal=true modalType="New Increment" modalId="add_new_increment" /> 
  
     <x-modal-add-new-increment-component />
      <x-table-increment-component />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/increment/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
   
    <script src="{{ asset('js/core/increment/table.js') }}"></script>
   
        
  
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
