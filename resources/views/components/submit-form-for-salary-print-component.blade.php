<!-- Add Salary Formula Modal -->
<div id="add_salary_formula2" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Print Salary Slip of Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEmployeeSalarySlip" action="{{ route('dashboard.save-salary-slip') }}" method="POST"
                    novalidate>
                    @csrf
                    <div class="font-medium text-green-200 mb-2">
                        <h4>1. Some fields can only be set
                            <strong>
                                <a href="{{ route('dashboard.employee-salaries.index') }}" class="bx-tada">
                                    here 👈
                                </a>
                            </strong>
                        </h4>
                        <h4 class="text-danger">2. Note you should only set employee bonus or arrears for the
                            particular month here ! 😞
                        </h4>
                        <h4 class="text-success">3. Arrears/Bonuses are reset every month or if submitted again. 🌛
                        </h4>
                    </div>
                    <div class="ss-errors-print mb-2"></div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Per day</label>
                                <input class="form-control" type="number" placeholder="Per day" name="per_day"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Per hour</label>
                                <input class="form-control" type="number" placeholder="Per hour" name="per_hour"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Per Minute</label>
                                <input class="form-control" type="number" placeholder="Per minute" name="per_minute"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Basic Salary<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" placeholder="Basic Salary"
                                    name="basic_salary" required readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>House Allowance</label>
                                <input class="form-control" type="number" placeholder="House Allowance"
                                    name="house_allowance" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mess Allowance</label>
                                <input class="form-control" type="number" placeholder="Mess Allowance"
                                    name="mess_allowance" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Travelling Allowance</label>
                                <input class="form-control" type="number" placeholder="Travelling Allowance"
                                    name="travelling_allowance" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Medical Allowance</label>
                                <input class="form-control" type="number" placeholder="Medical Allowance"
                                    name="medical_allowance" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bx-flashing">Eid Allowance</label>
                                <input class="form-control" type="number" placeholder="Eid Allowance"
                                    name="eid_allowance">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bx-flashing">Other Allowances</label>
                                <input class="form-control" type="number" placeholder="Other Allowance"
                                    name="other_allowance">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bx-flashing">Advance Salary</label>
                                <input class="form-control" type="number" placeholder="Advance Salary"
                                    name="advance_salary">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bx-flashing">Electricity</label>
                                <input class="form-control" type="number" placeholder="Electricity"
                                    name="electricity">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bx-flashing">Arrears</label>
                                <input class="form-control" type="number" placeholder="Arrears" name="arrears">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="bx-flashing">Income Tax</label>
                                <input class="form-control" type="number" placeholder="Income Tax" name="income_tax">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Dated</label>
                                <input class="form-control" type="text" placeholder="Month" name="dated" readonly>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="employee_id">
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Print Salary Slip</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Employee Salary Modal -->
