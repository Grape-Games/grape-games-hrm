<!-- Add Designation Modal -->
<div id="add_designation" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Designation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addDesignationForm" action="{{ route('dashboard.designations.store') }}" method="POST"
                    novalidate>
                    @csrf
                    <div class="designation-errors-print mb-2"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Designation Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Designation Name" name="name"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Parent Designation <span class="text-danger">*</span></label>
                                <select class="form-control" name="parent_designation_id" required>
                                    @forelse ($parent_designations as $parent_designation)
                                        <option value="{{ $parent_designation->id }}">
                                            {{ $parent_designation->name }}
                                        </option>
                                    @empty
                                        <option value="">No parent designation found.</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Minimum Salary <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="min_salary" placeholder="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Maximum Salary <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" name="max_salary" placeholder="10000"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Designation Status</label>
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
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Add Designation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Designation Modal -->
