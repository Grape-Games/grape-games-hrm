<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
class StoreHolidayRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'details' => 'required|string|max:255',
            // 'date' => 'required|date|unique:holidays,date,NULL,id,deleted_at,NULL',
            'date' => "required|unique:holidays,date,$request->hd_id",
            'sandwich_id' => '',  
        ];
    }

    public function messages()
    {
        return [
            'date.unique' => 'Holiday on this date is already added.'
        ];
    }

    public function validated()
    {
        return array_merge(parent::validated(), [
            'owner_id' => auth()->id()
        ]);
    }
}
