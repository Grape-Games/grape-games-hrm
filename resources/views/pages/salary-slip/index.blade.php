@extends('layouts.master')

@push('extended-css')

    @include('vendors.toastr')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <x-pay-slip-component :salaryDetails=$slip /> 

@endsection

@push('extended-js')
    <script type="text/javascript" src="{{ asset('js/extensions/jspdf/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/extensions/jspdf/html2canvas.js') }}"></script>
    <script>
        let fileName =
            '{{ $slip->employee->first_name . '-' . $slip->employee->last_name . '-' . \Carbon\Carbon::now()->format('Y-M') }}';
    </script>
    <script src="{{ asset('js/core/salary-slip/main.js') }}"></script>
@endpush
