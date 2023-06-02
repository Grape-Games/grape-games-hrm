<div>
   <!-- Add Salary Formula Modal -->
<div id="add_sandwichRule" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Sand Which Rule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addNewSandWichRule" method="POST"
                   action="{{ route('dashboard.sand-wich.store') }}" novalidate>
                    @csrf
                    <div class="em-errors-print mb-2"></div>
                    <input type="hidden" name="assigned_by" id="" value="{{$user_id}}">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Name</label>
                              <input type="text" name="name" id="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Select Date</label>
                              <input type="date" name="date" id="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                                <label for="">Active <input type="radio" name="status" value="1" checked id="active"></label>
                                <label for="" class="m-4">In Active <input type="radio" name="status" value="0" id="inactive"></label>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Add Sand Which Rule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Employee Salary Modal -->
</div>