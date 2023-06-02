<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
class StoreLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Gate::allows('is-universal'))
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
            'assigned_by' => 'required',
            'employee_id' => 'required',
            'name' => '',
            'number_installment' => 'required',
            'amount' => 'required',
            'description' => '',  
            'status' => '',  
            'created_at' => '',  
        ];
    }
}
