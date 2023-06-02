<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreDeductionRequest extends FormRequest
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
            'employee_id' => 'required',
            'assigned_by' => 'required',
            'name' => 'required',
            'month' => 'required',
            'amount' => 'required',
            'description' => 'required',
           
        ];
    }
}
