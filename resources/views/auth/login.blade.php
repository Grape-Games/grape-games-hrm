@extends('layouts.auth.master')
@section('content')

    <div class="account-content">
        {{-- <a href="job-list.html" class="btn btn-primary apply-btn">Apply Job</a> --}}
        <div class="container">

            <!-- Account Logo -->
            <div class="account-logo">
                <a href="index.html"><img src="assets/img/logo2.png" alt="{{ config('app.name') }}"></a>
            </div>
            <!-- /Account Logo -->

            <div class="account-box">
                <div class="account-wrapper">
                    <h3 class="account-title">Login</h3>
                    <p class="account-subtitle">Access to our dashboard</p>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <!-- Account Form -->
                    <form id="loginForm" method="POST" action="{{ route('login') }}" novalidate>
                        @csrf
                        <div class="form-group">
                            <label>Email Address</label>
                            <input id="email" class="block mt-1 w-full form-control" type="email" name="email"
                                :value="old('email')" required autofocus placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Password</label>
                                </div>
                                <div class="col-auto">
                                    <a class="text-muted" href="#">
                                        Forgot password?
                                    </a>
                                </div>
                            </div>
                            <input id="password" class="block mt-1 w-full form-control" type="password" name="password"
                                placeholder="Password" required autocomplete="current-password"
                                data-msg="Please enter password to proceed.">
                        </div>
                        <div class="form-group text-center d-first">
                            <button class="btn btn-primary account-btn" type="submit">Login</button>
                        </div>
                        <div class="form-group text-center d-none d-second">
                            <button class="btn btn-primary account-btn" disabled="disabled">
                                <i class="fa fa-spinner fa-spin" style="margin-right:2%;"></i>
                                Logging In...
                            </button>
                        </div>
                        <div class="account-footer">
                            <p>Don't have an account yet? <a href="#">Register</a></p>
                        </div>
                    </form>
                    <!-- /Acc`ount Form -->
                </div>
            </div>
        </div>
    </div>

@endsection
