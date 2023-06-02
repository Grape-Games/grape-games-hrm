@include('vendors.toastr')
<div>
    <x-bread-crumb-component :modal=false />
    <div class="card">
        <div class="card-header">
            Employee Salary Statuses
        </div>
        <div class="card-body">
            <livewire:salary-statuses-table />
        </div>
    </div>
    <livewire:dashboard.admin.employee-salary-increments.modals.update-details />
    <livewire:dashboard.admin.employee-salary-increments.modals.view-history />
</div>
