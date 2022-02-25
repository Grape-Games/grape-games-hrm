<div>
    {{-- Do your work, then step back. --}}
    <div class="card">
        <div class="card-header">
            Get the monthly report of employees
        </div>
        <div class="card-body">
            <form id="searchReport" novalidate>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Company Name</label>
                        <select class="form-control select2 @error('company_id') is-invalid @enderror" name="company_id"
                            required>
                            <option selected disabled>Select a company</option>
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
                        <select class="form-control select2 @error('employee_id') is-invalid @enderror"
                            name="employee_id" required>
                            @error('employee_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </select>
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
