<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalaryReportController extends Controller
{
    public function index()
    {
        return view('pages.reports.salary-report');
    }
}
