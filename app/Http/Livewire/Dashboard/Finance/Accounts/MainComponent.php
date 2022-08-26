<?php

namespace App\Http\Livewire\Dashboard\Finance\Accounts;

use App\Models\Company;
use App\Models\User;
use Livewire\Component;

class MainComponent extends Component
{
    public $companyId, $ceoId;

    public function rules()
    {
        return [
            'ceoId' => 'required|exists:users,id',
            'companyId' => 'required|exists:companies,id',
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function assign()
    {
        $this->validate();
        $company =  Company::whereId($this->companyId);

        $company->update([
            'ceo_id' => $this->ceoId,
        ]);

        $this->emit('toast', 'success', "Ceo was assigned successfully 😉", "Assign Status");
    }

    public function render()
    {
        return view('livewire.dashboard.finance.accounts.main-component', [
            'companies' => Company::whereNull('ceo_id')->get(),
            'users' => User::whereRole('ceo')->get()
        ])
            ->extends('layouts.master')
            ->section('content');
    }
}
