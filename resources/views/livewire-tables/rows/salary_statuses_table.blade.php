@isset($row->employee)
    <x-livewire-tables::bs4.table.cell>
        {{ $loop->iteration }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        @if (!$row->can_view)
            <div class="form-check">
                <input wire:click="$emit('changeVal','{{ $row->id }}',true)" type="checkbox" class="form-check-input">
            </div>
        @else
            <div class="form-check">
                <input wire:click="$emit('changeVal','{{ $row->id }}',false)" type="checkbox" class="form-check-input"
                    checked>
            </div>
        @endif
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->time_period . ' months' }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->last_increment->format('l F j, Y') }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ 'RS : ' . $row->last_increment_amount . ' /-' }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->next_increment->format('l F j, Y') }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ 'RS : ' . $row->increment_amount . ' /-' }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ 'RS : ' . $row->before_increment . ' /-' }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ 'RS : ' . $row->before_increment + $row->increment_amount . ' /-' }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        <a wire:click="$emit('viewHistory', '{{ $row->employee_id }}')" href="#" data-toggle="modal"
            data-target="#view_history" data-toggle="tooltip" data-placement="top" title="Click to view history">
            {{ $row->employee->first_name . ' ' . $row->employee->last_name }}
        </a>
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->employee->company?->name }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->user?->name }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        <div class="d-flex" style="gap: 0.4rem;">
            <button wire:click="$emit('editIncrement','{{ $row->id }}')" class="btn btn-info" data-toggle="modal"
                data-target="#update_increment_details"><i class="fas fa-edit"></i></button>
        </div>
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->created_at->diffForHumans() }}
    </x-livewire-tables::bs4.table.cell>

    <x-livewire-tables::bs4.table.cell>
        {{ $row->updated_at->diffForHumans() }}
    </x-livewire-tables::bs4.table.cell>
@endisset
