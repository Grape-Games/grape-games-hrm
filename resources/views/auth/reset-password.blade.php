@extends('layouts.auth.master')
@section('content')
    <div class="account-content">
        {{-- <a href="job-list.html" class="btn btn-primary apply-btn">Apply Job</a> --}}
        <div class="container">

            <!-- Account Logo -->
            <div class="account-logo">
                <a href="#"><img src="{{ asset('assets/img/logo2.png') }}" alt="{{ config('app.name') }}"></a>
            </div>
            <!-- /Account Logo -->

            <div class="account-box">
                <div class="account-wrapper">
                    <h3 class="account-title">Reset Password</h3>
                    <p class="account-subtitle">Get you access back to your account</p>

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <div class="form-group">
                            <label>Email Address</label>
                            <input id="email" class="block mt-1 w-full form-control" type="email" name="email"
                                :value="old('email', {{ request()->get('email') }})"
                                value="{{ request()->get('email') }}" required autofocus readonly />
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Password</label>
                                </div>
                            </div>
                            <input id="password" class="block mt-1 w-full form-control" type="password" name="password"
                                placeholder="Password" required autocomplete="current-password"
                                data-msg="Please enter password to proceed.">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Confirm Password</label>
                                </div>
                            </div>
                            <input id="password" class="block mt-1 w-full form-control" type="password"
                                name="password_confirmation" placeholder="Confirm Password" required>
                        </div>
                        <div class="form-group text-center d-first">
                            <button class="btn btn-primary account-btn" type="submit">Reset Password</button>
                        </div>
                        <div class="form-group text-center d-none d-second">
                            <button class="btn btn-primary account-btn" disabled="disabled">
                                <i class="fa fa-spinner fa-spin" style="margin-right:2%;"></i>
                                Resetting Password In...
                            </button>
                        </div>
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
