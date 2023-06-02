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
                                <td>Company</td>
                                <td>Total Month Days</td>
                                <td>Holidays</td>
                                <td>Paid</td>
                                <td>Unpaid</td>
                                <td>Calculated Salary</td>
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
                                        {{ $employee->company->name }}
                                    </td>
                                    <td>
                                        <span
                                            class="badge badge-warning">{{ isset($salArr[$employee->id]) ? $salArr[$employee->id]->total_days : 'NOT SET' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge badge-info">{{ isset($salArr[$employee->id]) ? $salArr[$employee->id]->holidays : 'NOT SET' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge badge-success">{{ isset($salArr[$employee->id]) ? $salArr[$employee->id]->salary_days : 'NOT SET' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge badge-danger">{{ isset($salArr[$employee->id])? $salArr[$employee->id]->absent_days -$salArr[$employee->id]->saturdays_included -$salArr[$employee->id]->sundays_included: 'NOT SET' }}
                                        </span>
                                    </td>
                                    <td>
                                        <p>
                                            Rs :
                                            <strong>
                                                {{ isset($salArr[$employee->id]) ? $salArr[$employee->id]->calculated_salary . '/-' : 'NOT AVAILABLE YET' }}
                                            </strong>
                                        </p>
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
                                            <span class="badge badge-danger bx-flashing">
                                                <a class="text-white"
                                                    href="{{ route('dashboard.employee-salaries.index') }}">Details
                                                    Not Set
                                                </a>
                                            </span>
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

@push('extended-js')

    <script>
        document.title = "Salary Slips Report of all companies"
    </script>

@endpush

<x-submit-form-for-salary-print-component />
