@push('extended-css')
    @include('vendors.toastr')
@endpush
<div>
    <x-bread-crumb-component :modal=false />
    {{-- Success is as dangerous as failure. --}}
    <div class="card">
        <div class="card-header">
            Late Minutes Report
        </div>
        <div class="card-body">
            <livewire:late-minutes-table />
        </div>
    </div>
    <div>
        <livewire:dashboard.admin.late-minutes.modals.main-modal />
    </div>
</div>
