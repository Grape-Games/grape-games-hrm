<!-- Add Parent Designation Modal -->
<div id="add_parent_designation" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Parent Designation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addParentDesignationForm" action="{{ route('dashboard.parent-designations.store') }}"
                    method="POST" novalidate>
                    @csrf
                    <div class="pd-errors-print mb-2"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Parent Designation Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" placeholder="Parent Designation Name"
                                    name="name" required>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Add Parent Designation</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Parent Designation Modal -->
