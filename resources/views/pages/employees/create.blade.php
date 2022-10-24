@extends('layouts.master')

@push('extended-css')

    @include('vendors.data-tables')
    @include('vendors.toastr')
    @include('vendors.stepper')
    @include('vendors.select2')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Employee Registration # {{ $registration_no }}</h4>     
                <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
                    <li class="nav-item"><a class="nav-link active" href="#solid-rounded-justified-tab1"
                            data-toggle="tab"><i class="la la-user mr-1"></i> Personal Information</a></li>
                    <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab2"
                            data-toggle="tab"><i class="fa fa-exclamation mr-1"></i> Additional Details</a></li>
                    <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab3"
                            data-toggle="tab"><i class="fa fa-bank mr-1"></i>Bank Details</a></li>
                    <li class="nav-item"><a class="nav-link" href="#solid-rounded-justified-tab4"
                            data-toggle="tab"><i class="la la-wheelchair mr-1"></i>Emergency Contact</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active show" id="solid-rounded-justified-tab1">
                        @if (Route::is('dashboard.employees.edit'))
                            <x-update-employee-component :employeeId="request()->route('employee')->id" />
                        @else
                            <x-employee-personal-information-component :number=$registration_no />  
                        @endif
                    </div>
                    <div class="tab-pane" id="solid-rounded-justified-tab2">
                        @if (Route::is('dashboard.employees.edit'))
                            <x-employee-additional-details-component :employee=$employee />
                        @else
                            <div class="col-12">
                                <div class="alert alert-primary alert-dismissible fade show mt-10" role="alert">
                                    <h3 class="text-center text-danger mt-10 mb-2">Please <a
                                            href="{{ route('dashboard.employees.create') }}">add </a> an employee or
                                        Click
                                        on
                                        update/edit against an employee button to add additional details.
                                        😋</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane" id="solid-rounded-justified-tab3">
                        @if (Route::is('dashboard.employees.edit'))
                            <x-employee-bank-details-component :employee=$employee />
                        @else
                            <div class="col-12">
                                <div class="alert alert-primary alert-dismissible fade show mt-10" role="alert">
                                    <h3 class="text-center text-danger mt-10 mb-2">Please <a
                                            href="{{ route('dashboard.employees.create') }}">add </a> an employee or
                                        Click
                                        on
                                        update/edit against an employee button to add bank details.
                                        😋</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="tab-pane" id="solid-rounded-justified-tab4">
                        @if (Route::is('dashboard.employees.edit'))
                            <x-employee-emergency-contact :employee=$employee />
                        @else
                            <div class="col-12">
                                <div class="alert alert-primary alert-dismissible fade show mt-10" role="alert">
                                    <h3 class="text-center text-danger mt-10 mb-2">Please <a
                                            href="{{ route('dashboard.employees.create') }}">add </a> an employee or
                                        Click
                                        on
                                        update/edit against an employee button to add emergency contacts.
                                        😋</h3>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('extended-js')
    <script src="{{ asset('js/core/employees/main.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/mask.js') }}"></script>   
@endpush
