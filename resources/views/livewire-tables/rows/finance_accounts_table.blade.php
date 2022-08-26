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
        @foreach ($row->companies as $company)
            <span wire:click="unassign('{{ $company->id }}')" style="cursor: pointer;" class="badge badge-success"
                data-toggle="tooltip" data-placement="top" title="Click to unassign">{{ $company->name }}
            </span>
        @endforeach
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
