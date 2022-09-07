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
    {{ $row->role }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->created_at->diffForHumans() }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <button wire:click="$emit('deleteAdminFinanceAccount','{{ $row->id }}')" class="btn btn-danger">
        <i class="fas fa-trash"></i>
    </button>
</x-livewire-tables::bs4.table.cell>
