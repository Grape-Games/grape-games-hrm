<div>
    <x-bread-crumb-component :modal=false />
    <div class="card">
        <div class="card-header">
            <h4>
                Submit an attendance request
            </h4>
        </div>
        <div class="card-body">
            <div class="row filter-row">
                <div class="col-sm-4">
                    <label class="focus-label">Date</label>
                    <input wire:model.lazy="date" type="datetime-local"
                        class="form-control @error('date') is-invalid @enderror">
                    @error('date')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <label class="focus-label">Select Type</label>
                    <select wire:model.lazy="type" class="form-control @error('type') is-invalid @enderror">
                        <option>-</option>
                        <option value="attendance_correction">Attendance Correction</option>
                    </select>
                    @error('type')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <label class="focus-label">Enter Query</label>
                    <textarea wire:model.lazy="query" class="form-control @error('query') is-invalid @enderror"
                        placeholder="Enter details of issue"></textarea>
                    @error('query')
                        <span class="text-danger"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <button href="#" wire:click="store" class="btn btn-success btn-block" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="store">
                            Submit
                        </span>
                        <span wire:loading wire:target="store">
                            Submitting Please wait...
                            <i class="fas fa-spinner    "></i>
                        </span>

                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-header">
            <h4>
                Your Attendance Requests
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped custom-table table-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Dated</th>
                            <th>Type</th>
                            <th>Reason</th>
                            <th>Remarks</th>
                            <th>Status</th>
                            <th>Reviewed By</th>
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
                                    {{ $request->date->format('l F j, Y, g:i a') }}
                                </td>

                                <td>
                                    {{ ucwords(str_replace('_', ' ', $request->type)) }}
                                </td>

                                <td>
                                    {{ $request->query }}
                                </td>

                                <td>
                                    {{ $request->remarks ?? 'Not available 😥' }}
                                </td>
                                <td>
                                    @if ($request->status == 'opened')
                                        <span class="text-white badge bg-info">Opened</span>
                                    @elseif($request->status == 'closed')
                                        <span class="text-white badge bg-warning">closed</span>
                                    @elseif($request->status == 'rejected')
                                        <span class="text-white badge bg-danger">Rejected</span>
                                    @elseif($request->status == 'resolved')
                                        <span class="text-white badge bg-success">Resolved</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $request->reviewer ? $request->reviewer->name : 'Wait for response...' }}
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
