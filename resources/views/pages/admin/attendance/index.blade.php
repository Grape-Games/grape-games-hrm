@extends('layouts.master')

@push('extended-css')
    <style>
        li {
            cursor: pointer;
        }

    </style>
    @include('vendors.select2')
    @include('vendors.toastr')
    @include('vendors.sweet-alerts')

@endpush

@section('content')

    <x-bread-crumb-component :modal=false />

    @if (\Session::has('message') || isset($message))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa fa-check" aria-hidden="true"></i><strong class="ml-2">{{ \Session::get('message') }}
                {{ $message ?? 'Done' }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <form class="mb-4" id="adminEmployeeAttendance" method="GET" novalidate>
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <select class="select select2 floating" name="employee_id" required>
                        <option value="">Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">
                                {{ $employee->first_name . ' ' . $employee->last_name }}
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
                                <th>Stats</th>
                                @foreach ($monthDays as $item)
                                    <th>{{ \Carbon\Carbon::parse($item)->format('d') }}</th>
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
                                <td>{{ count($monthDays) .' Total Days / ' .count($statsArr[$loop->iteration - 1]['presenceArr']) .' Present(s) /' .(count($monthDays) - count($statsArr[$loop->iteration - 1]['presenceArr'])) .' Absent(s)' }}
                                </td>
                                @foreach ($monthDays as $item2)

                                    @if (isset($item[$item2]))
                                        <td>
                                            <a href="javascript:void(0);" class="view-attendance-details"
                                                data-item="{{ $item }}" data-date="{{ $item2 }}"
                                                @foreach ($item as $v)
                                                data-employeeid='{{ $v[0]->employee->id }}'
                                                data-employeename='{{ $v[0]->employee->first_name . ' ' . $v[0]->employee->last_name }}'
                                                data-deviceid='{{ $v[0]->employee->biometric_device_id }}'
                                    @break;
                                @endforeach
                                data-toggle="modal" data-target="#attendance_info_in">
                                <i class="fa fa-check text-success"></i>
                                </a>
                                </td>
                            @else
                                <td>
                                    <a href="javascript:void(0);" class="view-attendance-details-absent"
                                        data-item="{{ $item }}" data-date="{{ $item2 }}"
                                        data-toggle="modal" @foreach ($item as $v)
                                        data-employeeid='{{ $v[0]->employee->id }}'
                                        data-employeename='{{ $v[0]->employee->first_name . ' ' . $v[0]->employee->last_name }}'
                                        data-deviceid='{{ $v[0]->employee->biometric_device_id }}'
                            @break;
                            @endforeach data-target="#attendance_info_out">
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
        $(".employeeAttendanceUpdateForm").submit(function(e) {
            e.preventDefault();
            $(this).valid() ? this.submit() : false;
        });

        $(".view-attendance-details-absent").click(function(e) {
            $("[name=day_attendance]").val($(this).data('date'));
            $("[name=employee_id]").val($(this).data('employeeid').trim());
            $("[name=device_id]").val($(this).data('deviceid'));
            $(".att-info").html('Attendance Info of ' + $(this).data('employeename'));
            $(".li-html-2").html(
                '<li><p class="mb-0">Punch at</p><p class="res-activity-time"><i class="fa fa-clock-o mr-2"></i>No details available</p></li>'
            )
        });

        function timeDiffCalc(dateFuture, dateNow) {
            let diffInMilliSeconds = Math.abs(dateFuture - dateNow) / 1000;

            // calculate days
            const days = Math.floor(diffInMilliSeconds / 86400);
            diffInMilliSeconds -= days * 86400;
            console.log('calculated days', days);

            // calculate hours
            const hours = Math.floor(diffInMilliSeconds / 3600) % 24;
            diffInMilliSeconds -= hours * 3600;
            console.log('calculated hours', hours);

            // calculate minutes
            const minutes = Math.floor(diffInMilliSeconds / 60) % 60;
            diffInMilliSeconds -= minutes * 60;
            console.log('minutes', minutes);

            let difference = '';
            if (days > 0) {
                difference += (days === 1) ? `${days} day, ` : `${days} days, `;
            }

            difference += (hours === 0 || hours === 1) ? `${hours} : ` : `${hours} : `;

            difference += (minutes === 0 || hours === 1) ? `${minutes} hrs` : `${minutes} hrs`;

            return difference;
        }

        $(".view-attendance-details").click(function(e) {
            e.preventDefault();
            $(".li-html").html('');
            $(".punch-in-time").html('NA');
            $(".punch-out-time").html('NA');
            $(".working-hours").html('0:00 hrs');
            $("[name=day_attendance]").val($(this).data('date'));
            $("[name=employee_id]").val($(this).data('employeeid').trim());
            $("[name=device_id]").val($(this).data('deviceid'));
            $(".att-info").html('Attendance Info of ' + $(this).data('employeename'));
            var timestamps = $(this).data('item');
            var datedStampes = timestamps[$(this).data('date')];
            if (datedStampes != undefined) {
                let punchIn = datedStampes[0].attendance;
                let punchOut = datedStampes[datedStampes.length - 1].attendance;
                $(".working-hours").html(timeDiffCalc(new Date(punchOut), new Date(punchIn)));
                $(".punch-in-time").html(punchIn);
                $(".punch-out-time").html(punchOut);
                datedStampes.forEach(element => {
                    $(".li-html").append(
                        '<li><p class="mb-0">Punch at</p><p class="res-activity-time d-inline-block">' +
                        '<i class="fa fa-clock-o"></i>' + element.attendance +
                        '</p><i data-punchid="' + element.id +
                        '" class="fa fa-trash bx-tada pull-right mr-4 delete-punch"></i></li>')
                });
            }
        });

        $(".employeeAttendanceUpdateForm").submit(function(e) {
            e.preventDefault();
            $(this).valid() ? this.submit() : '';
        });

        $("body").on("click", ".delete-punch", function(e) {
            e.preventDefault();
            let punchId = $(this).data('punchid');
            Swal.fire({
                title: "Are you sure to delete ?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-outline-danger ms-1",
                },
                buttonsStyling: false,
            }).then(function(result) {
                if (result.value) {
                    let formData = new FormData();
                    formData.append('id', punchId);
                    dynamicAjax('{{ route('dashboard.delete-punch') }}', "POST", formData, 'ddCallBack')
                }
            });
        });

        function ddCallBack(response) {
            if (response.message == 'success') {
                makeToastr("success", response.response, "Success messsage 😒");
                location.reload();
            } else {
                $(".eror").html(response.responseJSON.response);
            }
        }
    </script>

@endpush
