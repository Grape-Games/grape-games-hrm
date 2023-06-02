@include('vendors.toastr')
<div>
    {{-- Be like water. --}}
    <x-bread-crumb-component :modal=true modalType="Working Day" modalId="add_working_day" />

    {{-- modals --}}
    <livewire:dashboard.admin.working-day.modal.create />

    <div class="card">
        <div class="card-header">
            <livewire:working-days-table />
        </div>
    </div>
</div>
