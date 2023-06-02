<div>
   <!-- Add Salary Formula Modal -->
<div id="add_employee_bonus" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Employee Bonus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEmployeeBonus" method="POST"
                   action="{{ route('dashboard.employee-bonus.store') }}" novalidate>
                    @csrf
                    <div class="em-errors-print mb-2"></div>
                     <input type="hidden" name="assigned_by" id="" value="{{$user_id}}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Please select the employee from the list of employees you have added <span
                                        class="text-danger">*</span></label>
                                <select class="js-example-basic-single select2 form-control select" 
                                    name="employee_id" required>
                                    <option value="">Select employee</option>
                                    @forelse ($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->first_name . ' ' . $employee->last_name }}</option>
                                    @empty
                                        <option value="">No employee eligible for account is found.</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">  
                            <div class="form-group">
                                <label>Bonus Name<span class="text-danger ">*</span></label>
                                <input id="name" class="block mt-4 w-full form-control" type="text" name="bonus_name" required
                                    autofocus placeholder="Bonus Name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bonus Month<span class="text-danger">*</span></label>
                                <input id="month" class="block mt-1 w-full form-control" type="month" name="month"
                                    required autofocus placeholder="Bonus Date">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bonus Amount <span class="text-danger">*</span></label>
                                <input id="amount" class="block mt-1 w-full form-control" type="number"
                                    name="amount" placeholder="Bonus Amount" required >
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bonus Description <span class="text-danger">*</span></label>
                                    <textarea class="block mt-1 w-full form-control" name="description" id="" cols="10" rows="5" placeholder="Enter client Description" required></textarea>
                            </div>
                        </div>
                       
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Add Employee Bonus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Employee Salary Modal -->
</div>