<?php

namespace App\Http\Livewire\Dashboard\Admin\ScopeManagement\Modals;

use App\Models\AssignedCompany;
use App\Models\Company;
use App\Models\User;
use App\Traits\ToastTrait;
use Livewire\Component;

class AssignCompany extends Component
{
    use ToastTrait;
    public $company_id, $user_id;

    protected $listeners = ['unAssignCompany'];

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function rules()
    {
        return [
            'company_id' => 'required|exists:companies,id',
            'user_id' => 'required|exists:users,id',
        ];
    }

    public function unAssignCompany($id)
    {
        $model = AssignedCompany::find($id);
        if ($model) {
            $model->delete()
                ? $this->getSuccess("Company was un-assigned successfully. 😉")
                : $this->getError("Failed to un-assign company.😢");
        } else {
            $this->getError("Already Unassigned the company. 👍");
        }
    }

    public function store()
    {
        $data = $this->validate();

        auth()->user()->assigner()->firstOrCreate($data)
            ? $this->getSuccess("Company was assigned successfully. 😉")
            : $this->getError("Failed to assign company.😢");
    }

    public function render()
    {
        return view('livewire.dashboard.admin.scope-management.modals.assign-company', [
            'companies' => Company::all(),
            'users' => User::admins()->get()
        ]);
    }
}
