<div class="row">
    <div class="col-sm-12">
        <div class="card mb-0">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title mb-0">Employees Table</h4>
                        <p class="card-text">
                            This table show a list of all
                            <code>employees</code> in the system.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('dashboard.employees.create') }}" class="btn add-btn float-right">
                            <i class="fa fa-plus"></i> Add Employee
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <livewire:employee-table />
                </div>
            </div>
        </div>
    </div>
</div>
