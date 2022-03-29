@include('vendors.toastr')
<div>
    {{-- Be like water. --}}
    <x-bread-crumb-component :modal=true modalType="Evaluation Type" modalId="add_evaluation_type" />

    {{-- modals --}}
    <livewire:dashboard.admin.evaluations.modals.evaluation-type />

    <div class="card">
        <div class="card-header">
            <livewire:evaluation-types-table />
        </div>
    </div>
</div>
