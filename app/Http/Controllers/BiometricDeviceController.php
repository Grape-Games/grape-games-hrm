<?php

namespace App\Http\Controllers;

use App\Models\BiometricDevice;
use App\Http\Requests\StoreBiometricDeviceRequest;
use App\Http\Requests\UpdateBiometricDeviceRequest;
use App\Services\JsonResponseService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class BiometricDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = BiometricDevice::select('*')->with(['owner']);
            return DataTables::of($data)->make(true);
        }

        return view('pages.biometric-devices.index');
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
     * @param  \App\Http\Requests\StoreBiometricDeviceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBiometricDeviceRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                BiometricDevice::create($request->validated());
            });
            return JsonResponseService::getJsonSuccess('Biometric Device was added successfully.');
        } catch (Exception $exception) {
            return JsonResponseService::getJsonException($exception);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BiometricDevice  $biometricDevice
     * @return \Illuminate\Http\Response
     */
    public function show(BiometricDevice $biometricDevice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BiometricDevice  $biometricDevice
     * @return \Illuminate\Http\Response
     */
    public function edit(BiometricDevice $biometricDevice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBiometricDeviceRequest  $request
     * @param  \App\Models\BiometricDevice  $biometricDevice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBiometricDeviceRequest $request, BiometricDevice $biometricDevice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BiometricDevice  $biometricDevice
     * @return \Illuminate\Http\Response
     */
    public function destroy(BiometricDevice $biometricDevice)
    {
        if ($biometricDevice->delete())
            return JsonResponseService::getJsonSuccess('Biometric Device was deleted successfully.');
        return JsonResponseService::getJsonFailed('Failed to delete designation.');
    }
}
