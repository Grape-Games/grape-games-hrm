@if (!isset($user->additional) || !isset($user->bank) || !isset($user->emergency))
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="welcome-box">
                    @if (!isset($user->additional))
                        <span class="badge badge-danger bx-flashing mr-2">Additional Information is not set. Kindly let
                            admin
                            know.</span>
                    @endif
                    @if (!isset($user->bank))<span
                            class="badge badge-danger bx-flashing mr-2">Bank Details are not set. Kindly let admin
                            know.</span>
                    @endif
                    @if (!isset($user->emergency))<span
                            class="badge badge-danger bx-flashing mr-2">Emergency Contacts are not set. Kindly let admin
                            know.</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
<div class="content container-fluid">
    <div class="row" style="margin-top:30px">
        <div class="col-md-12">
            <div class="welcome-box">
                <div class="welcome-img">
                    <img alt="" src="{{ $dp->getFirstMediaUrl('avatars') }}"
                        onerror="this.onerror=null; this.src='{{ asset('assets/img/placeholder.jpg') }}'">
                </div>
                <div class="welcome-det">
                    <h3>Welcome, {{ $user->first_name . ' ' . $user->last_name }}</h3>
                    <p>Time : {{ \Carbon\Carbon::now() }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-8">
            <section class="dash-section">
                <h1 class="dash-sec-title">Today</h1>
                <div class="dash-sec-content">
                    <div class="dash-info-list">
                        <a href="#" class="dash-card text-danger">
                            <div class="dash-card-container">
                                <div class="dash-card-icon">
                                    <i class="fa fa-hourglass-o bx-tada"></i>
                                </div>
                                <div class="dash-card-content">
                                    <p>Your task of the day...</p>
                                </div>
                            </div>
                            <div class="pull-left">
                                <small>From : 12:00 Till : 4:00 PM</small>
                            </div>
                        </a>

                    </div>
                    <div class="dash-info-list">
                        <a href="#" class="dash-card text-danger">
                            <div class="dash-card-container">
                                <div class="dash-card-icon">
                                    <i class="fa fa-hourglass-o bx-tada"></i>
                                </div>
                                <div class="dash-card-content">
                                    <p>Your task of the day...</p>
                                </div>
                            </div>
                            <div class="pull-left">
                                <small>From : 12:00 Till : 4:00 PM</small>
                            </div>
                        </a>

                    </div>

                    <div class="dash-info-list">
                        <a href="#" class="dash-card">
                            <div class="dash-card-container">
                                <div class="dash-card-icon">
                                    <i class="fa fa-suitcase"></i>
                                </div>
                                <div class="dash-card-content">
                                    <p>Someone is off today...</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="dash-info-list">
                        <a href="#" class="dash-card">
                            <div class="dash-card-container">
                                <div class="dash-card-icon">
                                    <i class="fa fa-building-o"></i>
                                </div>
                                <div class="dash-card-content">
                                    <p>You are working from office today</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <hr>
                    <x-dashboard-employee-progress-bar-component />
                </div>
            </section>

            <section class="dash-section">
                <h1 class="dash-sec-title">Upcoming Birthdays of employees.</h1>
                <div class="dash-sec-content">
                    <div class="dash-info-list">
                        @forelse ($birthdays as $birthday)
                            <div class="dash-card mt-2">
                                <div class="dash-card-container">
                                    <div class="dash-card-icon">
                                        <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                                    </div>
                                    <div class="dash-card-content">
                                        <p>{{ $birthday->employee->first_name . ' ' . $birthday->employee->last_name }}
                                            has a birthday on {{ $birthday->dob }}.</p>
                                    </div>
                                    {{-- <div class="dash-card-avatars">
                                        <a href="#" class="e-avatar"><img src="assets/img/profiles/avatar-05.jpg"
                                                alt=""></a>
                                    </div> --}}
                                </div>
                            </div>
                        @empty
                            <div class="dash-card">
                                <div class="dash-card-container">
                                    <div class="dash-card-icon">
                                        <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                                    </div>
                                    <div class="dash-card-content">
                                        <p>No upcoming birhtdays.</p>
                                    </div>
                                </div>
                            </div>
                        @endforelse

                    </div>
                </div>
            </section>
            <x-employee-bar-chart-component />
        </div>

        <div class="col-lg-4 col-md-4">
            <div class="dash-sidebar">
                <x-employee-monthly-attendance-component />
                <section>
                    <h5 class="dash-title">Leaves Status</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title bx-flashing text-primary"><small>
                                    Note : Leaves are on yearly basis.</small></div>
                            <div class="time-list">
                                <div class="dash-stats-list">
                                    <h4>{{ $leavesAllowed }}</h4>
                                    <p>Allowed</p>
                                </div>
                                <div class="dash-stats-list">
                                    <h4>{{ $leavesTaken }}</h4>
                                    <p>Taken</p>
                                </div>
                                <div class="dash-stats-list">
                                    <h4>{{ $leavesAllowed - $leavesTaken }}</h4>
                                    <p>Remaining</p>
                                </div>
                            </div>
                            <div class="request-btn">
                                <a class="btn btn-primary" href="{{ route('dashboard.leaves.index') }}">Apply
                                    Leave</a>
                            </div>
                        </div>
                    </div>
                </section>
                {{-- <section>
                    <h5 class="dash-title">Your time off allowance</h5>
                    <div class="card">
                        <div class="card-body">
                            <div class="time-list">
                                <div class="dash-stats-list">
                                    <h4>5.0 Hours</h4>
                                    <p>Approved</p>
                                </div>
                                <div class="dash-stats-list">
                                    <h4>15 Hours</h4>
                                    <p>Remaining</p>
                                </div>
                            </div>
                            <div class="request-btn">
                                <a class="btn btn-primary" href="#">Apply Time Off</a>
                            </div>
                        </div>
                    </div>
                </section> --}}
                <section>
                    <h5 class="dash-title">Upcoming Events</h5>
                    @forelse ($events as $event)
                        <div class="card">
                            <div class="card-body text-center">
                                <h4 class="holiday-title mb-0"><strong>Timing</strong>
                                    <br>{{ $event->start_time->format('Y-M-d H:i') }}
                                    <br> {{ $event->end_time->format('Y-M-d H:i') }}
                                </h4>
                                <h4 class="holiday-title mb-0"><strong>Details : {{ $event->name }}</strong></h4>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-body text-center">
                                <h4 class="holiday-title mb-0"><strong>No upcoming Events.</strong></h4>
                            </div>
                        </div>
                    @endforelse

                </section>
            </div>
        </div>
    </div>
</div>
