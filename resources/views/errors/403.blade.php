@extends('errors.master')
@section('content')
    <div class="error-box">
        <h1>403</h1>
        <h3><i class="fa fa-warning"></i> Oops! Something went wrong</h3>
        <p>{{ $exception->getMessage() ?: 'Server Error' }} 🔐</p>
        <a href="history.back()" class="btn btn-custom">Go back</a>
    </div>
@endsection

@push('extended-js')
    <script>
        $(function() {
            document.title += ' Unauthorized : 403';
        });
    </script>
@endpush
