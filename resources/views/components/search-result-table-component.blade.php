<div class="row">
    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title mb-0">Company Employee Table</h4>
                        <p class="card-text">
                            This table show a list of all
                            <code>employees</code> in the system.
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-stripped mb-0 employees-results-table">
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Month</td>
                                <td>Days</td>
                                <td>Working Days<br> <small class="text-muted">*All days except Saturdays and
                                        Sundays.</small></td>
                                <td>Holidays<br> <small class="text-muted">* Satudays and Sundays</small></td>
                                <td>Leaves</td>
                                <td>Paid</td>
                                <td>Unpaid</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $employee)
                                <tr>
                                    <td>
                                        {{ $employee->first_name . ' ' . $employee->last_name }}
                                    </td>
                                    <td>
                                        <span class="badge badge-success">{{ $month }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-info">{{ $days }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-warning"> {{ $weekDays }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-danger">{{ $days - $weekDays }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-light">0</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-success">0</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-dark">0</span>
                                    </td>
                                    <td>
                                        @if (isset($employee->salaryFormula))
                                            <button class="btn btn-info btn-sm mx-auto mt-1 gen-slip-fin"
                                                data-id="{{ $employee->id }}"
                                                data-per_day="{{ $employee->salaryFormula->per_day }}"
                                                data-per_hour="{{ $employee->salaryFormula->per_hour }}"
                                                data-per_minute="{{ $employee->salaryFormula->per_minute }}"
                                                data-basic_salary="{{ $employee->salaryFormula->basic_salary }}"
                                                data-house_allowance="{{ $employee->salaryFormula->house_allowance }}"
                                                data-mess_allowance="{{ $employee->salaryFormula->mess_allowance }}"
                                                data-travelling_allowance="{{ $employee->salaryFormula->travelling_allowance }}"
                                                data-medical_allowance="{{ $employee->salaryFormula->medical_allowance }}"
                                                data-toggle="modal" data-target="#add_salary_formula2"
                                                title="Generate Employee Salary Slip"><i class="fa fa-print bx-tada"
                                                    aria-hidden="true"></i></button>
                                        @else
                                            <span class="badge badge-danger bx-flashing">Details Not Set
                                                First.</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <td colspan="9" class="text-center">No Employee(s) found.</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<x-submit-form-for-salary-print-component />
