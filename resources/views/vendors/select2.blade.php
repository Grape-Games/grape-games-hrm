@push('extended-css')

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}">
    <style>
        .select2 {
            width: 100% !important;
            height: 100% !important;
        }

    </style>

@endpush


@push('extended-js')

    <!-- Select2 JS -->
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script>
        $(function() {
            $('.js-example-basic-single').select2();
            $('.select2').select2();
        });
    </script>

@endpush
