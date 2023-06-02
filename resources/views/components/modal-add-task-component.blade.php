

<div>       
   <!-- Add Salary Formula Modal -->
        <div id="add_task" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form id="addNewTask" method="POST"
                        action="{{ route('dashboard.task.store') }}" novalidate>
                            @csrf
                            <div class="em-errors-print mb-2"></div>
                            <input type="hidden" name="assigned_by" id="" value="{{$user_id}}">
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Please select the Project from the list of Projects you have added <span
                                                class="text-danger">*</span></label>
                                        <select class="js-example-basic-single select2 form-control select" 
                                            name="project_id" required>
                                            <option value="">Select Project</option>
                                            @forelse ($projects as $project)
                                                <option value="{{ $project->id }}">
                                                    {{ $project->name }}</option>
                                            @empty
                                                <option value="">Project Not found.</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                              
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Please select the employee from the list of employees you have added <span
                                                class="text-danger">*</span></label>
                                        <select class="js-example-basic-single select2 form-control select" 
                                            name="assigned_to" required>
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
                                    <label for="">Start Date</label>
                                    <input type="date" name="start_date" id="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="">End Date</label>
                                    <input type="date" name="end_date" id="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="">Priority</label>
                                    <input type="text" name="priority" id="" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label for="">Details</label>
                                    <textarea id="editor" class="ckeditor form-control" name="details" required></textarea>
                                    </div>
                                </div> 
                            </div>
                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Add Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Employee Salary Modal -->
        </div>
</div>



  