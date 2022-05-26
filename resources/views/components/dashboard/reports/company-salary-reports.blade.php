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
                                Month of {{ date('M Y', strtotime($dates[0])) }} has
                                <br>
                                {{ $satSuns['saturdays'] . ' Saturdays and ' . $satSuns['sundays'] . ' Sundays' }}
                                <br>
                                <span class="text-white badge bg-success">Note : Saturdays and Sundays are paid</span>
                            </th>
                        </tr>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>CNIC</th>
                            <th>Designation</th>
                            <th>Bank Acc#</th>
                            <th>Per Day</th>
                            <th>Per Hour</th>
                            <th>Per Minute</th>
                            <th>Basic Salary</th>
                            <th>House Allowance</th>
                            <th>Mess/Food Allowance</th>
                            <th>Travelling Allowance</th>
                            <th>Medical Allowance</th>
                            <th>Eid Allowance</th>
                            <th>Other Allowances</th>
                            <th>Gross Salary</th>
                            <th>Salaried Days</th>
                            <th>Leaves Approved</th>
                            <th>No of Days ( Deduction )</th>
                            <th>Days Amount Deducted</th>
                            <th>No of Minutes</th>
                            <th>Minutes Amount Deducted</th>
                            <th>Deduction Compensated</th>
                            <th>Taxable Salary</th>
                            <th>Advance Salary</th>
                            <th>Loan / Installment</th>
                            <th>Electricity</th>
                            <th>Income Tax</th>
                            <th>Net Salary</th>
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
                                    {{ $employee['employee']->cnic }}
                                </td>
                                <td>
                                    {{ $employee['employee']->designation->name ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['employee']->bank->account_number ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['tempered'] ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['employee']->salaryFormula->per_hour ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['employee']->salaryFormula->per_minute ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['employee']->salaryFormula->basic_salary ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['employee']->salaryFormula->house_allowance ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['employee']->salaryFormula->mess_allowance ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['employee']->salaryFormula->travelling_allowance ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['employee']->salaryFormula->medical_allowance ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['additional']->eid_allowance ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['additional']->other_allowance ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['employee']->salaryFormula->basic_salary ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['salaried_days'] }}
                                    <span class="badge badge-success">Sat/Suns {{$employee['sat_suns']}}</span>
                                </td>
                                <td>
                                    {{ $employee['approved_leaves'] }}
                                </td>
                                <td>
                                    {{ $employee['absents']}}
                                </td>
                                <td>
                                    {{ $employee['deductions'] }}
                                </td>
                                <td>
                                    SOON
                                </td>
                                <td>
                                    SOON
                                </td>
                                <td>
                                    SOON
                                </td>
                                <td>
                                    {{ $employee['employee']->salaryFormula->basic_salary ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['additional']->advance_salary ?? 'Not Set' }}
                                </td>
                                <td>
                                    NULL
                                </td>
                                <td>
                                    {{ $employee['additional']->electricity ?? 'Not Set' }}
                                </td>
                                <td>
                                    {{ $employee['additional']->income_tax ?? 'Not Set' }}
                                </td>
                                <td>
                                    @isset($employee['employee']->salaryFormula)
                                        {{ $employee['employee']->salaryFormula->basic_salary - $employee['deductions'] }}
                                    @else
                                        Not Set
                                    @endisset
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
            makeDTnAjax("table");
        });
    </script>
@endpush
