<?php

namespace App\Http\Livewire;

use App\Models\MaterialRequest;
use App\Models\MaterialRequestStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RequestMaterialComponent extends Component
{
    protected $listeners = ['clear', 'setStatus'];
    public $material, $comment, $statusId;

    public function rules()
    {
        return [
            'material.name' => 'required|string|max:255',
            'material.description' => 'required|string',
            'material.qty' => 'required|numeric',
            'material.type' => 'required|string',
            'comment' => 'nullable|string|max:255'
        ];
    }

    public function updated($property, $value)
    {
        $this->validateOnly($property);
    }

    public function clear()
    {
        $this->reset('comment');
    }

    public function store()
    {
        $this->validate();

        auth()->user()->employee->materialRequests()->firstOrCreate($this->material)
            ? $this->emit('toast', 'success', "Request was submitted successfully. 😉", "Material Request")
            : $this->emit('toast', 'error', "Failed to submit your request, please try again.", "Material Request");
    }

    public function openModal($id)
    {
        $this->comment = MaterialRequestStatus::where('updated_by', auth()->id())->where('material_request_id', $id)->value('comments');
        $this->emit('showModal', 'update_comments');
    }

    public function setStatus($id, $value)
    {
        $status = auth()->user()->materialRequestStatuses()->updateOrCreate([
            'material_request_id' => $id,
            'designation' => auth()->user()->getDesignation(),
        ], [
            'status' => $value == 'Approved' ? true : false,
        ]);
        $status
            ? $this->emit('toast', 'success', "Request status was updated successfully. 😉", "Material Request Status")
            : $this->emit('toast', 'error', "Failed to update status 😉", "Material Request Status");

        $this->statusId = $status->id;
        $this->openModal($id);
    }

    public function saveRemarks()
    {
        MaterialRequestStatus::find($this->statusId)->update([
            'comments' => $this->comment
        ]);

        $this->emit('closeModal', 'update_comments');
    }

    public function delete($id)
    {
        if ($model = MaterialRequest::find($id))
            $model->statuses()->delete() && $model->delete()
                ? $this->emit('toast', 'success', "Request was deleted successfully. 😉", "Material Request")
                : $this->emit('toast', 'error', "Failed to delete request 😉", "Material Request");
    }

    public function render()
    {
        in_array(auth()->user()->role, ['admin', 'manager', 'ceo', 'finance-admin', 'finance-dept'])
            ? $requests = MaterialRequest::with('employee.user')->paginate(20)
            : $requests = MaterialRequest::where('employee_id', auth()->user()->employee->id)->with('employee.user')->paginate(20);

        return view('livewire.request-material-component', [
            'requests' => $requests
        ])
            ->extends('layouts.master')->section('content');
    }
}
