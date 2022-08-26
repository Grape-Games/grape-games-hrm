<?php

namespace App\Http\Livewire\Dashboard\Finance\Accounts\Modals;

use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateNewAccount extends Component
{
    public $account, $showCompanies, $companyId;

    public function rules()
    {
        $rule = array_key_exists('role', $this->account)
            ? ($this->account['role'] == 'ceo' ? 'required|exists:companies,id' : 'nullable')
            : 'nullable';

        return [
            'account.name' => 'required|string',
            'account.email' => 'required|email|unique:users,email',
            'account.password' => 'required|string',
            'account.role' => 'required|in:ceo,finance-admin,finance-dept',
            'companyId' => $rule
        ];
    }

    public function updated($property, $value)
    {
        if ($property == 'account.role')
            $value == "ceo" ? $this->showCompanies = true : $this->showCompanies = false;

        $this->validateOnly($property);
    }

    public function store()
    {
        $this->validate();
        $this->account['password'] = Hash::make($this->account['password']);

        $account = User::firstOrCreate($this->account);

        $account
            ? $this->emit('toast', 'success', ucwords($this->account['role']) . " was created 😉", "Account Status")
            : $this->emit('toast', 'error', ucwords($this->account['role']) . " was not created 😉", "Account Status");

        if ($this->companyId) {
            Company::whereId($this->companyId)->update([
                'ceo_id' => $account->id
            ]);
        }
        $this->reset();
    }

    public function render()
    {
        return view('livewire.dashboard.finance.accounts.modals.create-new-account', [
            'companies' => Company::whereNull('ceo_id')->get(),
        ]);
    }
}
