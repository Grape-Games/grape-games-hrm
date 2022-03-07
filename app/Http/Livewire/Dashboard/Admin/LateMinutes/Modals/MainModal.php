<?php

namespace App\Http\Livewire\Dashboard\Admin\LateMinutes\Modals;

use App\Models\LateMinutes;
use Livewire\Component;

class MainModal extends Component
{
    protected $listeners = ['deleteMinutes', 'editMinutes'];
    public $update_id = null, $minutes;

    public function editMinutes($id)
    {
        $model = LateMinutes::find($id);
        $this->update_id = $id;
        $this->minutes = $model->minutes;
    }

    public function deleteMinutes($id)
    {
        LateMinutes::find($id)->delete()
            ? $this->emit('toast', 'success', "Late Minutes were deleted successfully. 😉", "Late Minutes Status")
            : $this->emit('toast', 'error', "Failed to delete late minutes 😉", "Late Minutes Status");
    }

    public function update()
    {
        LateMinutes::find($this->update_id)->update(['minutes' => $this->minutes])
            ? $this->emit('toast', 'success', "Late Minutes were updated successfully. 😉", "Late Minutes Status")
            : $this->emit('toast', 'error', "Failed to update late minutes 😉", "Late Minutes Status");
    }


    public function render()
    {
        return view('livewire.dashboard.admin.late-minutes.modals.main-modal');
    }
}
