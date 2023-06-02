<?php

namespace App\Http\Livewire\Dashboard\Admin\Evaluations;

use Livewire\Component;

class EvaluationType extends Component
{
    public function render()
    {
        return view('livewire.dashboard.admin.evaluations.evaluation-type')
            ->extends('layouts.master'); 
    }
}
