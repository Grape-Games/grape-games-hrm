@extends('layouts.auth.master')

@section('content')


    <div class="account-content">
        {{-- <a href="job-list.html" class="btn btn-primary apply-btn">Apply Job</a> --}}
        <div class="container">

            <!-- Account Logo -->
            <div class="account-logo" style="text-align: -webkit-center;">
                <a href="#"><img src="assets/img/logo2.png" alt="Dreamguy's Technologies"></a>
            </div>
            <!-- /Account Logo -->

            <div class="account-box">
                <div class="account-wrapper">
                    <h3 class="account-title">Forgot Password?</h3>
                    <p class="account-subtitle">Enter your email to get a password reset link</p>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <!-- Account Form -->

                    <form id="forgotForm" method="POST" action="{{ route('password.email') }}" novalidate>
                        @csrf
                        <div class="form-group">
                            <label>Email Address</label>
                            <input id="email" name="email" class="form-control" type="email" placeholder="Email Address"
                                required autofocus>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" type="submit">Reset Password</button>
                        </div>
                        <div class="account-footer">
                            <p>Remember your password? <a href="{{ route('login') }}">Login</a></p>
                        </div>
                    </form>
                    <!-- /Account Form -->

                </div>
            </div>
        </div>
    </div>
@endsection
@push('extended-js')
    <script src="{{ asset('js/auth/forgot.js') }}"></script>
@endpush
