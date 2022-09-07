<div wire:ignore.self id="add_admin_account" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Finance Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name<span class="text-danger">*</span></label>
                                <input wire:model.lazy='account.name'
                                    class="form-control @error('account.name') is-invalid @enderror" type="text"
                                    placeholder="Enter Name">
                                @error('account.name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email Address<span class="text-danger">*</span></label>
                                <input wire:model.lazy='account.email'
                                    class="form-control @error('account.email') is-invalid @enderror" type="email"
                                    placeholder="Enter Email Address">
                                @error('account.email')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password<span class="text-danger">*</span></label>
                                <input wire:model.lazy='account.password'
                                    class="form-control @error('name') is-invalid @enderror" type="password"
                                    placeholder="Enter Password">
                                @error('account.password')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Select Role<span class="text-danger">*</span></label>
                                <select wire:model.lazy='account.role'
                                    class="form-control @error('account.role') is-invalid @enderror">
                                    <option value="">Select Role</option>
                                    <option value="ceo">CEO</option>
                                    <option value="finance-admin">Finance Admin</option>
                                    <option value="finance-dept">Finance Department</option>
                                </select>
                                @error('account.role')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="submit-section">
                                <button wire:click.prevent="store" wire:loading.attr="disabled" type="submit"
                                    class="btn btn-lg btn-primary submit-btn">
                                    <span wire:loading.remove wire:target="store">Create Now</span>
                                    <span class="d-none" wire:loading.class.remove="d-none" wire:target="store">Adding
                                        Please wait...
                                        <span class="spinner-border spinner-border-sm btn-spinner ml-2 mr-2"
                                            role="status" aria-hidden="true">
                                        </span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
