@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.select2')

@endpush

@section('content')

   <x-bread-crumb-component :modal=true modalType="Evaluation" modalId="add_evaluation" />
   <x-modal-add-evaluation-component />
   <x-table-evaluation-component />
  
    

@endsection 

@push('extended-js')
    <script src="{{ asset('js/core/evaluation/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
   
        <script src="{{ asset('js/core/evaluation/table.js') }}"></script>
   
        
  
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
