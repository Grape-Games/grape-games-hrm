<?php

namespace App\Http\Livewire\Dashboard\Admin;

use App\Models\AttendanceRequest as ModelsAttendanceRequest;
use Livewire\Component;

class AttendanceRequest extends Component
{
    public $status, $remarks;

    public function setStatus($id, $value)
    {
        ModelsAttendanceRequest::find($id)->update([
            'status' => $value
        ])
            ? $this->emit('toast', 'success', "Request status was updated successfully. 😉", "Attendance Request Status")
            : $this->emit('toast', 'error', "Failed to update status 😉", "Attendance Request Status");
    }

    public function setRemarks()
    {
        $id = array_key_last($this->remarks);
        ModelsAttendanceRequest::where('id', $id)->update([
            'remarks' => $this->remarks[$id]
        ])
            ? $this->emit('toast', 'success', "Request remarks were updated successfully. 😉", "Attendance Request Status")
            : $this->emit('toast', 'error', "Failed to update request remarks 😉", "Attendance Request Status");
    }

    public function render()
    {
        return view('livewire.dashboard.admin.attendance-request', [
            'tickets' => ModelsAttendanceRequest::paginate(20)
        ])
            ->extends('layouts.master');
    }
}
