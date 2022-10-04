<div>
   <!-- Add Salary Formula Modal -->
<div id="add_project" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addNewProject" method="POST"
                   action="{{ route('dashboard.project.store') }}" novalidate>
                    @csrf
                    <div class="em-errors-print mb-2"></div>
                    <input type="hidden" name="owner_id" id="" value="{{$user_id}}">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Name</label>
                              <input type="text" name="name" id="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="">Budget</label>
                              <input type="number" name="buget" id="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                              <label for="">URL</label>
                              <input type="text" name="url" id="" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Add Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Employee Salary Modal -->
</div>