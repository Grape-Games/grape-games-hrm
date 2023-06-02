<x-livewire-tables::bs4.table.cell>
    {{ $loop->iteration }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->user->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->user->email }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    @if (is_null($row->companies))
        <div class="d-flex">
            <button class="btn btn-info" data-toggle="modal" data-target="#assign_company">
                <i class="fa fa-plus-square" data-toggle="tooltip" data-placement="top" title="Assign A Company Now"
                    aria-hidden="true">
                </i>
            </button>
        </div>
    @else
        @foreach ($row->companies as $company)
        @endforeach
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->assigner->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <div class="d-flex" style="gap: 0.4rem;">
        <button wire:click="$emit('deleteAdminAccount','{{ $row->user->id }}','{{ $row->id }}')"
            class="btn btn-danger"><i class="fas fa-trash"></i></button>
        <button wire:click="$emit('editAdminAccount','{{ $row->user->id }}','{{ $row->id }}')"
            class="btn btn-info" data-toggle="modal" data-target="#add_admin_account"><i
                class="fas fa-edit"></i></button>
    </div>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->created_at->diffForHumans() }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->updated_at->diffForHumans() }}
</x-livewire-tables::bs4.table.cell>
