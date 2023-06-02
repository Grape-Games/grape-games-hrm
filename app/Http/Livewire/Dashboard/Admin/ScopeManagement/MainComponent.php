<?php

namespace App\Http\Livewire\Dashboard\Admin\ScopeManagement;

use Livewire\Component;

class MainComponent extends Component
{
    public function render()
    {
        return view('livewire.dashboard.admin.scope-management.main-component')
            ->extends('layouts.master');
    }
}
