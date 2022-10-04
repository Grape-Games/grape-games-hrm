@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.select2')

@endpush

@section('content')

  <x-bread-crumb-component :modal=true modalType="Employee Bonus" modalId="add_employee_bonus" /> 
  <x-modal-add-employee-bonus-component />
  <x-table-employee-bonus-component />
    

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/employee-bonus/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
   
    <script src="{{ asset('js/core/employee-bonus/table.js') }}"></script>
   
        
  
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
