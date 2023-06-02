<?php

namespace App\Http\Livewire\Dashboard\Admin\EmployeeSalaryIncrements;

use Livewire\Component;

class MainComponent extends Component
{
    public function render()
    {
        return view('livewire.dashboard.admin.employee-salary-increments.main-component')
            ->extends('layouts.master');
    }
}
