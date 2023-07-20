<x-livewire-tables::bs5.table.cell>
    {{ $row->first_name . ' ' . $row->last_name }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->email_address }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->primary_contact }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <div class="dropdown">
        <button
            class="text-white badge bg-{{ filled($row->status) && $row->status == 'active' ? 'success' : 'info' }} dropdown-toggle"
            type="button"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ filled($row->status) ? ucwords($row->status) : 'Active' }}
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" wire:click="$emit('onUpdateEmployeeStatus','{{ $row->id }}', 'active')"
                href="javascript:void(0)">Active</a>
            <a class="dropdown-item" wire:click="$emit('onUpdateEmployeeStatus','{{ $row->id }}', 'inactive')"
                href="javascript:void(0)">Inactive</a>
        </div>
    </div>
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    {{ $row->created_at->diffForHumans() }}
</x-livewire-tables::bs5.table.cell>

<x-livewire-tables::bs5.table.cell>
    <a href="javascript:void(0)" data-id="{{ $row->id }}" data-method="onDeleteEmployee"
        class="btn btn-danger btn-sm mr-2 mt-1 delete-lv" data-toggle="tooltip" title="Delete Employee"
        data-original-title="Delete Record">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>
    <a href="employees/{{ $row->id }}/edit" class="update btn btn-info btn-sm mx-auto mt-1" data-toggle="tooltip"
        title="Edit Employee" data-original-title="Update Record">
        <i class="fa fa-edit" aria-hidden="true"></i>
    </a>
</x-livewire-tables::bs5.table.cell>
