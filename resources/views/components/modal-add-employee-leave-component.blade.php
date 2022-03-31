<!-- Add leave Type Modal -->
<div id="add_leave" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Leave</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEmployeeLeave" action="{{ route('dashboard.leaves.store') }}" method="POST" novalidate>
                    @csrf
                    <div class="mb-2 el-errors-print"></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Leave Type <span class="text-danger">*</span></label>
                                <select name="leave_type_id" class="form-control" required>
                                    <option value="">Select Leave Type</option>
                                    @forelse ($leave_types as $leaveType)
                                        <option value="{{ $leaveType->id }}"
                                            data-allowed="{{ $leaveType->allowed }}"
                                            data-timespan="{{ $leaveType->time_span }}">
                                            {{ $leaveType->name }}</option>
                                    @empty
                                        <option value="">No leave type available.</option>
                                    @endforelse
                                </select>
                                <small class="text-muted pull-right">Allowed
                                    <p class="text-primary allowed-val">NULL</p>
                                </small>
                            </div>
                        </div>
                        @can('is-universal')
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Employee Name<span class="text-danger">*</span></label>
                                    <select name="employee_id" class="form-control" required>
                                        <option value="">Select Employee Name</option>
                                        @forelse ($employees as $employee)
                                            <option value="{{ $employee->user?->id }}">
                                                {{ $employee->user?->name . ' ( ' . $employee->company?->name . ' )' }}
                                            </option>
                                        @empty
                                            <option value="">No leave type available.</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        @endcan
                        {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label>Enter Number of days <span class="text-danger">*</span></label>
                                <input name="number_of_leaves" type="number" class="form-control"
                                    placeholder="No.of Days" required>
                                <small class="text-muted pull-right">Allowed <p class="text-primary allowed-val">NULL
                                    </p>
                                </small>
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total Leave in Number<span class="text-danger">*</span></label>
                                <input name="number_of_leaves" type="number" step=".5" class="form-control"
                                    placeholder="1.5" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>From<span class="text-danger">*</span></label>
                                <input name="from_date" type="datetime" class="form-control" placeholder="Date From"
                                    required>
                                {{-- min="{{ date('Y-m-d') }}" --}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description <span class="text-danger">*</span></label>
                                <textarea name="description" rows="8" type="text" class="form-control" placeholder="Some description..."
                                    required></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Add Leave</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Leave Type Modal -->

@push('extended-js')
    <script>
        $("[name=leave_type_id]").change(function(e) {
            e.preventDefault();
            var minDay = new Date();
            var maxDay = new Date();
            maxDay.setDate(maxDay.getDate() + 1);
            var dd = minDay.getDate();
            var dd2 = maxDay.getDate();
            var mm = minDay.getMonth() + 1; //January is 0!
            var yyyy = minDay.getFullYear();
            if (dd < 10) {
                dd = '0' + dd;
            }
            if (dd2 < 10) {
                dd2 = '0' + dd2;
            }
            if (mm < 10) {
                mm = '0' + mm;
            }
            minDay = yyyy + '-' + mm + '-' + dd;
            maxDay = yyyy + '-' + mm + '-' + dd2;

            if ($(this).find('option:selected').text().includes("Half")) {
                $("[name=from_date]").prop("type", "datetime-local").prop("max", maxDay).prop("min", minDay);
                $("[name=to_date]").prop("type", "datetime-local").prop("max", maxDay).prop("min", minDay);
            } else {
                $("[name=from_date]").prop("type", "date").removeAttr("max").removeAttr("min");
                $("[name=to_date]").prop("type", "date").removeAttr("max").removeAttr("min");
            }

        });
    </script>
@endpush
