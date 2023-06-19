<?php

namespace App\View\Components\Admin\Dashboard;

use App\Models\Attendance;
use App\Models\Employee;
use App\Traits\DateHelperTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ChartsComponent extends Component
{
    use DateHelperTrait;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $lineData = [];
        $barData = [];
        $dates = $this->generateDateRange(Carbon::now()->subDays(7), Carbon::now());

        foreach ($dates as $key => $value) {
            # code...
            // $query = "SELECT *, substr(CAST(attendance AS CHAR) , 1, 10) AS date FROM `attendances` where attendance LIKE '%" . $value . "%' GROUP BY `employee_id`";

            $data = Attendance::whereDate('attendance', $value)->get()->groupBy('employee_id');

            $obj = [];
            $obj['y'] = $value;
            $obj['a'] = Employee::active()->where('created_at', '<=', $value)->count();
            $obj['b'] = count($data);

            array_push($lineData, $obj);

            $obj = [];
            $obj['y'] = $value;
            $obj['a'] = rand(0, 100);;
            $obj['b'] = rand(0, 100);;

            array_push($barData, $obj);
        }

        $days = [];
        for ($i = 0; $i < 7; $i++)
        {
            $days[] = now()->subDays($i);
        }

        return view('components.admin.dashboard.charts-component', [
            'barData' => $barData,
            'lineData' => $lineData,
            'days'    =>$days
        ]);
    }
}
