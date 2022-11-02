@extends('layouts.master')

@push('extended-css')
    
    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.select2')

@endpush

@section('content')

  <x-bread-crumb-component :modal=true modalType="Team Lead Account" modalId="add_employee_hrm_account" />
  <x-modal-add-employee-hrm-account-component />
     <x-model-team-members-component />
     <x-table-team-members-component />

@endsection

@push('extended-js')
    <script src="{{ asset('js/core/team-member/main.js') }}"></script>
    <script src="{{ asset('js/data-table-init.js') }}"></script>
   
    <script src="{{ asset('js/core/team-member/table.js') }}"></script>
@endpush