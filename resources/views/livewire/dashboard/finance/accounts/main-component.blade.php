@include('vendors.toastr')
<div>
    <x-bread-crumb-component :modal=true modalType="Admin Account" modalId="add_admin_account" />
    <div class="card">
        <div class="card-header">
            Finance Related Accounts
        </div>
        <div class="card-body">
            <livewire:finance-accounts-table />
        </div>
    </div>
    <livewire:dashboard.finance.accounts.modals.create-new-account />
</div>
