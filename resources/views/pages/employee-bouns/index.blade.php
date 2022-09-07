@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.select2')

@endpush

@section('content')

  <x-bread-crumb-component :modal=true modalType="Employee Bouns" modalId="add_employee_bouns" /> 
  <x-modal-add-employee-bouns-component />
  <x-table-employee-bouns-component />
    

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/employee-bouns/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
   
        <script src="{{ asset('js/core/employee-bouns/table.js') }}"></script>
   
        
  
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
