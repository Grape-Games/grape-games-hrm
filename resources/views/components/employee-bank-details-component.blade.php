<form id="bankDetailsForm" action="{{ route('dashboard.employees.update', [$employee->id]) }}" method="POST"
    novalidate>
    @method('PUT')
    <div class="employee-errors-print mb-2 mt-2"></div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="">Account Title</label>
            <input type="text" class="form-control" placeholder="Account Title" name="account_title"
                value="{{ isset($employee->bank->account_title) ? $employee->bank->account_title : '' }}" required="">
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Account Number</label>
            <input type="text" class="form-control" placeholder="Account Number" name="account_number"
                value="{{ isset($employee->bank->account_number) ? $employee->bank->account_number : '' }}"
                required="">
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Bank Name</label>
            <input type="text" class="form-control" placeholder="Bank Name" name="bank_name"
                value="{{ isset($employee->bank->bank_name) ? $employee->bank->bank_name : '' }}" required="">
        </div>
        <div class="col-md-6 mb-3">
            <label for="">Branch Name</label>
            <input type="text" class="form-control" placeholder="Branch Name" name="branch_name"
                value="{{ isset($employee->bank->branch_name) ? $employee->bank->branch_name : '' }}" required="">
        </div>

        <input type="hidden" name="type" value="bank_details">
        <div class="submit-section">
            <button class="btn btn-primary submit-btn">Add Details</button>
        </div>
    </div>
</form>
