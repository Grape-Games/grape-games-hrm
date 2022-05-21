<div>
    <!-- Let all your things have their places; let each part of your business have its time. - Benjamin Franklin -->
    <div class="card">
        <div class="card-header">
            Query Result
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0 table-striped custom-table table-nowrap">
                    <thead>
                        <tr>
                            <th colspan=12 style="text-align: center">
                                <h3>{{ env('APP_NAME') }}</h3>
                                Month of {{ date('M Y', strtotime($date)) }} has
                                <br>
                                {{ $satSuns['saturdays'] . ' Saturdays and ' . $satSuns['sundays'] . ' Sundays' }}
                                <br>
                                <span class="text-white badge bg-success">Note : Saturdays and Sundays are paid</span>
                            </th>
                        </tr>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Leaves Allowed ( Yearly )</th>
                            <th>Leaves Taken ( Yearly )</th>
                            <th>Leaves Left ( Yearly )</th>
                            <th>Leaves Approved ( Monthly )</th>
                            <th>Leaves Pending ( Monthly )</th>
                            <th>Leaves Rejected ( Monthly )</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $employee)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $employee['employee']->first_name . ' ' . $employee['employee']->last_name }}
                                </td>
                                <td>
                                    {{ $employee['employee']->designation->name ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['leaves_allowed'] . ' day(s)' }}
                                </td>
                                <td>
                                    @forelse ($employee['leaves_taken'] as $leave)
                                        {{ $leave->number_of_leaves . ' day(s)' }}
                                        <br>From : <b>{{ \Carbon\Carbon::parse($leave->from_date)->format('Y-m-d l') }}</b>
                                        <br>To : <b>{{ \Carbon\Carbon::parse($leave->to_date)->format('Y-m-d l') }}</b>
                                        <p>Approved by : <b>{{ $leave->approvedBy?->name ?? 'Not available' }}</b>
                                        </p>
                                    @empty
                                        {{ '0 day(s)' }}
                                    @endforelse
                                </td>
                                <td>
                                    {{ $employee['leaves_left'] . ' day(s)' }}
                                </td>
                                <td>
                                    @forelse ($employee['leaves_approved'] as $leave)
                                        {{ $leave->number_of_leaves . ' day(s)' }}
                                        @if(in_array(\Carbon\Carbon::parse($leave->from_date)->dayOfWeek, [\Carbon\Carbon::MONDAY , \Carbon\Carbon::FRIDAY]) || 
                                        in_array(\Carbon\Carbon::parse($leave->to_date)->dayOfWeek, [\Carbon\Carbon::MONDAY , \Carbon\Carbon::FRIDAY]))
                                        <span class="badge badge-danger">SANDWICH</span>
                                        @endif
                                        <br>From : <b>{{ \Carbon\Carbon::parse($leave->from_date)->format('Y-m-d l') }}</b>
                                        <br>To : <b>{{ \Carbon\Carbon::parse($leave->to_date)->format('Y-m-d l') }}</b>
                                        <p>Approved by : <b>{{ $leave->approvedBy?->name ?? 'Not available' }}</b>
                                        </p>
                                    @empty
                                        {{ '0 day(s)' }}
                                    @endforelse
                                </td>
                                <td>
                                    @forelse ($employee['leaves_pending'] as $leave)
                                        {{ $leave->number_of_leaves . ' day(s)' }}
                                        @if(in_array(\Carbon\Carbon::parse($leave->from_date)->dayOfWeek, [\Carbon\Carbon::MONDAY , \Carbon\Carbon::FRIDAY]) || 
                                        in_array(\Carbon\Carbon::parse($leave->to_date)->dayOfWeek, [\Carbon\Carbon::MONDAY , \Carbon\Carbon::FRIDAY]))
                                        <span class="badge badge-danger">SANDWICH</span>
                                        @endif
                                        <br><b>From : {{ \Carbon\Carbon::parse($leave->from_date)->format('Y-m-d l') }}</b>
                                        <br><b>To : {{ \Carbon\Carbon::parse($leave->to_date)->format('Y-m-d l') }}</b>
                                        <p><b>On Pending by : <b>{{ $leave->approvedBy?->name ?? 'Not available' }}</b>
                                        </p>
                                    @empty
                                        {{ '0 day(s)' }}
                                    @endforelse
                                </td>
                                <td>
                                    @forelse ($employee['leaves_rejected'] as $leave)
                                        {{ $leave->number_of_leaves . ' day(s)' }}
                                        @if(in_array(\Carbon\Carbon::parse($leave->from_date)->dayOfWeek, [\Carbon\Carbon::MONDAY , \Carbon\Carbon::FRIDAY]) || 
                                        in_array(\Carbon\Carbon::parse($leave->to_date)->dayOfWeek, [\Carbon\Carbon::MONDAY , \Carbon\Carbon::FRIDAY]))
                                        <span class="badge badge-danger">SANDWICH</span>
                                        @endif
                                        <br>From : <b>{{ \Carbon\Carbon::parse($leave->from_date)->format('Y-m-d l') }}</b>
                                        <br>To : <b>{{ \Carbon\Carbon::parse($leave->to_date)->format('Y-m-d l') }}</b>
                                        <p>Rejected by : <b>{{ $leave->approvedBy?->name ?? 'Not available' }}</b>
                                        </p>
                                    @empty
                                        {{ '0 day(s)' }}
                                    @endforelse
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('extended-js')
    <script>
        $(function() {
            makeDTnAjax("table", "A3");
        });
    </script>
@endpush
