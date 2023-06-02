@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')
    @include('vendors.select2')
<style>
  .Progress {
  width: 100%;
  background-color: #E2F6ED;
  height:20px;
  margin-bottom:10px;
}

.Bar {
  width: 0%;
  height: 20px;
  background-color: #4CAF50;
  padding-left:6px;
  padding-right:0px;
  line-height: 20px;
  color: white;
  display:block;
}
.pct{font-size:12px}
</style>
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
