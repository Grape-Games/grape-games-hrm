<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MaterialRequestTrackingIndex extends Component
{
    public $trackId;

    public function rules()
    {
        return [
            'trackId' => 'required|exists:material_requests,id'
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function check()
    {
        $this->validate();

        return redirect()->route('dashboard.livewire.material.request.tracking', ['id' => $this->trackId]);
    }

    public function render()
    {
        return view('livewire.material-request-tracking-index')
            ->extends('layouts.master')
            ->section('content');
    }
}
