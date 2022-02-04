<?php

namespace App\Http\Controllers;

use App\Traits\SalaryGeneratorTrait;
use Illuminate\Http\Request;

class SalaryCronTestController extends Controller
{
    use SalaryGeneratorTrait;
    function __invoke()
    {
        return $this->generateMonthlySlipOfAllEmployeesCron();
    }
}
