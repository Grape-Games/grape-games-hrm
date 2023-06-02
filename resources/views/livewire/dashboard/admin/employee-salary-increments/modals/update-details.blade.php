<div wire:ignore.self id="update_increment_details" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Increment of {{ $employeeName }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    @csrf
                    <div class="pd-errors-print mb-2"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Next Increment Date<span class="text-danger">*</span></label>
                                <input wire:model.lazy="next_increment"
                                    class="form-control @error('next_increment') is-invalid @enderror" type="date">
                                @error('next_increment')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Next Increment Amount<span class="text-danger">*</span></label>
                                <input wire:model.lazy="increment_amount"
                                    class="form-control @error('increment_amount') is-invalid @enderror" type="number"
                                    placeholder="Enter amount">
                                @error('increment_amount')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Increment Frequency<span class="text-danger">*</span></label>
                                <input wire:model.lazy="time_period"
                                    class="form-control @error('time_period') is-invalid @enderror" type="number"
                                    placeholder="Enter time period">
                                @error('time_period')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
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
