<div class="row">
    <div class="col-md-6 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h3 class="card-title mb-0">Employees Table <small class="text-muted">( Most recent )</small></h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Employee Name</th>
                                <th>Registration Number</th>
                                <th>Company</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $employee->first_name . ' ' . $employee->last_name }}
                                    </td>
                                    <td>
                                        {{ $employee->registration_no }}
                                    </td>
                                    <td>
                                        {{ $employee->company->name }}
                                    </td>
                                    <td>
                                    <td>
                                        <span class="badge bg-inverse-success">Active</span>
                                    </td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('dashboard.employees.index') }}">View all Employees</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h3 class="card-title mb-0">Employees Accounts <small class="text-muted">( Most recent )</small>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Employee Name</th>
                                <th>Email Address</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $employee->first_name . ' ' . $employee->last_name }}
                                    </td>
                                    <td>
                                        {{ $employee->user->email }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-inverse-{{ $employee->user_id == null ? 'warning' : 'success' }}">
                                            {{ $employee->user_id == null ? 'Not Created' : 'Created' }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('dashboard.employee-web-accounts.index') }}">View all Employees Accounts</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h3 class="card-title mb-0">Leave Requests <small class="text-muted">( Most recent )</small>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Employee Name</th>
                                <th>Approved By</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employeeLeaves as $employee)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $employee->owner->name }}
                                    </td>
                                    <td>
                                        {{ $employee->approvedBy->name ?? 'Not available' }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-inverse-{{ $employee->status == 'pending' ? 'warning' : 'success' }}">
                                            {{ $employee->status }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('dashboard.employee-leave-approvals') }}">View all Leave Requests</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-flex">
        <div class="card card-table flex-fill">
            <div class="card-header">
                <h3 class="card-title mb-0">Top Salaries <small class="text-muted">( Ordered by highly Paid
                        Employees )</small>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Employee Name</th>
                                <th>Salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salaries as $employee)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $employee->employee->first_name . ' ' . $employee->employee->last_name }}
                                    </td>
                                    <td>
                                        {{ $employee->basic_salary }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ route('dashboard.employees.index') }}">View all Employees</a>
            </div>
        </div>
    </div>
</div>
