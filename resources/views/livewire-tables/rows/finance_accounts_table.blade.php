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
    @if ($row->role == 'ceo')
        <span class="badge badge-success">{{ $row->company?->name }}</span>
    @endif
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->created_at->diffForHumans() }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <a class="text-danger" wire:click="$emit('deleteAdminFinanceAccount','{{ $row->id }}')">
        <i class="fas fa-trash"></i>
    </a>
</x-livewire-tables::bs4.table.cell>
