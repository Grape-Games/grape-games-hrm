<div>
    {{-- Do your work, then step back. --}}
    <div class="card">
        <div class="card-header">
            Get the monthly report of employees
        </div>
        <div class="card-body">
            <form id="searchReport">
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Company Name</label>
                        <select wire:model='company_id'
                            class="form-control select2 @error('company_id') is-invalid @enderror" name="company_id" required>
                            <option>Select Company</option>
                            @foreach ($companies as $company)
                                <option value="{{ $company->id }}">
                                    {{ $company->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('company_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="">Employee Name</label>
                        <select wire:model='employee_id'
                            class="form-control select2 @error('employee_id') is-invalid @enderror" name="employee_id" required>
                            <option>Select Employee</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}">
                                    {{ $employee->first_name . ' ' . $employee->last_name }}
                                </option>
                            @endforeach
                            @error('employee_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success btn-block mt-4"> Get Report </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@push('extended-js')
    <script>
        $("#searchReport").submit(function(e) {
            e.preventDefault();
            $(this).valid() ? this.submit() : false;
        });
    </script>
@endpush
