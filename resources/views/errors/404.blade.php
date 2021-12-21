@extends('errors.master')
@section('content')
    <div class="error-box">
        <h1>404</h1>
        <h3><i class="fa fa-warning"></i> Oops! Something went wrong</h3>
        <p>The page you were looking for could not be found. 🔐</p>
        <button onclick="history.back()" class="btn btn-custom">Go back</button>
    </div>
@endsection

@push('extended-js')
    <script>
        $(function() {
            document.title += ' Page Not Found : 404';
        });
    </script>
@endpush
