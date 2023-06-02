<div>
    <div id="teamMembers" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="top-section mb-3">
                <div class="col-md-12">
                <input type="hidden" name="team_lead_id" value="">
                               <div class="form-group">
                                <label>Please select the Employee <span
                                        class="text-danger">*</span></label>
                                <select class="js-example-basic-single select2 form-control select" 
                                    name="employee_id" required id="employee_id">
                                    <option value="">Select employee</option>
                                    @forelse ($employees as $employee)
                                        <option value="{{ $employee->id }}">
                                            {{ $employee->first_name.' '.$employee->last_name }}      ({{ $employee->designation->name}})</option>
                                    @empty
                                        <option value="">No employee eligible for account is found.</option>
                                    @endforelse
                                </select>
                                </div>
                            </div>
                </div>
                 
                <div class="show-increments text-center">
                   

                <table class="table table-striped">
                <thead>
                     <tr>
                       <th>Sr#</th>
                       <th>Employee Name</th>
                       <th>Added by</th>
                       <th>Action</th>
                     </tr>
                     </thead>
                     <tbody id="appendHere"></tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>  