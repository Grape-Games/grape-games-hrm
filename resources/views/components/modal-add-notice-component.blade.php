<div id="add_notice" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Notice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addNoticeForm" action="{{ route('dashboard.notice-board.store') }}" method="POST"
                    novalidate>
                    @csrf
                    <div class="nb-errors-print mb-2"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Notice Details <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="8" placeholder="Some details..." name="details"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="">Status</label>
                            <div class="d-flex">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="priority" value="low"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label text-success" for="flexRadioDefault2">
                                        <i class="fa fa-check" aria-hidden="true"></i> Low
                                    </label>
                                </div>
                                <div class="form-check ml-4">
                                    <input class="form-check-input" type="radio" name="priority" value="medium"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label text-warning" for="flexRadioDefault1">
                                        <i class="fa fa-close" aria-hidden="true"></i> Medium
                                    </label>
                                </div>
                                <div class="form-check ml-4">
                                    <input class="form-check-input" type="radio" name="priority" value="high"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label text-danger" for="flexRadioDefault1">
                                        <i class="fa fa-close" aria-hidden="true"></i> High
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Add Notice</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
