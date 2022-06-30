<!-- Add Salary Formula Modal -->
<div id="add_salary_formula" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Set Salary of Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addMonthlySalaryForm" action="{{ route('dashboard.employee-salaries.store') }}"
                    method="POST" novalidate>
                    @csrf
                    <div class="esf-errors-print mb-2"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Basic Salary<span class="text-danger">*</span></label>
                                <input class="form-control" type="number" placeholder="Basic Salary"
                                    name="basic_salary" required>
                            </div>
                        </div>
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
                                <label>House Allowance</label>
                                <input class="form-control" type="number" placeholder="House Allowance"
                                    name="house_allowance">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Mess Allowance</label>
                                <input class="form-control" type="number" placeholder="Mess Allowance"
                                    name="mess_allowance">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Travelling Allowance</label>
                                <input class="form-control" type="number" placeholder="Travelling Allowance"
                                    name="travelling_allowance">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Medical Allowance</label>
                                <input class="form-control" type="number" placeholder="Medical Allowance"
                                    name="medical_allowance">
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label>Eid Allowance</label>
                                <input class="form-control" type="number" placeholder="Eid Allowance"
                                    name="eid_allowance">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Other Allowances</label>
                                <input class="form-control" type="number" placeholder="Other Allowance"
                                    name="other_allowance">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Advance Salary</label>
                                <input class="form-control" type="number" placeholder="Advance Salary"
                                    name="advance_salary">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Electricity</label>
                                <input class="form-control" type="number" placeholder="Electricity"
                                    name="electricity">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Arrears</label>
                                <input class="form-control" type="number" placeholder="Arrears" name="arrears">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Income Tax</label>
                                <input class="form-control" type="number" placeholder="Income Tax" name="income_tax">
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Dated</label>
                                <input class="form-control" type="text" placeholder="Month" name="dated" readonly>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="employee_id">
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Set Salary Slip</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Employee Salary Modal -->
@push('extended-js')
    <script>
        $("[name=basic_salary]").keyup(function(e) {
            let per_day = Math.floor($(this).val() / 30);
            let per_hour = Math.floor(per_day / 8);
            let per_minute = Math.floor(per_hour / 60);
            $("[name=per_day]").val(per_day)
            $("[name=per_hour]").val(per_hour)
            $("[name=per_minute]").val(per_minute)
        });
    </script>
@endpush
