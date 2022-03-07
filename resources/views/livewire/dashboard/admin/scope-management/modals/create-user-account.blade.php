<div>
    {{-- The Master doesn't talk, he acts. --}}
    @push('extended-js')
        @include('vendors.select2')
    @endpush
    <!-- Add leave Type Modal -->
    <div wire:ignore.self id="add_admin_account" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Admin Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Admin Name<span class="text-danger">*</span></label>
                                    <input wire:model.lazy='name'
                                        class="form-control @error('name') is-invalid @enderror" type="text"
                                        placeholder="Enter Name">
                                    @error('name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Admin Email<span class="text-danger">*</span></label>
                                    <input wire:model.lazy='email'
                                        class="form-control @error('email') is-invalid @enderror" type="email"
                                        placeholder="Enter Email Address">
                                    @error('email')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password<span class="text-danger">*</span></label>
                                    <input wire:model.lazy='password'
                                        class="form-control @error('password') is-invalid @enderror" type="password"
                                        placeholder="Enter Password">
                                    @error('password')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password<span class="text-danger">*</span></label>
                                    <input wire:model.lazy='password_confirmation'
                                        class="form-control @error('password') is-invalid @enderror" type="password"
                                        placeholder="Confirm Password">
                                    @error('password')
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
                                <span wire:loading.remove wire:target="store">Create Now</span>
                                <span class="d-none" wire:loading.class.remove="d-none"
                                    wire:target="store">Creating Account...
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
