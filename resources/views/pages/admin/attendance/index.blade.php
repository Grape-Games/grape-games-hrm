@extends('layouts.master')

@push('extended-css')

    @include('vendors.select2')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    <form class="mb-4" id="adminEmployeeAttendance" method="GET" novalidate>
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <select class="select select2 floating" name="employee_id" required>
                        <option value="">Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->first_name . ' ' . $employee->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select class="select select2 floating" name="month" required>
                        <option value="">Month</option>
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
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select class="select select2 floating" name="year" required>
                        <option value="">Year</option>
                        @foreach ($years as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-success btn-block"> Search </button>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table table-nowrap mb-0">
                    @if (count($monthlyAttendance[0]) > 0)
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
                                            <a href="javascript:void(0);" class="view-attendance-details"
                                                data-item="{{ $item }}" data-date="{{ $item2 }}"
                                                data-toggle="modal" data-target="#attendance_info">
                                                <i class="fa fa-check text-success"></i>
                                            </a>
                                        </td>
                                    @else
                                        <td>
                                            <a href="javascript:void(0);" class="view-attendance-details"
                                                data-item="{{ $item }}" data-date="{{ $item2 }}"
                                                data-toggle="modal" data-target="#attendance_info">
                                                <i class="fa fa-times text-danger"></i>
                                            </a>
                                        </td>
                                    @endif

                                @endforeach
                                </tr>
                            @endif
                    @endforeach
                    </tbody>
                @else
                    <div class="alert alert-danger alert-dismissible fade show bx-flashing" role="alert">
                        <strong>Message : </strong>No records found.<button type="button" class="close"
                            data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif
                </table>
            </div>
        </div>
    </div>


    <x-admin.modals.employee-attendance-update-modal />

@endsection

@push('extended-js')

    <script>
        $("#adminEmployeeAttendance").submit(function(e) {
            e.preventDefault();
            $(this).valid() ? this.submit() : false;
        });

        $(".view-attendance-details").click(function(e) {
            e.preventDefault();
            $(".li-html").html('');
            $(".punch-in-time").html('NA');
            $(".punch-out-time").html('NA');
            $(".working-hours").html('0:00 hrs');
            var timestamps = $(this).data('item');
            var datedStampes = timestamps[$(this).data('date')];
            console.log(datedStampes);
            if (datedStampes != undefined) {
                $(".punch-in-time").html(datedStampes[0].attendance);
                $(".punch-out-time").html(datedStampes[datedStampes.length - 1].attendance);
                datedStampes.forEach(element => {
                    $(".li-html").append(
                        '<li><p class="mb-0">Punch at</p><p class="res-activity-time">' +
                        '<i class="fa fa-clock-o"></i>' + element.attendance + '</p></li>')
                });
            }
        });
    </script>

@endpush
