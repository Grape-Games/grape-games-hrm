<?php

namespace App\Http\Controllers;

use App\Models\SalaryFormula;
use App\Http\Requests\StoreSalaryFormulaRequest;
use App\Http\Requests\UpdateSalaryFormulaRequest;
use App\Models\Employee;
use App\Services\JsonResponseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SalaryFormulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::select('*')->with('owner');
            return DataTables::of($data)->make(true);
        }
        return view('pages.salary-formulas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSalaryFormulaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSalaryFormulaRequest $request)
    {
        $salaryFormula = '';
        $data = $request->validated();
        $data['dated'] = Carbon::now();
        try {
            DB::beginTransaction();
            if ($salaryFormula = SalaryFormula::create($data)) {
                DB::commit();
                return JsonResponseService::getJsonSuccess(route('print-slip', ['id' => $salaryFormula->id]));
            }
        } catch (Exception $exception) {
            DB::rollBack();
            return JsonResponseService::getJsonException($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalaryFormula  $salaryFormula
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryFormula $salaryFormula)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalaryFormula  $salaryFormula
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryFormula $salaryFormula)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSalaryFormulaRequest  $request
     * @param  \App\Models\SalaryFormula  $salaryFormula
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalaryFormulaRequest $request, SalaryFormula $salaryFormula)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalaryFormula  $salaryFormula
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryFormula $salaryFormula)
    {
        //
    }
}
