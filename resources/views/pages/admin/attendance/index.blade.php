@extends('layouts.master')

@push('extended-css')

    @include('vendors.select2')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />


    <div class="row filter-row">
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus">
                <input type="text" class="form-control floating">
                <label class="focus-label">Employee Name</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus select-focus">
                <select class="select floating">
                    <option>Month</option>
                    <option>Jan</option>
                    <option>Feb</option>
                    <option>Mar</option>
                    <option>Apr</option>
                    <option>May</option>
                    <option>Jun</option>
                    <option>Jul</option>
                    <option>Aug</option>
                    <option>Sep</option>
                    <option>Oct</option>
                    <option>Nov</option>
                    <option>Dec</option>
                </select>
                <label class="focus-label">Select Month</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="form-group form-focus select-focus">
                <select class="select floating">
                    <option>Year</option>
                    <option>2019</option>
                    <option>2018</option>
                    <option>2017</option>
                    <option>2016</option>
                    <option>2015</option>
                </select>
                <label class="focus-label">Select Year</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <a href="#" class="btn btn-success btn-block"> Search </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table table-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            @foreach ($monthDays as $item)
                                <td>{{ $item }}</td>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a class="avatar avatar-xs" href="profile.html"><img alt=""
                                            src="assets/img/profiles/avatar-09.jpg"></a>
                                    <a href="profile.html">John Doe</a>
                                </h2>
                            </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td>
                                <div class="half-day">
                                    <span class="first-off"><a href="javascript:void(0);" data-toggle="modal"
                                            data-target="#attendance_info"><i
                                                class="fa fa-check text-success"></i></a></span>
                                    <span class="first-off"><i class="fa fa-close text-danger"></i></span>
                                </div>
                            </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td>
                                <div class="half-day">
                                    <span class="first-off"><i class="fa fa-close text-danger"></i></span>
                                    <span class="first-off"><a href="javascript:void(0);" data-toggle="modal"
                                            data-target="#attendance_info"><i
                                                class="fa fa-check text-success"></i></a></span>
                                </div>
                            </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                        </tr>
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a class="avatar avatar-xs" href="profile.html"><img alt=""
                                            src="assets/img/profiles/avatar-09.jpg"></a>
                                    <a href="profile.html">Richard Miles</a>
                                </h2>
                            </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                        </tr>
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a class="avatar avatar-xs" href="profile.html"><img alt=""
                                            src="assets/img/profiles/avatar-10.jpg"></a>
                                    <a href="profile.html">John Smith</a>
                                </h2>
                            </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                        </tr>
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a class="avatar avatar-xs" href="profile.html"><img alt=""
                                            src="assets/img/profiles/avatar-05.jpg"></a>
                                    <a href="profile.html">Mike Litorus</a>
                                </h2>
                            </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                        </tr>
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a class="avatar avatar-xs" href="profile.html"><img alt=""
                                            src="assets/img/profiles/avatar-11.jpg"></a>
                                    <a href="profile.html">Wilmer Deluna</a>
                                </h2>
                            </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                        </tr>
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a class="avatar avatar-xs" href="profile.html"><img alt=""
                                            src="assets/img/profiles/avatar-12.jpg"></a>
                                    <a href="profile.html">Jeffrey Warden</a>
                                </h2>
                            </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                        </tr>
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a class="avatar avatar-xs" href="profile.html"><img alt=""
                                            src="assets/img/profiles/avatar-13.jpg"></a>
                                    <a href="profile.html">Bernardo Galaviz</a>
                                </h2>
                            </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                        </tr>
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a class="avatar avatar-xs" href="profile.html"><img alt=""
                                            src="assets/img/profiles/avatar-01.jpg"></a>
                                    <a href="profile.html">Lesley Grauer</a>
                                </h2>
                            </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                        </tr>
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a class="avatar avatar-xs" href="profile.html"><img alt=""
                                            src="assets/img/profiles/avatar-16.jpg"></a>
                                    <a href="profile.html">Jeffery Lalor</a>
                                </h2>
                            </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                        </tr>
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a class="avatar avatar-xs" href="profile.html"><img alt=""
                                            src="assets/img/profiles/avatar-04.jpg"></a>
                                    <a href="profile.html">Loren Gatlin</a>
                                </h2>
                            </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><i class="fa fa-close text-danger"></i> </td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                            <td><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i
                                        class="fa fa-check text-success"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <x-admin.modals.employee-attendance-update-modal />

@endsection

@push('extended-js')
@endpush
