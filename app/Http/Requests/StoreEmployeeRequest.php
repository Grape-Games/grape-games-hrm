<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Gate::allows('is-admin'))
            return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city' => 'required|string',
            'cnic' => 'required|string|unique:employees,cnic',
            'company_id' => 'required|exists:companies,id',
            'designation_id' => 'required|exists:designations,id',
            'email_address' => 'required|email|unique:employees,email_address',
            'enrollment_no' => 'string',
            'father_name' => 'required|string',
            'first_name' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'last_name' => 'required|string',
            'primary_contact' => 'required|numeric',
            'registration_no' => 'string|required',
            'secondary_contact' => 'required|string',
            'biometric_device_id' => 'required|exists:biometric_devices,id'
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'owner_id' => auth()->id()
        ]);
    }
}
