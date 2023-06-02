<div>
   <!-- Add Salary Formula Modal -->
<div id="add_new_increment" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Increment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addNewIncrement" method="POST"
                   action="{{ route('dashboard.increment.store') }}" novalidate>
                    @csrf
                    <div class="em-errors-print mb-2"></div>
                     <input type="hidden" name="assigned_by" id="" value="{{$user_id}}"> 
                    <div class="row">
                        <div class="col-md-5">
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
                        <div class="col-md-3">  
                            <div class="form-group">
                                <label>Last Increment<span class="text-danger ">*</span></label>
                                <input id="last_increment" class="block mt-3 w-full form-control" type="number" name="last_increment" value="0.00" readonly>
                                <input type="hidden" name="basic_salry" id="basic_salry">
                            </div>
                        </div>
                        <div class="col-md-4">  
                            <div class="form-group">
                                <label>Last Increment Month<span class="text-danger ">*</span></label>
                                <input id="last_increment_Month" class="block mt-3 w-full form-control" type="text"  value="" readonly placeholder="MM | YY">
                               
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Percentage</label>
                                <input type="number" class="form-control" name="percentage" placeholder="Percentage">
                            </div>
                        </div>
                        <div class="col-md-4">  
                            <div class="form-group">
                                <label>New Increment Amount<span class="text-danger ">*</span></label>
                                <input id="name" class="block w-full form-control" type="number" name="amount" required
                                    autofocus placeholder="increment amount"> 
                            </div>
                        </div>
                        
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Increment Month<span class="text-danger">*</span></label>
                                <input id="increment_date" class="block mt-1 w-full form-control" type="month" name="month"
                                    required autofocus placeholder="Bonus Date">
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Increment Purpose <span class="text-danger">*</span></label>
                                    <textarea class="block mt-1 w-full form-control" name="purpose" id="purpose" cols="10" rows="5"  required></textarea>
                            </div>
                        </div>
                       
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Add New Increment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Employee Salary Modal -->   
</div>