<div class="modal custom-modal fade" id="attendance_info_in" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title att-info att-info">Attendance Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card punch-status">
                            <div class="card-body">
                                <h5 class="card-title">Timesheet <small class="text-muted day"></small>
                                </h5>
                                <div class="punch-det">
                                    <h6 class="punch-status">Punch In at</h6>
                                    <p class="punch-in-time">NA</p>
                                </div>
                                <div class="punch-info">
                                    <div class="punch-hours">
                                        <span class="working-hours">0:00 hrs</span>
                                    </div>
                                </div>
                                <div class="punch-det">
                                    <h6>Punch Out at</h6>
                                    <p class="punch-out-time">NA</p>
                                </div>
                                <div class="statistics">
                                    <div class="row">
                                        <div class="col-md-12 col-12 text-center">
                                            <div class="stats-box">
                                                <p>Break</p>
                                                <h6>1.00 hrs ( 1 : 15pm to 2 : 15pm )</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="timings">
                                    <form class="employeeAttendanceUpdateForm"
                                        action="{{ route('api.employee.attendance.save-attendance') }}" method="POST"
                                        novalidate>
                                        @csrf
                                        <input type="hidden" name="day_attendance">
                                        <input type="hidden" name="employee_id">
                                        <input type="hidden" name="device_id">
                                        <div class="row">
                                            <div class="col-md-6 col-6 text-center">
                                                <div class="stats-box">
                                                    <p>Punch In</p>
                                                    <input type="time" class="form-control" name="punch_in_time"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center">
                                                <div class="stats-box">
                                                    <p>Punch Out</p>
                                                    <input type="time" class="form-control" name="punch_out_time">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="punch-btn-section punch-in-btn mt-2">
                                            <button type="submit" class="btn btn-primary punch-btn">Update Now</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card recent-activity">
                            <div class="card-body">
                                <h5 class="card-title">Activity</h5>
                                <div class="eror text-danger"></div>
                                <ul class="res-activity-list li-html">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal custom-modal fade" id="attendance_info_out" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title att-info"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card punch-status">
                            <div class="card-body">
                                <h5 class="card-title">Timesheet <small class="text-muted day"></small>
                                </h5>
                                <div class="punch-det">
                                    <h6 class="punch-status">Punch In at</h6>
                                    <p class="punch-in-time-2">NA</p>
                                </div>
                                <div class="punch-info">
                                    <div class="punch-hours">
                                        <span class="working-hours">0:00 hrs</span>
                                    </div>
                                </div>
                                <div class="punch-det">
                                    <h6>Punch Out at</h6>
                                    <p class="punch-out-time-2">NA</p>
                                </div>
                                <div class="statistics">
                                    <div class="row">
                                        <div class="col-md-12 col-12 text-center">
                                            <div class="stats-box">
                                                <p>Break</p>
                                                <h6>1.00 hrs ( 1 : 15pm to 2 : 15pm )</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="timings">
                                    <form class="employeeAttendanceUpdateForm"
                                        action="{{ route('api.employee.attendance.save-attendance') }}" method="POST"
                                        novalidate>
                                        @csrf
                                        <input type="hidden" name="day_attendance">
                                        <input type="hidden" name="employee_id">
                                        <input type="hidden" name="device_id">
                                        <div class="row">
                                            <div class="col-md-6 col-6 text-center">
                                                <div class="stats-box">
                                                    <p>Punch In</p>
                                                    <input type="time" class="form-control" name="punch_in_time"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-6 text-center">
                                                <div class="stats-box">
                                                    <p>Punch Out</p>
                                                    <input type="time" class="form-control" name="punch_out_time">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="punch-btn-section punch-in-btn mt-2">
                                            <button type="submit" class="btn btn-primary punch-btn">Update Now</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card recent-activity">
                            <div class="card-body">
                                <h5 class="card-title">Activity</h5>
                                <ul class="res-activity-list li-html-2">
                                    <li>
                                        <p class="mb-0">Punch at</p>
                                        <p class="res-activity-time">
                                            <i class="fa fa-clock-o mr-2"></i>Attendance Not available
                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
