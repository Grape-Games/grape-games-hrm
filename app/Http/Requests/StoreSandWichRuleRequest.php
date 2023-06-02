<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
class StoreSandWichRuleRequest extends FormRequest
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
            'name' => 'required',
            'date' => "required|unique:sand_wich_rules,date,$request->sandwich_id",
            'assigned_by' => 'required',
            'status' => ''
        ];
    }
}
