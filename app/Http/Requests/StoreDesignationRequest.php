<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreDesignationRequest extends FormRequest
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
            'name' => 'required|string',
            'min_salary' => 'required|integer',
            'max_salary' => 'required|integer|greater_than_field:min_salary',
            'parent_designation_id' => 'required|exists:parent_designations,id',
            'status' => 'in:active,held'
        ];
    }

    public function messages()
    {
        return [
            'max_salary.greater_than_field' => 'Max Salary must be greater than Min salary'
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'owner_id' => auth()->id()
        ]);
    }
}
