<div class="card">
    <div class="card-header d-flex mt-2 mb-4 ml-2">
        <h4>
            Get your monthly salary slip
        </h4>
        @if (!empty($slip))
            <div class="pull-right ml-2 mb-2">
                <a href="{{ $slipRoute }}"><span class="badge badge-success bx-tada">Latest slip
                        available here</span></a>
            </div>
        @endif
    </div>
    <div class="card-body">
        <form id="searchSalarySlipForm" action="{{ route('dashboard.employee.salary.print') }}" method="POST"
            novalidate>
            <div class="errors-print mb-2 mt-2"></div>
            <div class="row filter-row">
                <div class="col-sm-8">
                    <div class="form-group form-focus focused">
                        <input type="month" name="month"
                            max="{{ \Carbon\Carbon::now()->subMonths(1)->format('Y-m') }}" class="form-control"
                            required>
                    </div>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-success btn-block submit-btn">Submit</button>
                </div> 
            </div>
        </form>
    </div>
</div> 

@push('extended-js')

    <script src="{{ asset('js/core/employee-dashboard/salary-slips/main.js') }}"></script>

@endpush
