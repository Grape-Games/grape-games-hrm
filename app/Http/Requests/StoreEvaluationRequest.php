<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Auth;
class StoreEvaluationRequest extends FormRequest
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
            'user_id' => '',
            'employee_id' => 'required',
            'month' => 'required',
            'planning_coordination' => '',
            'quality_work' => '',
            'communication_skill' => '', 
            'confidence_level' => '',  
            'time_managment' => '',   
            'over_all_performance' => '',   
            'area_of_improvements' => '',   
            'additional_comments' => '',   
        ];
    }
}
