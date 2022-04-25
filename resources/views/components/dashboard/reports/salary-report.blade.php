<div>
    {{-- Do your work, then step back. --}}
    <div class="card">
        <div class="card-header">
            Get the monthly salary report of employees
        </div>
        <div class="card-body">
            <form id="searchReport" novalidate>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Select a company</label>
                        <div class="form-group form-focus select-focus">
                            <select class="select select2 floating @error('company_id') is-invalid @enderror"
                                name="company_id" required>
                                <option selected disabled>Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}">
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('company_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="">Select the employee</label>
                        <div class="form-group form-focus select-focus">
                            <select class="form-control select2 floating @error('employee_id') is-invalid @enderror"
                                name="employee_id" required>
                                <option selected disabled>Employee</option>
                            </select>
                            @error('employee_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">Date</label>
                        <input class="form-control" type="month" name="date" required>
                        @error('date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
            if ($(this).valid()) {
                $(this).find("button").prop('disabled', true).html('Generating report...');
                this.submit();
            }
        });

        $("[name=company_id]").change(function(e) {
            e.preventDefault();
            $.ajax({
                type: "get",
                url: "{{ route('json.getCompanyEmployees') }}",
                data: {
                    id: $(this).val()
                },
                success: function(response) {
                    makeToastr('success', 'Records fetched successfully', 'Dropdown Data');
                    $("[name=employee_id]").empty().trigger('change');

                    if (response.response.length > 0) {
                        var newState = new Option("All employees", "all",
                            true, true);
                        $("[name=employee_id]").append(newState).trigger(
                            'change');
                    }
                    $.each(response.response, function(indexInArray, valueOfElement) {
                        var newState = new Option(valueOfElement.first_name + " " +
                            valueOfElement.last_name, valueOfElement.id,
                            true, true);
                        $("[name=employee_id]").append(newState).trigger(
                            'change');
                    });
                    $("[name=employee_id]").select2({
                        placeholder: "Select an employee"
                    });
                },
                error: function(response) {
                    console.log('error');
                    console.log(response);
                }
            });
        });
    </script>
@endpush
