<x-livewire-tables::bs4.table.cell>
    {{ $loop->iteration }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->user->name ?? 'Not Set' }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <div class="d-flex" style="gap: 0.4rem;">
        <button wire:click="$emit('deleteEvaluationType','{{ $row->id }}')" class="btn btn-danger"><i
                class="fas fa-trash"></i></button>
        <button wire:click="$emit('editEvaluationType','{{ $row->id }}')" class="btn btn-info" data-toggle="modal"
            data-target="#add_evaluation_type"><i class="fas fa-edit"></i>
        </button>
    </div>
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->created_at->diffForHumans() }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    {{ $row->updated_at->diffForHumans() }}
</x-livewire-tables::bs4.table.cell>
