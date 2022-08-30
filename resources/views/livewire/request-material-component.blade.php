@push('extended-css')
    @include('vendors.toastr')
@endpush
<div>
    <x-bread-crumb-component :modal=false showClock=false />
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="update_comments" tabindex="-1" role="dialog"
        aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Comments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="">Your Remarks</label>
                    <input wire:model.lazy='comment' class="form-control @error('comment') is-invalid @enderror"
                        type="text" placeholder="Comments">
                    @error('comment')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button wire:click.prevent="saveRemarks" wire:loading.attr="disabled" type="submit"
                        class="btn btn-lg btn-primary submit-btn">
                        <span wire:loading.remove wire:target="saveRemarks">Save Remarks</span>
                        <span class="d-none" wire:loading.class.remove="d-none" wire:target="saveRemarks">
                            Please wait...
                            <span class="ml-2 mr-2 spinner-border spinner-border-sm btn-spinner" role="status"
                                aria-hidden="true">
                            </span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @can('is-employee')
        <div class="card">
            <div class="card-header">
                <h4>
                    Submit a material Request
                </h4>
            </div>
            <div class="card-body">
                <div class="row filter-row">
                    <div class="mb-1 col-sm-4">
                        <label class="focus-label">Name <span class="text-danger">*</span></label>
                        <input wire:model.lazy="material.name" type="text"
                            class="form-control @error('material.name') is-invalid @enderror" placeholder="Material Name">
                        @error('material.name')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-1 col-sm-4">
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
                    <div class="mb-1 col-sm-4">
                        <label class="focus-label">Quantity <span class="text-danger">*</span></label>
                        <input wire:model.lazy="material.qty" type="number"
                            class="form-control @error('material.qty') is-invalid @enderror"
                            placeholder="Material quantity">
                        @error('material.qty')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-4 col-sm-12">
                        <label class="focus-label">Enter description <span class="text-danger">*</span></label>
                        <textarea wire:model.lazy="material.description" rows="5"
                            class="form-control @error('material.description') is-invalid @enderror"
                            placeholder="Enter details why you need this material ? "></textarea>
                        @error('material.description')
                            <span class="text-danger"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-1 col-sm-4">
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
    <div class="mt-2 card">
        <div class="card-header">
            <h4>
                Material Requests
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0 table-striped custom-table table-nowrap">
                    <thead>
                        <tr>
                            @can('materialCheck')
                                <th>Tracking ID</th>
                            @endcan
                            <th>Requested By</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Qty</th>
                            @can('materialCheck')
                                <th>Update</th>
                            @endcan
                            <td>Status</td>
                            <th>Requested On</th>
                            <th>Updated On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($requests as $request)
                            <tr>
                                @can('materialCheck')
                                    <td>
                                        <a href="{{ route('dashboard.livewire.material.request.tracking', ['id' => $request->id]) }}"
                                            title="Click to track">
                                            {{ $request->id }}
                                        </a>
                                    </td>
                                @endcan
                                <td>
                                    {{ $request->employee->first_name . ' ' . $request->employee->last_name }}
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
                                @can('materialCheck')
                                    <td>
                                        @if (in_array(auth()->user()->role, ['admin', 'manager']) ||
                                            (auth()->user()->role == 'ceo' && $request->isApprovedByHr()) ||
                                            (auth()->user()->role == 'finance-admin' && $request->isApprovedByCeo()) ||
                                            (auth()->user()->role == 'finance-dept' && $request->isApprovedByAdmin()))
                                            <div class="dropdown action-label">
                                                <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                                    data-toggle="dropdown" aria-expanded="true">
                                                    <i class="fa fa-dot-circle-o text-success"></i> Update Status
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                                                    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-14px, 31px, 0px);">
                                                    <a class="dropdown-item" href="#"
                                                        wire:click="setStatus('{{ $request->id }}','Pending', '{{ $request->employee?->company->id }}')"><i
                                                            class="fa fa-dot-circle-o text-warning"></i> Pending</a>
                                                    <a class="dropdown-item" href="#"
                                                        wire:click="setStatus('{{ $request->id }}','Closed', '{{ $request->employee?->company->id }}')"><i
                                                            class="fa fa-dot-circle-o text-info"></i> Closed</a>
                                                    <a class="dropdown-item" href="#"
                                                        wire:click="setStatus('{{ $request->id }}','Rejected', '{{ $request->employee?->company->id }}')"
                                                        data-toggle="modal" data-target="#approve_leave"><i
                                                            class="fa fa-dot-circle-o text-danger"></i> Rejected</a>
                                                    <a class="dropdown-item" href="#"
                                                        wire:click="setStatus('{{ $request->id }}','Approved', '{{ $request->employee?->company->id }}')"><i
                                                            class="fa fa-dot-circle-o text-success"></i> Approved</a>
                                                </div>
                                            </div>
                                        @else
                                            Waiting for approval from higher level
                                        @endif
                                    </td>
                                @endcan

                                <td>
                                    @if ($request->latest)
                                        @if ($request->latest->status == 1)
                                            <span class="label label-success">Approved by :
                                                {{ $request->latest->designation }}</span>
                                            <br>
                                            <small class="text-muted">Remarks :
                                                {{ $request->latest->comments }}</small>
                                        @else
                                            <span class="label label-warning">Rejected by :
                                                {{ $request->latest->designation }}</span>
                                            <br>
                                            <small class="text-muted">Remarks :
                                                {{ $request->latest->comments }}</small>
                                        @endif
                                    @else
                                        <span class="badge badge-info">Pending</span>
                                    @endif
                                </td>
                                {{-- <td>
                                    @if ($request->status == 'Pending')
                                        <span class="text-white badge bg-info">Pending</span>
                                    @elseif($request->status == 'Closed')
                                        <span class="text-white badge bg-warning">Closed</span>
                                    @elseif($request->status == 'Rejected')
                                        <span class="text-white badge bg-danger">Rejected</span>
                                    @elseif($request->status == 'Approved')
                                        <span class="text-white badge bg-success">Approved</span>
                                    @endif
                                </td> --}}
                                <td>
                                    {{ $request->created_at->format('Y/m/d') }}
                                </td>
                                <td>
                                    {{ $request->updated_at->format('Y/m/d') }}
                                </td>
                                <td>
                                    <a class="text-danger" wire:click="delete('{{ $request->id }}')">
                                        <i class="fas fa-trash" data-toggle="tooltip" data-placement="top"
                                            title="Delete Request Submitted"></i>
                                    </a>
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
