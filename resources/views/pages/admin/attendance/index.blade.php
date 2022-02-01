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
                                <td>{{ \Carbon\Carbon::parse($item)->format('d') }}</td>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monthlyAttendance as $item)
                            @if (count($item) > 0)
                                <tr>
                                    <td>
                                        @foreach ($item as $key => $value)
                                            <h2 class="table-avatar">
                                                <a class="avatar avatar-xs" href="profile.html">
                                                    <img alt="" src="assets/img/profiles/avatar-09.jpg">
                                                </a>
                                                <a href="#">
                                                    {{ $value[0]->employee->first_name . ' ' . $value[0]->employee->last_name }}
                                                </a>
                                            </h2>
                                        @break
                            @endforeach
                            </td>
                            @foreach ($monthDays as $item2)

                                @if (isset($item[$item2]))
                                    <td>
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info">
                                            <i class="fa fa-check text-success"></i>
                                        </a>
                                    </td>
                                @else
                                    <td>
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info">
                                            <i class="fa fa-times text-danger"></i>
                                        </a>
                                    </td>
                                @endif

                            @endforeach
                            </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <x-admin.modals.employee-attendance-update-modal />

@endsection

@push('extended-js')
@endpush
