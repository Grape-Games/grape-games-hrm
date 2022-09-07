<div class="row mb-2">
    <div class="col-auto float-right ml-auto mb-2">
        <div class="btn-group btn-group-sm">
            <button class="btn btn-white print-btn" onclick="download()"><i class="fa fa-file-pdf-o"
                    aria-hidden="true"></i>
                PDF</button>
            <button class="btn btn-primary account-btn loader-btn d-none" disabled="disabled">
                <i class="fa fa-spinner fa-spin" style="margin-right:2%;"></i>
                Downloading...
            </button>
        </div>
    </div>
</div>
 
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body html-content">   
                <h4 class="payslip-title"></h4>
                <div class="row">
                    <div class="col-sm-6 m-b-20">
                        <img src="{{ asset($salaryDetails->employee->company->getFirstMediaUrl('companies')) }}"
                            class="inv-logo" alt="">
                        <ul class="list-unstyled mb-0"> 
                            <li>{{ $salaryDetails->employee->company->name }}</li>
                            <li>{{ isset($salaryDetails->employee->additional->address) ? $salaryDetails->employee->additional->address : '' }}
                            </li>
                            <li>{{ $salaryDetails->employee->city }}</li> 
                        </ul>
                    </div>
                    <div class="col-sm-6 m-b-20">
                        <div class="invoice-details">
                            <h3 class="text-uppercase">Payslip #{{ request()->route('id') }}</h3>
                            <ul class="list-unstyled">
                                <li>Salary Month : <span>{{ $salaryDetails->month_year }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 m-b-20">
                        <ul class="list-unstyled">
                            <li>
                                <h5 class="mb-0">
                                    <strong>{{ $salaryDetails->employee->first_name . ' ' . $salaryDetails->employee->last_name }}</strong>
                                </h5>
                            </li>
                            <li><span>{{ $salaryDetails->employee->designation->name }}</span></li>
                            <li>Registration # : {{ $salaryDetails->employee->registration_no }} </li>
                            <li>
                                @if (isset($salaryDetails->employee->additional->join_date))
                                    Join Date :
                                    {{ $salaryDetails->employee->additional->join_date->format('l F j, Y') }}
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <h4 class="m-b-10"><strong class="ml-2">Earnings</strong></h4>
                            <table class="table table-bordered pay-slip-table">
                                <tbody>
                                    <tr>
                                        <td><strong>Basic Salary</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right">
                                                {{ isset($salaryDetails->basic_salary) ? $salaryDetails->basic_salary : 0 }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Increment</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right">
                                                {{ isset($salaryDetails->totalIncrement) ? $salaryDetails->totalIncrement : 0 }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>House Rent Allowance (H.R.A.)</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right earned">
                                                {{ isset($salaryDetails->house_allowance) ? $salaryDetails->house_allowance : 0 }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Mess Allowance</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right earned">
                                                {{ isset($salaryDetails->mess_allowance) ? $salaryDetails->mess_allowance : 0 }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Travelling Allowance</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right earned">
                                                {{ isset($salaryDetails->travelling_allowance) ? $salaryDetails->travelling_allowance : 0 }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Medical Allowance</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right earned">
                                                {{ isset($salaryDetails->medical_allowance) ? $salaryDetails->medical_allowance : 0 }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Eid Allowance</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right earned">
                                                {{ isset($salaryDetails->eid_allowance) ? $salaryDetails->eid_allowance : 0 }}</span>
                                        </td>
                                    </tr>  
                                    <tr>
                                        <td><strong>Other Allowance</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right earned">
                                                {{ isset($salaryDetails->other_allowance) ? $salaryDetails->other_allowance : 0 }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Bouns</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right earned">
                                                {{ isset($salaryDetails->bouns) ? $salaryDetails->bouns : 0 }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Deduction Compensated</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right earned">
                                                {{ isset($salaryDetails->compensation) ? $salaryDetails->compensation : 0 }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Calculated Salary</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right earned">
                                                {{ isset($salaryDetails->total_salary) ? $salaryDetails->total_salary : 0 }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Earnings</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right">
                                                <strong >{{$salaryDetails->total_salary + $salaryDetails->compensation}}</strong>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <h4 class="m-b-10"><strong>Deductions</strong></h4>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><strong>Tax Deducted at Source (T.D.S.)</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right deduct"> {{ isset($salaryDetails->tax_deduction) ? $salaryDetails->tax_deduction : 0 }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Loan</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right deduct">
                                                {{ isset($salaryDetails->loan) ? $salaryDetails->loan : 0 }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Absents Deduction</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right deduct">
                                                {{ isset($salaryDetails->absent_deduction) ? $salaryDetails->absent_deduction : 0 }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Half Days Deductions</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right deduct">
                                                {{ isset($salaryDetails->half_day_deduction) ? $salaryDetails->half_day_deduction : 0 }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Late Minutes Deductions</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right deduct">
                                                {{ isset($salaryDetails->late_minutes_deduction) ? $salaryDetails->late_minutes_deduction : 0 }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Sand wich Rule Deductions</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right deduct">
                                                {{ isset($salaryDetails->   sandwich_rule_deduction) ? $salaryDetails-> sandwich_rule_deduction : 0 }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Other Deduction</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right deduct">
                                                {{ isset($salaryDetails->   other_deduction) ? $salaryDetails-> other_deduction : 0 }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Deductions without Loan</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right">
                                                <strong class="">
                                                    {{ isset($salaryDetails->   deduction_before_compensation) ? $salaryDetails->   deduction_before_compensation : 0 }}
                                                </strong> 
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Deductions with Loan</strong>
                                            <span class="float-right">&nbsp;Rs</span>
                                            <span class="float-right">
                                                <strong class="">
                                                    {{ $salaryDetails-> deduction_before_compensation +$salaryDetails->loan}}
                                                </strong> 
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <p>
                            <strong class="net-total bx-flashing">Net total:  {{ isset($salaryDetails-> approved_salary) ? $salaryDetails-> approved_salary : 0 }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
