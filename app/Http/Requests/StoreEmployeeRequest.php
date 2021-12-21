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
            'department_id' => 'required|numeric',
            'designation_id' => 'required|numeric',
            'email_address' => 'required|email|unique:employees,email_address',
            'enrollment_no' => 'required|string',
            'father_name' => 'required|string',
            'first_name' => 'required|string',
            'gender' => 'required|string|in:male,female',
            'last_name' => 'required|string',
            'primary_contact' => 'required|numeric',
            'registration_no' => 'required|string',
            'secondary_contact' => 'required|string',
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'owner_id' => auth()->id()
        ]);
    }
}
