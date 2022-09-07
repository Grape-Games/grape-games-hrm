<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanInstallment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLoanRequest;
use App\Services\JsonResponseService;
use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;


class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Loan::with('employee','user')->get();
            return DataTables::of($data)
            ->addColumn('created_at', function ($data){
                $created_at = "{$data->created_at->diffForHumans()}";
                return $created_at; 
                    })
            ->make(true);
        }
        
        return view("pages.loan.index");
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLoanRequest $request)
    {    
        try {
            if($request->filled('loan_id')){
                
                   Loan::where('id',$request->loan_id)->update($request->validated());
                   LoanInstallment::where('loan_id',$request->loan_id)->delete();
                   $newDateTime=Carbon::parse($request->created_at)->subMonth();
                    $amount = $request->amount/$request->number_installment;
                    foreach (range(1, $request->number_installment) as $item) {
                        LoanInstallment::insert([
                            'loan_id' => $request->loan_id,
                            'employee_id' => $request->employee_id,
                            'amount' => $amount,
                            'date' => $newDateTime->addMonth(),
                            'created_at' => Carbon::now(),
                        ]);
                          
                    }
                    return JsonResponseService::getJsonSuccess('Loan was updated successfully.');
            }else{
                    DB::transaction(function () use ($request) {
                   $loan= Loan::create($request->validated());  
                    $newDateTime = Carbon::now()->subMonth();
                    $amount = $request->amount/$request->number_installment;
                    foreach (range(1, $request->number_installment) as $item) {
                        LoanInstallment::insert([
                            'loan_id' => $loan->id,
                            'employee_id' => $request->employee_id,
                            'amount' => $amount,
                            'date' => $newDateTime->addMonth(),
                            'created_at' => Carbon::now(),
                        ]);
                          
                    }

                
            });
                    return JsonResponseService::getJsonSuccess('Loan was added successfully.');
             }
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
         
    //      ."/";
    //  echo $currentDateTime = Carbon::now()."/";
    //   echo   $newDateTime = Carbon::now()->addMonth();
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Loan::where('id',$id)->with('loan_installment')->first();
       return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
         if ($loan->delete())
            return JsonResponseService::getJsonSuccess('Loan was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete Loan');
    }
}
