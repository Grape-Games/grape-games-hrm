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
                            <th>Employee Name</th>
                            <th>Designation</th>
                            <th>Late Minutes</th>
                            <th>Absents<br>( Saturdays and <br>Sundays excluded)</th>
                            <th>Presents</th>
                            <th>Half Days</th>
                            <th>Holidays</th>
                            <th>Leaves Approved</th>
                            @if (isset($employee->salaryFormula))
                                <th>Basic Salary</th>
                                <th>Per Day Salary</th>
                                <th>House Allowance</th>
                                <th>Mess Allowance</th>
                                <th>Travelling Allowance</th>
                                <th>Medical Allowance</th>
                            @endif
                            <th>Late Minutes Deductions</th>
                            @if (isset($employee->salaryFormula))
                                <th>Calculated Salary after Deductions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data2 as $data)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    @isset($data->first()[0]->employee)
                                        {{ $data->first()[0]->employee->first_name . ' ' . $data->first()[0]->employee->last_name }}
                                    @else
                                        Not Set
                                    @endisset
                                </td>
                                <td>
                                    @isset($data->first()[0]->employee)
                                        {{ $data->first()[0]->employee->designation->name }}
                                    @else
                                        Not Set
                                    @endisset
                                </td>
                                <td>
                                    {{ $data->lateMinutes }}
                                </td>
                                <td>
                                    @php
                                        $absents = count($dates) - count($data) - $satSuns['saturdays'] - $satSuns['sundays'];
                                    @endphp
                                    {{ $absents }}
                                </td>
                                <td>
                                    {{ count($data) }}
                                </td>
                                <td>
                                    {{ count($data->hd) }}
                                </td>
                                <td>
                                    {{ $data->holidays }}
                                </td>
                                <td>
                                    {{ $data->leaves_approved }}
                                </td>
                                @if (isset($employee->salaryFormula))
                                    <td>
                                        {{ $data->first()[0]->employee->salaryFormula->basic_salary . ' -/Rs' }}
                                    </td>
                                    <td>
                                        {{ $data->first()[0]->employee->salaryFormula->per_day . ' -/Rs' }}
                                    </td>
                                    <td>
                                        {{ $data->first()[0]->employee->salaryFormula->house_allowance . ' -/Rs' }}
                                    </td>
                                    <td>
                                        {{ $data->first()[0]->employee->salaryFormula->mess_allowance . ' -/Rs' }}
                                    </td>
                                    <td>
                                        {{ $data->first()[0]->employee->salaryFormula->travelling_allowance . ' -/Rs' }}
                                    </td>
                                    <td>
                                        {{ $data->first()[0]->employee->salaryFormula->medical_allowance . ' -/Rs' }}
                                    </td>
                                @endif
                                <td>
                                    @if ($data->first()[0]->employee->company->late_minutes_deduction)
                                        <span class="text-white badge bg-danger">Active</span>
                                    @else
                                        <span class="text-white badge bg-success">Not Active</span>
                                    @endif
                                </td>
                                @if (isset($employee->salaryFormula))
                                    <td>
                                        @php
                                            $calculatedSalary = $data->first()[0]->employee->salaryFormula->per_day * (count($data) + $satSuns['saturdays'] + $satSuns['sundays'] + $data->holidays) + $data->first()[0]->employee->salaryFormula->travelling_allowance + $data->first()[0]->employee->salaryFormula->mess_allowance + $data->first()[0]->employee->salaryFormula->house_allowance - count($data->hd) * ($data->first()[0]->employee->salaryFormula->per_day / 2);
                                        @endphp
                                        @if ($data->first()[0]->employee->company->late_minutes_deduction)
                                            @php
                                                $calculatedSalary -= $data->lateMinutes * $data->first()[0]->employee->salaryFormula->per_minute;
                                            @endphp
                                        @endif
                                        {{ $calculatedSalary . ' -/Rs' }}
                                    </td>
                                @endif
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
