<!-- Add leave Type Modal -->
<div id="add_leave" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Leave Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEmployeeLeave" action="{{ route('dashboard.leaves.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="el-errors-print mb-2"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Leave Type <span class="text-danger">*</span></label>
                                <select name="leave_type_id" class="form-control">
                                    <option value="">Select Leave Type</option>
                                    @forelse ($leave_types as $leaveType)
                                        <option value="{{ $leaveType->id }}"
                                            data-allowed="{{ $leaveType->allowed }}">
                                            {{ $leaveType->name }}</option>
                                    @empty
                                        <option value="">No leave type available.</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter Number of days <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="No.of Days">
                                <small class="text-muted pull-right">Allowed <p class="text-primary allowed-val">NULL</p>
                                    </small>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Add Leave Type</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Leave Type Modal -->
