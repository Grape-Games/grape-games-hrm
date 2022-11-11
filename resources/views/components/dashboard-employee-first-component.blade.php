@if (!isset($user->additional) || !isset($user->bank) || !isset($user->emergency))
@push('extended-css')
<style>
   .evaluation-tb .Progress {
  width: 100%;
  background-color: #ddd;
  height:20px;
  margin-bottom:10px;
}

.evaluation-tb .Bar {
  width: 45%;
  height: 20px;
  background-color: #4CAF50;
  padding-left:6px;
  padding-right:0px;
  line-height: 20px;
  color: white;
  display:block;
}
.evaluation-tb .pct{font-size:12px}
</style>
@endpush
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="welcome-box">
                    @if (!isset($user->additional))
                        <span class="mr-2 badge badge-danger bx-flashing">Additional Information is not set. Kindly let
                            admin
                            know.</span>
                    @endif
                    @if (!isset($user->bank))
                        <span class="mr-2 badge badge-danger bx-flashing">Bank Details are not set. Kindly let admin
                            know.</span>
                    @endif
                    @if (!isset($user->emergency))
                        <span class="mr-2 badge badge-danger bx-flashing">Emergency Contacts are not set. Kindly let
                            admin
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
                    <h3>Welcome,
                        @isset($user->first_name)
                            {{ $user->first_name }}
                        @endisset
                        @isset($user->last_name)
                            {{ $user->last_name }}
                        @endisset
                    </h3>
                    <p>Time : {{ \Carbon\Carbon::now()->format('l F j, Y, g:i a') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-8">
            <section class="dash-section">
                <h1 class="dash-sec-title">Timeline</h1>
                <div class="dash-sec-content">
                    @if ($increment->can_view)
                        <div class="dash-info-list">
                            <a href="#" class="dash-card text-success">
                                <div class="dash-card-container">
                                    <div class="dash-card-icon">
                                        <i class="fas fa-bell bx-tada"></i>
                                    </div>
                                    <div class="dash-card-content">
                                        @isset($increment->increment_amount)
                                            <p>
                                                Your next salary increment of Rs : {{ $increment->increment_amount }} will
                                                be
                                                added to your basic salary on
                                                {{ $increment->next_increment->format('l F j, Y, g:i a') }}. Enjoy 🙌
                                            </p>
                                        @else
                                            <p>
                                                Increment is not added yet 😢
                                            </p>
                                        @endisset
                                    </div>
                                </div>
                                <div class="pull-left">
                                    <small>{{ isset($increment->created_at) ? $increment->created_at->diffForHumans() : '' }}</small>
                                </div>
                            </a>
                        </div>
                    @endif
                    @forelse ($notices as $notice)
                        <div class="dash-info-list">
                            <a href="#"
                                class="dash-card @if ($notice->priority == 'high') text-danger @elseif($notice->priority == 'low') text-success @else text-info @endif">
                                <div class="dash-card-container">
                                    <div class="dash-card-icon">
                                        <i class="fas fa-bell bx-tada"></i>
                                    </div>
                                    <div class="dash-card-content">
                                        <p>{{ $notice->details }}</p>
                                    </div>
                                </div>
                                <div class="pull-left">
                                    <small>{{ $notice->created_at->diffForHumans() }}</small>
                                </div>
                            </a>
                        </div>
                    @empty
                        <div class="dash-info-list">
                            <a href="#" class="dash-card text-danger">
                                <div class="dash-card-container">
                                    <div class="dash-card-icon">
                                        <i class="fas fa-sad-cry bx-tada"></i>
                                    </div>
                                    <div class="dash-card-content">
                                        <p>Nothing Found.</p>
                                    </div>
                                </div>
                            </a>

                        </div>
                    @endforelse
                    {{-- <div class="dash-info-list">
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
                    </div> --}}
                    <hr>
                    <x-dashboard-employee-progress-bar-component />
                </div>
            </section>

            <section class="dash-section">
                <h1 class="dash-sec-title">Upcoming Birthdays of employees.</h1>
                <div class="dash-sec-content">
                    <div class="dash-info-list">
                        @forelse ($birthdays as $birthday)
                            <div class="mt-2 dash-card">
                                <div class="dash-card-container">
                                    <div class="dash-card-icon">
                                        <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                                    </div>
                                    <div class="dash-card-content">
                                        <p>{{ $birthday->employee->first_name . ' ' . $birthday->employee->last_name }}
                                            has a birthday on
                                            {{ \Carbon\Carbon::parse($birthday->dob)->format('d M') }}.</p>
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
             {{-- Hoildys --}}
            <div class="card card-table flex-fill">
                <div class="card-header">
                    <h3 class="card-title mb-0"> Recently Holidays
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-nowrap custom-table mb-0 evaluation-tb">
                            <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Detail</th> 
                                    <th>Date</th>
                                    <th>Sand Wich</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($Holidays as $data)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                          {{$data->details}}
                                        </td>  
                                        <td>
                                            {{$data->date->format('d/m/Y')}}
                                        </td>
                                        <td>
                                            @if($data->sandwich_id )
                                             <span class="badge bg-inverse-danger">
                                              {{$data->sandwich->date }} 
                                             </span>
                                            @else
                                             <span class="badge bg-inverse-success">Not Applay</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <td colspan=3 class="text-center">No records available of  this Month.</td>
                                @endforelse
                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>
             {{--end Hoildys --}}
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
                            <div class="text-center card-body">
                                <h4 class="mb-0 holiday-title"><strong>Timing</strong>
                                    <br>{{ $event->start_time->format('Y-M-d H:i') }}
                                    <br> {{ $event->end_time->format('Y-M-d H:i') }}
                                </h4>
                                <h4 class="mb-0 holiday-title"><strong>Details : {{ $event->name }}</strong></h4>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="text-center card-body">
                                <h4 class="mb-0 holiday-title"><strong>No upcoming Events.</strong></h4>
                            </div>
                        </div>
                    @endforelse

                </section>
          {{-- evaluation table --}}
                <div class="card card-table flex-fill">
                    <div class="card-header">
                        <h3 class="card-title mb-0">Recently Evaluations
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-nowrap custom-table mb-0 evaluation-tb">
                                <thead>
                                    <tr>
                                        <th>Sr. No</th>
                                        <th>Date</th> 
                                        <th>Total Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($evaluations as $employee)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                              {{$employee->from_date}}
                                            </td>  
                                            <td>
                                                <div class="Progress">
                                                    <div class="Bar" data-value="{{$employee->total_rating}}"><div  class="pct"></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <td colspan=3 class="text-center">No records available of  this Month.</td>
                                    @endforelse
                                </tbody> 
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('dashboard.employee-evaluation.index') }}">View all</a>
                    </div>
                </div>
                 {{--end evaluation table --}} 
            </div>
        </div>
    </div>
</div>
