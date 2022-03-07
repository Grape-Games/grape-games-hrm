<?php

namespace App\View\Components;

use App\Models\Company;
use App\Models\Employee;
use App\Models\SalarySlip;
use Carbon\Carbon;
use DateTime;
use Illuminate\View\Component;

class SearchResultTableComponent extends Component
{
    public $company;
    public $month;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($company, $month)
    {
        $this->company = $company;
        $this->month = $month;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */

    public function render()
    {
        $salArr = [];
        $employees = Employee::where('company_id', $this->company)->with(['salaryFormula'])->get();

        $slips = SalarySlip::where('month_year', Carbon::parse($this->month)->format('Y-M'))->get();
        foreach ($slips as $slip) {
            if ($employees->contains('id', $slip->employee_id)) {
                $salArr[$slip->employee_id] = $slip;
            }
        }

        return view('components.search-result-table-component', [
            'employees' => $employees,
            'salArr' => $salArr,
            'month' => Carbon::now()->format('Y-M'),
            'companyName' => Company::where('id', $this->company)->value('name')
        ]);
    }
}
