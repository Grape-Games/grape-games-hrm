<!-- Add leave Type Modal -->
<div id="commentsModal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Leave Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCommentForm" action="{{ route('dashboard.leaves.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="elc-errors-print mb-2"></div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Add remarks <span class="text-danger">*</span></label>
                            <textarea class="form-control" type="remarks" placeholder="Some remarks..." name="remarks"
                                required></textarea>
                        </div>
                        <input type="hidden" name="leave_id">
                        <input type="hidden" name="status">
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Add Comments</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Leave Type Modal -->
