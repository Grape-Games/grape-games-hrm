<?php

namespace App\Http\Livewire\Dashboard\Finance\Accounts\Modals;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateNewAccount extends Component
{
    public $account;

    public function rules()
    {
        return [
            'account.name' => 'required|string',
            'account.email' => 'required|email|unique:users,email',
            'account.password' => 'required|string',
            'account.role' => 'required|in:ceo,finance-admin,finance-dept',
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function store()
    {
        $this->account['password'] = Hash::make($this->account['password']);

        User::firstOrCreate($this->account)
            ? $this->emit('toast', 'success', "Finance related of " . ucwords($this->account['role']) . " was created 😉", "Account Status")
            : $this->emit('toast', 'error', "Finance related of " . ucwords($this->account['role']) . " was not created 😉", "Account Status");

        $this->reset('account');
    }

    public function render()
    {
        return view('livewire.dashboard.finance.accounts.modals.create-new-account');
    }
}
