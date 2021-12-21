{{-- <div class="row mb-2">
        <div class="col-auto float-right ml-auto mb-2">
            <div class="btn-group btn-group-sm">
                <button class="btn btn-white">CSV</button>
                <button class="btn btn-white">PDF</button>
                <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
            </div>
    </div>
</div> --}}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="payslip-title"></h4>
                <div class="row">
                    <div class="col-sm-6 m-b-20">
                        <img src="{{ asset('assets/img/logo2.png') }}" class="inv-logo" alt="">
                        <ul class="list-unstyled mb-0">
                            <li>{{ $salaryDetails->employee->department->name }}</li>
                            <li>{{ isset($salaryDetails->employee->additional->address) ? $salaryDetails->employee->additional->address : '' }}
                            </li>
                            <li>{{ $salaryDetails->employee->city }}</li>
                        </ul>
                    </div>
                    <div class="col-sm-6 m-b-20">
                        <div class="invoice-details">
                            <h3 class="text-uppercase">Payslip #{{ request()->route('id') }}</h3>
                            <ul class="list-unstyled">
                                <li>Salary Month : <span>{{ $salaryDetails->dated->format('M Y') }}</span>
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
                                @if(isset($salaryDetails->employee->additional->join_date))
                                 {{$salaryDetails->employee->additional->join_date}}
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <h4 class="m-b-10"><strong>Earnings</strong></h4>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td><strong>Basic Salary</strong> <span class="float-right">Rs:
                                                {{ $salaryDetails->basic_salary }}</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>House Rent Allowance (H.R.A.)</strong> <span
                                                class="float-right">Rs:
                                                {{ $salaryDetails->house_allowance }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Mess Allowance</strong> <span class="float-right">Rs:
                                                {{ $salaryDetails->mess_allowance }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Travelling Allowance</strong> <span class="float-right">Rs:
                                                {{ $salaryDetails->travelling_allowance }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Medical Allowance</strong> <span class="float-right">Rs:
                                                {{ $salaryDetails->medical_allowance }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Eid Allowance</strong> <span class="float-right">Rs:
                                                {{ $salaryDetails->eid_allowance }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Other Allowance</strong> <span class="float-right">Rs:
                                                {{ $salaryDetails->other_allowance }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Earnings</strong> <span class="float-right"><strong
                                                    class="earning-result"></strong></span></td>
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
                                        <td><strong>Tax Deducted at Source (T.D.S.)</strong> <span
                                                class="float-right">0</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Adavance Salary</strong> <span class="float-right deduct">
                                                Rs: {{ $salaryDetails->advance_salary }}
                                            </span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Electricity</strong> <span class="float-right deduct">
                                                Rs: {{ $salaryDetails->electricity }}
                                            </span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Arrears</strong> <span class="float-right deduct">
                                                Rs: {{ $salaryDetails->arrears }}
                                            </span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Income Tax</strong> <span class="float-right deduct">
                                                Rs: {{ $salaryDetails->income_tax }}
                                            </span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Total Deductions</strong> <span class="float-right"><strong
                                                    class="deduction-result"></strong></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <p><strong class="total-result"></strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
