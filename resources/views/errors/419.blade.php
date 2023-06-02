@extends('errors.master')
@section('content')
    <div class="error-box">
        <h1>419</h1>
        <h3><i class="fa fa-warning"></i> Oops! Something went wrong</h3>
        <p>Token expired. Please try again 😥</p>
        <button onclick="history.back()" class="btn btn-custom">Go back</button>
    </div>
@endsection

@push('extended-js')
    <script>
        $(function() {
            document.title += ' Token Mismatch : 419';
        });
    </script>
@endpush
