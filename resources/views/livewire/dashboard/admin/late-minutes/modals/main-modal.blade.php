<div wire:ignore.self id="lateMinutesModal" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Late Minutes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="pd-errors-print mb-2"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Minutes<span class="text-danger">*</span></label>
                                <input wire:model.lazy='minutes' class="form-control" type="number"
                                    placeholder="Leave Type Name" name="name" required>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button wire:click.prevent="update" wire:loading.attr="disabled" type="submit"
                            class="btn btn-lg btn-primary submit-btn">
                            <span wire:loading.remove wire:target="update">Update Now</span>
                            <span class="d-none" wire:loading.class.remove="d-none"
                                wire:target="update">Updating...
                                <span class="spinner-border spinner-border-sm btn-spinner ml-2 mr-2" role="status"
                                    aria-hidden="true">
                                </span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Leave Type Modal -->
