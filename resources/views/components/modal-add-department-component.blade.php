<!-- Add Department Modal -->
<div id="add_department" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addDepartmentForm" action="{{ route('dashboard.departments.store') }}" method="POST"
                    novalidate>
                    @csrf
                    <div class="department-errors-print mb-2"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Department Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Department Name" name="name"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Department Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="department_type_id" required>
                                    @forelse ($department_types as $department_type)
                                        <option value="{{ $department_type->id }}">
                                            {{ $department_type->name }}
                                        </option>
                                    @empty
                                        <option value="">No department type found.</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Branch Name <code>e.g Plaza 79 </code><span
                                        class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Branch Name" name="branch_name"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Time In <span class="text-danger">*</span></label>
                                <input class="form-control" type="time" name="time_in" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Time Out <span class="text-danger">*</span></label>
                                <input class="form-control" type="time" name="time_out" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Department Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="held"
                                    id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Held
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="active"
                                    id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Active
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Select an Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="validatedCustomFile" name="image">
                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Add Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Department Modal -->
