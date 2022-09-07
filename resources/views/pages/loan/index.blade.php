  @extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.select2')

@endpush

@section('content')

  <x-bread-crumb-component :modal=true modalType="New Loan" modalId="add_loan" /> 
  <x-modal-add-loan-component />
  <x-table-loan-component />
  

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/loan/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
   
        <script src="{{ asset('js/core/loan/table.js') }}"></script>
   
        
  
    <script src="{{ asset('js/delete.js') }}"></script>
@endpush
