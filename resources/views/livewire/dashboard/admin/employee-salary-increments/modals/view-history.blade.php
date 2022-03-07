<div wire:ignore.self id="view_history" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Increment History of {{ $employeeName }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        @forelse ($details as $item)
                            <div class="col-md-12">
                                <h3><strong>Increment Number {{ $loop->iteration }}</strong></h3>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label for="">Increment Amount</label>
                                <input class="form-control" type="text"
                                    value="{{ 'RS : ' . $item->increment_amount . ' /-' }}" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="">Increment Date</label>
                                <input class="form-control" type="text"
                                    value="{{ $item->next_increment->format('l F j, Y') }}" readonly>
                            </div>
                            <div class="col-md-2">
                                <label for="">Increment After</label>
                                <input class="form-control" type="text" value="{{ $item->time_period . ' months' }}"
                                    readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="">New Salary</label>
                                <input class="form-control" type="text"
                                    value="{{ 'Rs : ' . $item->before_increment + $item->increment_amount . ' /-' }}"
                                    readonly>
                            </div>
                            <div class="col-md-2">
                                <label for="">Status</label>
                                <input
                                    class="form-control @if ($item->status == 'applied') text-success @else text-danger @endif"
                                    type="text" value="{{ ucwords($item->status) }}" readonly>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <div class="alert alert-danger" role="alert">
                                    <strong>Nothing found 😢</strong>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
