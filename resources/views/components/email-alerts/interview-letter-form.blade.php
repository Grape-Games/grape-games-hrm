<div>
    <div class="card">
        <div class="card-header">
            <h4>Email Alert for Interview Call</h4>
        </div>
        <div class="card-body">
            <form id="interviewLetterEmail" action="{{ route('dashboard.send-interview-letter.send') }}" method="POST"
                novalidate>
                @csrf
                <div class="errors-print mb-2"></div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name of candidate<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" placeholder="Full Name" name="name" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Candidate Email Address<span class="text-danger">*</span></label>
                            <input class="form-control" type="email" placeholder="Email Address" name="email"
                                required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Designation<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" placeholder="Some Designation" name="designation"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Slot 1<span class="text-danger">*</span></label>
                            <input class="form-control" type="datetime-local" placeholder="Slot 1" name="slot_1" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Slot 2</label>
                            <input class="form-control" type="datetime-local" placeholder="Slot 2" name="slot_2">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary submit-btn">Send Interview Letter
                            Email
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
