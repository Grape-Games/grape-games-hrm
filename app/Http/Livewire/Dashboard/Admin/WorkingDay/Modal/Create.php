<?php

namespace App\Http\Livewire\Dashboard\Admin\WorkingDay\Modal;

use App\Models\WorkingDay;
use App\Traits\ToastTrait;
use Exception;
use Livewire\Component;

class Create extends Component
{
    use ToastTrait;

    public $date, $reason, $update_id = null;

    protected $listeners = ['editWorkingDay', 'deleteWorkingDay'];

    public function rules()
    {
        return [
            'date' => ['required', 'date'],
            'reason' => ['required', 'string', 'max:500'],
        ];
    }

    public function updated($property)
    {
        return $this->validateOnly($property);
    }

    public function store()
    {
        $data = $this->validate();

        try {
            WorkingDay::updateOrCreate(['id' => $this->update_id], $data);

            $this->getSuccess("Working Day was created successfully. 😉");

            $this->reset();
        } catch (Exception $exception) {
            $this->getException($exception);
        }
    }

    public function editWorkingDay($id)
    {
        $model = WorkingDay::find($id);
        $this->date = $model->date;
        $this->reason = $model->reason;
        $this->update_id = $model->id;
    }

    public function deleteWorkingDay($id)
    {
        WorkingDay::findOrFail($id)->delete()
            ? $this->getSuccess("Working day was successfully removed. 😉")
            : $this->getError("Failed to remove working day.😢");
    }

    public function render()
    {
        return view('livewire.dashboard.admin.working-day.modal.create');
    }
}
