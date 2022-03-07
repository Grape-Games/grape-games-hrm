<x-livewire-tables::bs4.table.cell>
    {{ $loop->iteration }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->month }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->minutes }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->date->format('l F j, Y') }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->type }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->employee->first_name . ' ' . $row->employee->last_name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->employee->company->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <div class="d-flex" style="gap: 0.4rem;">
        <button wire:click="$emit('deleteMinutes','{{ $row->id }}')" class="btn btn-danger"><i
                class="fas fa-trash"></i></button>
        <button wire:click="$emit('editMinutes','{{ $row->id }}')" class="btn btn-info" data-toggle="modal"
            data-target="#lateMinutesModal"><i class="fas fa-edit"></i></button>
    </div>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->created_at->diffForHumans() }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->updated_at->diffForHumans() }}
</x-livewire-tables::bs4.table.cell>
