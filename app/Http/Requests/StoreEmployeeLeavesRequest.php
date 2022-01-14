<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreEmployeeLeavesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Gate::allows('is-both'))
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
            'description' => 'string',
            'leave_type_id' => 'exists:leave_types,id',
            'number_of_leaves' => 'numeric',
            'remarks' => 'string',
            'status' => 'in:pending,approved,rejected'
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'year' => date("Y"),
            'owner_id' => auth()->id()
        ]);
    }
}
