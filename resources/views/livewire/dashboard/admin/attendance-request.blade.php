@push('extended-css')
    @include('vendors.toastr')
@endpush
<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="card">
        <div class="card-header">
            Attendance Tickets
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped custom-table table-nowrap mb-0">
                    <thead>
                        <th>Sr.No</th>
                        <th>Date</th>
                        <th>Type</th>
                        <th>Openend By</th>
                        <th>Reason</th>
                        <th>Update Status</th>
                        <th>Status</th>
                        <th>Remarks</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </thead>
                    <tbody>
                        @forelse ($tickets as $ticket)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ticket->date->format('l F j, Y, g:i a') }}</td>
                                <td>{{ ucwords(str_replace('_', ' ', $ticket->type)) }}</td>
                                <td>{{ $ticket->user->name }}</td>
                                <td>{{ $ticket->query }}</td>
                                <td>
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                            data-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-dot-circle-o text-success"></i> Update Status
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                                            style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-14px, 31px, 0px);">
                                            <a class="dropdown-item" href="#"
                                                wire:click="setStatus('{{ $ticket->id }}','opened')"><i
                                                    class="fa fa-dot-circle-o text-purple"></i> Open</a>
                                            <a class="dropdown-item" href="#"
                                                wire:click="setStatus('{{ $ticket->id }}','closed')"><i
                                                    class="fa fa-dot-circle-o text-info"></i> Close</a>
                                            <a class="dropdown-item" href="#"
                                                wire:click="setStatus('{{ $ticket->id }}','rejected')"
                                                data-toggle="modal" data-target="#approve_leave"><i
                                                    class="fa fa-dot-circle-o text-success"></i> Reject</a>
                                            <a class="dropdown-item" href="#"
                                                wire:click="setStatus('{{ $ticket->id }}','resolved')"><i
                                                    class="fa fa-dot-circle-o text-danger"></i> Resolved</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($ticket->status == 'opened')
                                        <span class="text-white badge bg-info">Opened</span>
                                    @elseif($ticket->status == 'closed')
                                        <span class="text-white badge bg-warning">closed</span>
                                    @elseif($ticket->status == 'rejected')
                                        <span class="text-white badge bg-danger">Rejected</span>
                                    @elseif($ticket->status == 'resolved')
                                        <span class="text-white badge bg-success">Resolved</span>
                                    @endif
                                </td>
                                <td>
                                    <input wire:model.lazy="remarks.{{ $ticket->id }}"
                                        :key="{{ $loop->iteration }}" class="form-control" type="text"
                                        value="{{ $ticket->remarks }}"
                                        placeholder="{{ $ticket->remarks ?? 'Enter Remarks' }}">
                                    <span class="mt-2">
                                        <i class="fas fa-check-circle text-success" wire:loading.remove
                                            wire:target="setRemarks('{{ $ticket->id }}')" data-toggle="tooltip"
                                            data-placement="top" title="Update Remarks" style="cursor: pointer;"
                                            wire:click="setRemarks('{{ $ticket->id }}')"></i>
                                        <div wire:loading wire:target="setRemarks('{{ $ticket->id }}')">
                                            Updating remarks ....
                                        </div>
                                    </span>
                                </td>
                                <td>{{ $ticket->created_at->diffForHumans() }}</td>
                                <td>{{ $ticket->updated_at->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <td colspan=10>No tickets opened.</td>
                        @endforelse
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
