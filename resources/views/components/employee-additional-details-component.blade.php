<form id="additionalInformationForm" action="{{ route('dashboard.employees.update', [$employee->id]) }}" method="POST"
    novalidate>
    @method('PUT')
    <div class="mt-2 mb-2 employee-errors-print"></div>
    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="">Cast Of Staff</label>
            <input type="text" class="form-control" placeholder="Cast of Staff"
                value="{{ isset($employee->additional->cast_of_staff) ? $employee->additional->cast_of_staff : '' }}"
                name="cast_of_staff">
        </div>
        <div class="mb-3 col-md-4">
            <label for="">Blood Group</label>
            <input type="text" class="form-control" placeholder="Blood Group"
                value="{{ isset($employee->additional->blood_group) ? $employee->additional->blood_group : '' }}"
                name="blood_group">
        </div>
        <div class="mb-3 col-md-4">
            <label for="">Date of Birth</label>
            <input type="date" class="form-control" placeholder="Father Name"
                value="{{ isset($employee->additional->dob) ? $employee->additional->dob->format('Y-m-d') : '' }}"
                name="dob">
        </div>
        <div class="mb-3 col-md-4">
            <label for="">Reference</label>
            <input type="text" class="form-control" placeholder="Hired Person Referred by"
                value="{{ isset($employee->additional->referred_by) ? $employee->additional->referred_by : '' }}"
                name="referred_by">
        </div>
        <div class="mb-3 col-md-4">
            <label for="">Joining Date</label>
            <input type="date" class="form-control" placeholder="Leave Date"
                value="{{ isset($employee->additional->join_date) ? $employee->additional->join_date->format('Y-m-d') : '' }}"
                name="join_date">
        </div>
        <div class="mb-3 col-md-4">
            <label for="">Leaving Date</label>
            <input type="date" class="form-control" placeholder="Join Date"
                value="{{ isset($employee->additional->leave_date) ? $employee->additional->leave_date->format('Y-m-d') : '' }}"
                name="leave_date">
        </div>
        <div class="mb-3 col-md-6">
            <label for="">Resignation Date</label>
            <input type="date" class="form-control" placeholder="Resignation Date"
                value="{{ isset($employee->additional->resignation_date)? $employee->additional->resignation_date->format('Y-m-d'): '' }}"
                name="resignation_date">
        </div>
        <div class="mb-3 col-md-6">
            <label for="">Certificate Name</label>
            <input type="text" class="form-control" placeholder="Certificate Name"
                value="{{ isset($employee->additional->certificate_name) ? $employee->additional->certificate_name : '' }}"
                name="certificate_name">
        </div>
        <div class="mb-3 col-md-6">
            <label for="">Address</label>
            <textarea rows="10" type="text" class="form-control" placeholder="Address"
                value="{{ $employee->additional->address ?? '' }}"
                name="address">{{ $employee->additional->address ?? '' }}</textarea>
        </div>
        <div class="mb-3 col-md-6">
            <label for="">Job Description</label>
            <textarea rows="10" type="text" class="form-control" placeholder="Job Description"
                value="{{ isset($employee->additional->job_description) ? $employee->additional->job_description : '' }}"
                name="job_description">{{ $employee->additional->job_description ?? '' }}</textarea>
        </div>
        <input type="hidden" name="type" value="additional_information">
        <div class="submit-section">
            <button class="btn btn-primary submit-btn">Add Details</button>
        </div>
    </div>
</form>
