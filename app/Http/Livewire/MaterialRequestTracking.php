<?php

namespace App\Http\Livewire;

use App\Models\MaterialRequestStatus;
use Livewire\Component;

class MaterialRequestTracking extends Component
{
    public $steps;

    public function mount($id)
    {
        $this->steps = MaterialRequestStatus::where('material_request_id', $id)->with('user')->get()->toArray();
        
        if (count($this->steps) < 1)
            abort(404, 'This record does not exists');
    }

    public function render()
    {
        return view('livewire.material-request-tracking')
            ->extends('layouts.master')
            ->section('content');
    }
}
