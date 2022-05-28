<div>
    {{-- The Master doesn't talk, he acts. --}}
    <!-- Add Working Day Modal -->
    <div wire:ignore.self id="add_working_day" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Working Day Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date<span class="text-danger">*</span></label>
                                    <input wire:model.lazy='date'
                                        class="form-control @error('date') is-invalid @enderror" type="date">
                                    @error('date')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Reason<span class="text-danger">*</span></label>
                                    <textarea wire:model.lazy='reason' rows="4" class="form-control @error('reason') is-invalid @enderror" type="text"
                                        placeholder="Enter reason"></textarea>
                                    @error('reason')
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
                                <span wire:loading.remove wire:target="store">Update/Create</span>
                                <span class="d-none" wire:loading.class.remove="d-none"
                                    wire:target="store">Please wait...
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
</div>
