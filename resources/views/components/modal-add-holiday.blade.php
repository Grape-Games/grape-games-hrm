<div id="add_holiday" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Holiday</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addHoldidayForm" action="{{ route('dashboard.holidays.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="errors-print mb-2"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Holiday Description<span class="text-danger">*</span></label>
                                <textarea cols="10" class="form-control" type="text" placeholder="Some Description"
                                    name="details" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Holiday Date<span class="text-danger">*</span></label>
                                <input class="form-control" type="date" placeholder="Date" name="date" required>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Add Holiday</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Leave Type Modal -->
