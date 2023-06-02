@push('extended-css')
    @include('vendors.toastr')
@endpush
<div>
    <x-bread-crumb-component :modal=false showClock=false />
    <div class="card">
        {{-- The Master doesn't talk, he acts. --}}
        <div class="card-header">Enter Tracking ID</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <label for="">Tracking ID</label>
                    <input wire:model.lazy='trackId' class="form-control @error('trackId') is-invalid @enderror"
                        type="text" placeholder="1">
                    @error('trackId')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-12 mt-2">
                    <button href="#" wire:click="check" class="btn btn-success btn-block" style="width: 20%;"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="check">
                            Track Now
                        </span>
                        <span wire:loading wire:target="check">
                            Please wait...
                            <div class="spinner-border text-light spinner-border-sm" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
