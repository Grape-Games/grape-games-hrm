<?php

namespace App\Http\Livewire\Dashboard\Admin\LateMinutes;

use Livewire\Component;

class MainComponent extends Component
{
    public function render()
    {
        return view('livewire.dashboard.admin.late-minutes.main-component')
            ->extends('layouts.master');
    }
}
