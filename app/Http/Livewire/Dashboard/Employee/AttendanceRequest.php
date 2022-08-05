<?php

namespace App\Http\Livewire\Dashboard\Employee;

use App\Models\AttendanceRequest as ModelsAttendanceRequest;
use App\Services\MailService;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class AttendanceRequest extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['dt' => '$refresh'];

    public $type, $date, $query;

    public function rules()
    {
        return [
            'type' => 'required|in:attendance_correction',
            'date' => 'required',
            'query' => 'required|max:255'
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }
    public function store()
    {
        $data = $this->validate();
        $data['submitted_by'] = auth()->id();
        try {
        } catch (Exception $exception) {
            $this->emit('toast', 'error', $exception->errorInfo[2] ?? $exception->getMessage(), "Exception");
        }
        ModelsAttendanceRequest::firstOrCreate($data)
            ? $this->emit('toast', 'success', "Request was submitted successfully. 😉", "Attendance Request")
            : $this->emit('toast', 'error', "Failed to submit your request, please try again.", "Attendance Request");

        MailService::sendAttendanceRequestEmailToAdmin($data['query']);
    }

    public function delete($id)
    {
        $model = ModelsAttendanceRequest::find($id);
        if (!is_null($model)) {
            $model->delete()
                ? $this->emit('toast', 'error', "Request was deleted successfully. 😉", "Attendance Request")
                : $this->emit('toast', 'error', "Failed to delete request 😉", "Attendance Request");
        }
    }
    public function render()
    {
        return view('livewire.dashboard.employee.attendance-request', [
            'requests' =>  ModelsAttendanceRequest::where('submitted_by', auth()->id())->paginate(10)
        ])->extends('layouts.master')->section('content');
    }
}
