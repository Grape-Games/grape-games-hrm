<?php

namespace App\Http\Livewire;

use App\Models\MaterialRequest;
use Livewire\Component;

class RequestMaterialComponent extends Component
{
    public $material;

    public function rules()
    {
        return [
            'material.name' => 'required|string|max:255',
            'material.description' => 'required|string',
            'material.qty' => 'required|numeric',
            'material.type' => 'required|string',
        ];
    }

    public function store()
    {
        auth()->user()->employee->materialRequests()->firstOrCreate($this->material)
            ? $this->emit('toast', 'success', "Request was submitted successfully. 😉", "Material Request")
            : $this->emit('toast', 'error', "Failed to submit your request, please try again.", "Material Request");
    }

    public function delete($id)
    {
        $model = MaterialRequest::find($id);
        if (!is_null($model)) {
            $model->delete()
                ? $this->emit('toast', 'success', "Request was deleted successfully. 😉", "Material Request")
                : $this->emit('toast', 'error', "Failed to delete request 😉", "Material Request");
        }
    }

    public function render()
    {
        return view('livewire.request-material-component', [
            'requests' => MaterialRequest::paginate(20)
        ])
            ->extends('layouts.master')->section('content');
    }
}
