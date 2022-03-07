<?php

namespace App\Http\Livewire\Dashboard\Admin\EmployeeSalaryIncrements\Modals;

use App\Models\EmployeeSalaryStatus;
use Carbon\Carbon;
use Livewire\Component;

class UpdateDetails extends Component
{

    public $employeeName, $next_increment, $time_period, $increment_amount, $update_id = null;

    protected $listeners = ['editIncrement'];

    protected $rules = [
        'increment_amount' => 'required|integer',
        'next_increment' => 'required|date|after_or_equal:now',
        'time_period' => 'required|integer'
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function editIncrement($id)
    {
        $model = EmployeeSalaryStatus::find($id);
        $this->update_id = $id;
        $this->employeeName = $model->employee->first_name . ' ' . $model->employee->last_name;
        $this->increment_amount = $model->increment_amount;
        $this->time_period = $model->time_period;
        $this->next_increment = Carbon::parse($model->next_increment)->format('Y-m-d');
    }

    public function update()
    {
        $data = $this->validate();
        EmployeeSalaryStatus::find($this->update_id)->update($data)
            ? $this->emit('toast', 'success', "Increment was updated successfully. 😉", "Increment Status")
            : $this->emit('toast', 'error', "Failed to update increment 😉", "Increment Status");

        $this->reset();
    }

    public function render()
    {
        return view('livewire.dashboard.admin.employee-salary-increments.modals.update-details');
    }
}
