<?php

namespace App\Http\Livewire\Dashboard\Admin\WorkingDay;

use Livewire\Component;

class MainComponent extends Component
{
    public function render()
    {
        return view('livewire.dashboard.admin.working-day.main-component')
            ->extends('layouts.master');
    }
}
