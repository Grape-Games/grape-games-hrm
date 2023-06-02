@include('vendors.toastr')
<div>
    {{-- Be like water. --}}
    <x-bread-crumb-component :modal=true modalType="Admin Account" modalId="add_admin_account" />

    {{-- modals --}}
    <livewire:dashboard.admin.scope-management.modals.create-user-account />
    <livewire:dashboard.admin.scope-management.modals.assign-company />

    <div class="card">
        <div class="card-header">
            <livewire:user-companies-table />
        </div>
    </div>
</div>  
