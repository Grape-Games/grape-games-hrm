<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-danger alert-dismissible fade show d-none bx-flashing" role="alert">
            <strong>Error!</strong> Invalid month. Please select a valid month ( Lower than :
            {{ \Carbon\Carbon::now()->format('Y-M') }} ) <button type="button" class="close"
                data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Print Employee Salary</h4>
            </div>
            <div class="card-body">
                <form id="searchEmployees" action="#" novalidate>
                    <div class="form-group mb-0 row">
                        <div class="col-xl-12 col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Select Company</label>
                                <div class="col-lg-9">
                                    <select class="select2 form-control" name="company_id" required>
                                        @forelse ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @empty
                                            <option value="">No Company Found.</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Select Salary Month</label>
                                <div class="col-lg-9">
                                    <input type="month" name="month" class="form-control"
                                        max="{{ \Carbon\Carbon::now()->format('Y-m') }}" required>
                                    <small class="text-muted mt-2">Note : This months salary details will be available
                                        at
                                        the end of month.</small>
                                </div>

                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary search-company">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if (Request::has('company_id') && Request::has('month'))
            @if (Request::get('month') <= \Carbon\Carbon::now()->format('Y-m'))
                @push('extended-js')
                    <script>
                        $(function() {
                            $(".alert").addClass('d-none');
                        });
                    </script>
                @endpush
                <x-search-result-table-component company="{{ Request::get('company_id') }}"
                    month="{{ Request::get('month') }}" />
            @else
                @push('extended-js')
                    <script>
                        $(function() {
                            $(".alert").removeClass('d-none');
                        });
                    </script>
                @endpush
            @endif
        @else
            <x-all-employee-salary-table-component />
        @endif
    </div>
</div>
