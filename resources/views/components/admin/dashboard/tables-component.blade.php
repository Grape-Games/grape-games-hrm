<style>
    .Progress {
  width: 100%;
  background-color: #ddd;
  height:20px;
  margin-bottom:10px;
}

.Bar {
  width: 45%;
  height: 20px;
  background-color: #4CAF50;
  padding-left:6px;
  padding-right:0px;
  line-height: 20px;
  color: white;
  display:block;
}
.pct{font-size:12px}
</style>
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
                            @forelse ($employees as $employee)
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
                                        @isset($employee->company)
                                        {{ $employee->company->name }}
                                        @endisset
                                    </td>
                                    <td>
                                        <span class="badge bg-inverse-success">Active</span>
                                    </td>
                                </tr>
                            @empty
                                <td colspan=5 class="text-center">No records available.</td>
                            @endforelse
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
                            @forelse ($employees as $employee)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $employee->first_name . ' ' . $employee->last_name }}
                                    </td>
                                    <td>
                                        {{ $employee->user->email ?? 'Not Set' }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-inverse-{{ $employee->user_id == null ? 'warning' : 'success' }}">
                                            {{ $employee->user_id == null ? 'Not Created' : 'Created' }}</span>
                                    </td>
                                </tr>
                            @empty
                                <td colspan=4 class="text-center">No records available.</td>
                            @endforelse
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
                            @forelse ($employeeLeaves as $employee)
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
                            @empty
                                <td colspan=4 class="text-center">No records available.</td>
                            @endforelse
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
                            @forelse ($salaries as $employee)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $employee->employee->first_name . ' ' . $employee->employee->last_name }}
                                    </td>
                                    <td>
                                        Rs : {{ $employee->basic_salary }} /-
                                    </td>
                                </tr>
                            @empty
                                <td colspan=3 class="text-center">No records available.</td>
                            @endforelse
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
                <h3 class="card-title mb-0">Top Rating Employee <small class="text-muted">( Evaluation )</small>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-nowrap custom-table mb-0">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Employee Name</th> 
                                <th>Status</th> 
                                <th>Rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($evalutions as $employee)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $employee->employee->first_name . ' ' . $employee->employee->last_name }}
                                    </td>
                                   <td>
                                      @if($employee->status == 0)
                                        <span class="badge bg-inverse-warning">Pending</span>
                                      @elseif($employee->status == 1)
                                        <span class="badge bg-inverse-success">Approved</span>
                                      @else
                                       <span class="badge bg-inverse-danger">Disapproved</span>
                                      @endif
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
                <a href="{{ route('dashboard.evaluation.index') }}">View all Employees</a>
            </div>
        </div>
    </div>
</div>

