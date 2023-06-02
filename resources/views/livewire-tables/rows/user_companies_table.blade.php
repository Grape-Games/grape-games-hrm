<x-livewire-tables::bs4.table.cell>
    {{ $loop->iteration }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->email }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <div style="gap:0.4rem">
        @foreach ($row->assignedCompanies as $company)
            @isset($company->company->name)
                <p>
                    {{ $company->company->name }}
                    <span class="text-danger">
                        <i wire:click="$emit('unAssignCompany','{{ $company->id }}')" class="fa fa-times-circle bx-tada"
                            data-toggle="tooltip" data-placement="top" title="Remove Company" aria-hidden="true">
                        </i>
                    </span>
                </p>
            @endisset
        @endforeach
        <br>
        <button class="btn btn-info" data-toggle="modal" data-target="#assign_company">
            <i class="fa fa-plus-square" data-toggle="tooltip" data-placement="top" title="Assign A Company Now"
                aria-hidden="true">
            </i>
        </button>
    </div>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <div class="d-flex" style="gap: 0.4rem;">
        <button wire:click="$emit('deleteAdminAccount','{{ $row->id }}')" class="btn btn-danger">
            <i class="fas fa-trash"></i>
        </button>
        <button wire:click="$emit('editAdminAccount','{{ $row->id }}')" class="btn btn-info" data-toggle="modal"
            data-target="#add_admin_account"><i class="fas fa-edit"></i>
        </button>
    </div>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->created_at->diffForHumans() }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->updated_at->diffForHumans() }}
</x-livewire-tables::bs4.table.cell>
