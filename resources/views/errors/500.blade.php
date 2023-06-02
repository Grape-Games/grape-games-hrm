@extends('errors.master')
@section('content')
    <div class="error-box">
        <h1>500</h1>
        <h3><i class="fa fa-warning"></i> Oops! Something went wrong</h3>
        <p>Server Error, try again later 😥</p>
        <button onclick="history.back()" class="btn btn-custom">Go back</button>
    </div>
@endsection

@push('extended-js')
    <script>
        $(function() {
            document.title += ' Server Error : 500';
        });
    </script>
@endpush
