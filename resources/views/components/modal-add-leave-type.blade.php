<!-- Add leave Type Modal -->
<div id="add_leave_type" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Leave Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addLeaveTypeForm" action="{{ route('dashboard.leave-types.store') }}" method="POST"
                    novalidate>
                    @csrf
                    <div class="pd-errors-print mb-2"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Leave Type <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Leave Type Name" name="name"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Leaves allowed <span class="text-danger">*</span></label>
                                <input class="form-control" type="number" placeholder="Number of leaves allowed" name="allowed"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Status</label>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="active"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        <i class="fa fa-check" aria-hidden="true"></i> Active
                                    </label>
                                </div>
                                <div class="form-check ml-4">
                                    <input class="form-check-input" type="radio" name="status" value="held"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        <i class="fa fa-close" aria-hidden="true"></i> Held
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="">Payment Status</label>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="paid" id="isPaid" value="true"
                                        checked>
                                    Is paid ?
                                </label>
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
