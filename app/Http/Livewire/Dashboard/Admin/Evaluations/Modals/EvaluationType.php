<?php

namespace App\Http\Livewire\Dashboard\Admin\Evaluations\Modals;

use App\Models\EvaluationType as ModelsEvaluationType;
use App\Traits\ToastTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EvaluationType extends Component
{
    use ToastTrait;

    protected $listeners = ['deleteEvaluationType', 'editEvaluationType'];

    public $name, $update_id = null;

    public function rules() 
    {
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    public function updated($property)
    {
        return $this->validateOnly($property);
    }

    public function store()
    {
        $data = $this->validate();

        $data['user_id'] = auth()->user()->id;

        ModelsEvaluationType::updateOrCreate(['id' => $this->update_id], $data)
            ? $this->getSuccess("Evaluation Type was created successfully. 😉")
            : $this->getError("Evaluation Type was not created successfully. 😉");

        $this->reset();
    }

    public function deleteEvaluationType($id)
    {
        $model = ModelsEvaluationType::findOrFail($id);
        $model->delete()
            ? $this->getSuccess("Evaluation Type was deleted successfully. 😉")
            : $this->getError("Evaluation Type was not deleted successfully. 😉");
    }

    public function editEvaluationType($id)
    {
        $model = ModelsEvaluationType::findOrFail($id);
        $this->name = $model->name;
        $this->update_id = $model->id;
    }

    public function render()
    {
        return view('livewire.dashboard.admin.evaluations.modals.evaluation-type');
    }
}
