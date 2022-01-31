<div class="row">
    <div class="col-md-6">
        <div class="card punch-status">
            <div class="card-body">
                <h5 class="card-title">Timesheet <small
                        class="text-muted">{{ \Carbon\Carbon::now()->format('l jS \of F Y') }}</small>
                </h5>
                <div class="punch-det">
                    <h6>Punch In at</h6>
                    <p>{{ isset($todayPunches[0]) ? $todayPunches[0]->attendance : 'Not found' }}</p>
                </div>
                <div class="punch-info">
                    <div class="punch-hours">
                        <span>{{ $minutes ?? '0' }} hrs</span>
                    </div>
                </div>
                <div class="punch-btn-section">
                    <button type="button" class="btn btn-primary punch-btn" disabled>Punch @if (count($todayPunches) % 2 == 0) In @else Out @endif
                        ( Not available )</button>
                </div>
                <div class="statistics">
                    <div class="row">
                        <div class="col-md-12 col-12 text-center">
                            <div class="stats-box">
                                <p>Break</p>
                                <h6>1.00 hrs ( 1:15pm to 2:15pm )</h6>
                            </div>
                        </div>
                        {{-- <div class="col-md-6 col-6 text-center">
                            <div class="stats-box">
                                <p>Overtime</p>
                                <h6>3 hrs</h6>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-md-4">
        <div class="card att-statistics">
            <div class="card-body">
                <h5 class="card-title">Statistics</h5>
                <div class="stats-list">
                    <div class="stats-info">
                        <p>Today <strong>3.45 <small>/ 8 hrs</small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 31%"
                                aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>This Week <strong>28 <small>/ 40 hrs</small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 31%"
                                aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>This Month <strong>90 <small>/ 160 hrs</small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 62%"
                                aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>Remaining <strong>90 <small>/ 160 hrs</small></strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 62%" aria-valuenow="62"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="stats-info">
                        <p>Overtime <strong>4</strong></p>
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-md-6">
        <div class="card recent-activity">
            <div class="card-body">
                <h5 class="card-title">Today Activity</h5>
                <ul class="res-activity-list">
                    @forelse ($todayPunches as $punch)
                        <li>
                            <p class="mb-0">Punch @if ($loop->iteration % 2 == 0) Out @else In @endif</p>
                            <p class="res-activity-time">
                                <i class="fa fa-clock-o"></i>
                                {{ $punch->attendance }}
                            </p>
                        </li>
                    @empty
                        <li>
                            <p class="mb-0">No history found.</p>
                            <p class="res-activity-time">
                                <i class="fa fa-clock-o"></i>
                                {{ \Carbon\Carbon::now()->format('H:i:s A') }}
                            </p>
                        </li>
                    @endforelse

                </ul>
            </div>
        </div>
    </div>
</div>
<form id="attendanceHistoryForm" method="GET" novalidate>
    <div class="row filter-row mb-2">
        <div class="col-sm-4">
            <div class="form-group form-focus select-focus">
                <select class="select floating" name="month" required>
                    <option value="">Select Month</option>
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
        <div class="col-sm-4">
            <div class="form-group form-focus select-focus">
                <select class="select floating" name="year" required>
                    <option value="">Select year</option>
                    @foreach ($years as $item)
                        <option value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <button type="submit" href="#" class="btn btn-success btn-block"> Search </button>
        </div>
    </div>
</form>

@push('extended-js')

    <script>
        $("#attendanceHistoryForm").submit(function(e) {
            e.preventDefault();
            $(this).valid() ? this.submit() : '';
        });
    </script>

@endpush
