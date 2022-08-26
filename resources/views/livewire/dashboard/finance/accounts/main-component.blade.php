@include('vendors.toastr')
<div>
    <x-bread-crumb-component :modal=true modalType="Admin Account" modalId="add_admin_account" />
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <p>Finance Related Accounts</p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ceoAssign">
                Assign CEOs
            </button>
        </div>
        <div class="card-body">
            <livewire:finance-accounts-table />
        </div>
    </div>
    <livewire:dashboard.finance.accounts.modals.create-new-account />

    <div wire:ignore.self class="modal fade" id="ceoAssign" tabindex="-1" role="dialog" aria-labelledby="ceoAssignLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ceoAssignLabel">Assign CEOs</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form wire:submit.prevent='assign'>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <select wire:model.lazy='ceoId'
                                    class="form-control @error('ceoId') is-invalid @enderror">
                                    <option value="">Select CEO</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->name }} ( {{ $user->email }} )
                                        </option>
                                    @endforeach
                                </select>
                                @error('ceoId')
                                    <span class="text-danger">{{ $message }} </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <select wire:model.lazy='companyId'
                                    class="form-control @error('companyId') is-invalid @enderror">
                                    <option value="">Select Company</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                @error('companyId')
                                    <span class="text-danger">{{ $message }} </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
