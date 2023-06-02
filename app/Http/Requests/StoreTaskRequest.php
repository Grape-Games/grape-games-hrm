<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'assigned_by'   =>'',
            'assigned_to'   =>'required',
            'project_id'    =>'required',
            'start_date'    =>'required',
            'end_date'      =>'required',
            'priority'      =>'required',
            'details'       =>'',
            'status'        =>'',
        ];
    }
}
