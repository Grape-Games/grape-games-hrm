@push('extended-css')
    @include('vendors.toastr')
@endpush
<div>
    <x-bread-crumb-component :modal=false showClock=false />
    @can('is-employee')
        <div class="card">
            <div class="card-header">
                <h4>
                    Submit a material Request
                </h4>
            </div>
            <div class="card-body">
                <div class="row filter-row">
                    <div class="col-sm-4 mb-1">
                        <label class="focus-label">Name <span class="text-danger">*</span></label>
                        <input wire:model.lazy="material.name" type="text"
                            class="form-control @error('material.name') is-invalid @enderror" placeholder="Material Name">
                        @error('material.name')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-1">
                        <label class="focus-label">Select Type <span class="text-danger">*</span></label>
                        <select wire:model.lazy="material.type"
                            class="form-control @error('material.type') is-invalid @enderror">
                            <option>-</option>
                            <option value="other">Other</option>
                        </select>
                        @error('material.type')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-1">
                        <label class="focus-label">Quantity <span class="text-danger">*</span></label>
                        <input wire:model.lazy="material.qty" type="number"
                            class="form-control @error('material.qty') is-invalid @enderror"
                            placeholder="Material quantity">
                        @error('material.qty')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-sm-12 mb-4">
                        <label class="focus-label">Enter description <span class="text-danger">*</span></label>
                        <textarea wire:model.lazy="material.description" rows="5"
                            class="form-control @error('material.description') is-invalid @enderror"
                            placeholder="Enter details why you need this material ? "></textarea>
                        @error('material.description')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-sm-4 mb-1">
                        <button href="#" wire:click="store" class="btn btn-success btn-block"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="store">
                                Submit
                            </span>
                            <span wire:loading wire:target="store">
                                Submitting Please wait...
                                <div class="spinner-border text-light spinner-border-sm" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endcan
    <div class="card mt-2">
        <div class="card-header">
            <h4>
                Material Requests
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped custom-table table-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Quatity</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Update At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($requests as $request)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $request->name }}
                                </td>
                                <td>
                                    {{ $request->description }}
                                </td>
                                <td>
                                    {{ $request->qty }}
                                </td>
                                <td>
                                    {{ $request->type }}
                                </td>
                                <td>
                                    @if ($request->status == 'Pending')
                                        <span class="text-white badge bg-info">Pending</span>
                                    @elseif($request->status == 'Closed')
                                        <span class="text-white badge bg-warning">Closed</span>
                                    @elseif($request->status == 'rejected')
                                        <span class="text-white badge bg-danger">Rejected</span>
                                    @elseif($request->status == 'Approved')
                                        <span class="text-white badge bg-success">Approved</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $request->created_at->diffForHumans() }}
                                </td>
                                <td>
                                    {{ $request->updated_at->diffForHumans() }}
                                </td>
                                <td>
                                    <button class="btn btn-danger" wire:click="delete('{{ $request->id }}')">
                                        <i class="fas fa-trash bx-tada" data-toggle="tooltip" data-placement="top"
                                            title="Delete Request Submitted"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <td colspan="9" class="text-canter">
                                No records found.
                            </td>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $requests->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
