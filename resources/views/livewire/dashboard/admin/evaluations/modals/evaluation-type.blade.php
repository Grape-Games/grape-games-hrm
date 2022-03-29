<div>
    <div wire:ignore.self id="add_evaluation_type" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Evaluation Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name<span class="text-danger">*</span></label>
                                    <input wire:model.lazy='name'
                                        class="form-control @error('name') is-invalid @enderror"
                                        type="text" placeholder="Enter Name">
                                    @error('name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button wire:click.prevent="store" wire:loading.attr="disabled" type="submit"
                                class="btn btn-lg btn-primary submit-btn">
                                <span wire:loading.remove wire:target="store">Add Now</span>
                                <span class="d-none" wire:loading.class.remove="d-none"
                                    wire:target="store">Adding Please wait...
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
</div>
