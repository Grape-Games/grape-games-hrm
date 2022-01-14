<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreSalaryFormulaRequest extends FormRequest
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
            'per_day' => 'numeric|nullable',
            'per_hour' => 'numeric|nullable',
            'per_minute' => 'numeric|nullable',
            'basic_salary' => 'numeric|required',
            'house_allowance' => 'numeric|nullable',
            'mess_allowance' => 'numeric|nullable',
            'travelling_allowance' => 'numeric|nullable',
            'medical_allowance' => 'numeric|nullable',
            // 'eid_allowance' => 'numeric|nullable',
            // 'other_allowance' => 'numeric|nullable',
            // 'advance_salary' => 'numeric|nullable',
            // 'electricity' => 'numeric|nullable',
            // 'arrears' => 'numeric|nullable',
            // 'income_tax' => 'numeric|nullable',
            'dated' => 'date|nullable',
            'employee_id' => 'required|exists:employees,id'
        ];
    }
}
