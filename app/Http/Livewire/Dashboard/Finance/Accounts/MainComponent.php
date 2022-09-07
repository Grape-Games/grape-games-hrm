<?php

namespace App\Http\Livewire\Dashboard\Finance\Accounts;

use Livewire\Component;

class MainComponent extends Component
{
    public function render()
    {
        return view('livewire.dashboard.finance.accounts.main-component')
            ->extends('layouts.master')
            ->section('content');
    }
}
