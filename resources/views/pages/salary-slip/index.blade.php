@extends('layouts.master')

@push('extended-css')

    @include('vendors.toastr')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <x-pay-slip-component :salaryDetails=$slip />

@endsection

@push('extended-js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script>
        let fileName =
            '{{ $slip->employee->first_name . '-' . $slip->employee->last_name . '-' . \Carbon\Carbon::now()->format('Y-M') }}';
    </script>
    <script src="{{ asset('js/core/salary-slip/main.js') }}"></script>
@endpush
