<div>
    {{-- Do your work, then step back. --}}
    <div class="card">
        <div class="card-header">
            Get the monthly report of employees
        </div>
        <div class="card-body">
            <form id="searchReport">
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Company Name</label>
                        <select wire:model='company_id'
                            class="form-control select2 @error('company_id') is-invalid @enderror" name="company_id"
                            required>
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
                    <div class="col-md-6">
                        <label for="">Employee Name</label>
                        <select wire:model='employee_id'
                            class="form-control select2 @error('employee_id') is-invalid @enderror" name="employee_id"
                            required>
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
                    <div class="col-md-3">
                        <label for="">Date</label>
                        <select 
                            class="form-control select2 @error('month') is-invalid @enderror" name="month" required>
                            <option value="01">January</option>
                            <option value="02">Feburary</option>
                            <option value="03">March</option>
                            <option value="04">April</option>
                            <option value="05">May</option>
                            <option value="06">June</option>
                            <option value="07">July</option>
                            <option value="08">August</option>
                            <option value="09">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                            @error('month')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="mt-4 btn btn-success btn-block"> Get Report </button>
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
