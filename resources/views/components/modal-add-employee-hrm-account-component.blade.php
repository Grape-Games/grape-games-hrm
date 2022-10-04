<!-- Add Salary Formula Modal -->
<div id="add_employee_hrm_account" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Employee Account at HRM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEmployeeHRMAccount" method="POST"
                    action="{{ route('dashboard.employee-web-accounts.store') }}" novalidate>
                    @csrf
                    <div class="em-errors-print mb-2"></div>
                    <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label>Please select the employee from the list of employees you have added <span
                                        class="text-danger">*</span></label>
                                <select  class="js-example-basic-single select2 form-control select" id="employee_id"
                                    name="employee_id" required>
                                    <option value="">Select employee</option>
                                    @forelse ($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->first_name . ' ' .   $employee->last_name }}</option>
                                    @empty
                                        <option value="">No employee eligible for account is found.</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Full Name<span class="text-danger">*</span></label>
                                <input id="name" class="block mt-1 w-full form-control" type="text" name="name" required
                                    autofocus placeholder="Employee Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Primary Email<span class="text-danger">*</span></label>
                                <input id="email" class="block mt-1 w-full form-control" type="email" name="email"
                                    required autofocus placeholder="Primary Email Address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Secondary Email<span class="text-danger">*</span></label>
                                <input id="secondary_email" class="block mt-1 w-full form-control" type="email" name="secondary_email"
                                    required autofocus placeholder="Secondary Email Address">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password <span class="text-danger">*</span></label>
                                <input id="password" class="block mt-1 w-full form-control" type="password"
                                    name="password" placeholder="Password" required autocomplete="current-password"
                                    data-rule-password="true" data-msg="Please enter password to proceed.">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Confirm Password <span class="text-danger">*</span></label>
                                <input id="password_confirmation" class="block mt-1 w-full form-control" type="password"
                                    name="password_confirmation" placeholder="Confirm Password" required
                                    autocomplete="password_confirmation" data-msg="Password must match."
                                    data-rule-password="true" data-rule-equalTo="#password">
                            </div>
                        </div>
                       
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Please Select Type</label>
                                <select name="role" class="form-control">
                                    <option value="employee">Employee</option>
                                    <option value="team_lead">Team Lead</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Add Employee Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('extended-js')
<script>
    $("body").on("change", "#employee_id", function () {
        $.ajax({
        url: "/dashboard/employee-company/"+$(this).val(),
        type: "get",
        success: function(response) {
            console.log("success", response);
            $("[name=name]").val(response.data.first_name+' '+response.data.last_name);
            $("[name=email]").val(response.data.email_address);
            var secondryEmail = response.data.email_address.split('@')[0]+"@"+response.data.company.name.split(' ')[0]+".com";
            $("[name=secondary_email]").val(secondryEmail);
            $("[type=password]").val('');
            makeToastr('success', response.status,
                'Successful');

        },
      });
});
</script>
@endpush

<!-- Add Employee Salary Modal -->  
