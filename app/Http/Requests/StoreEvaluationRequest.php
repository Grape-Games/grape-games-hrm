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
        if (Gate::allows('is-team-lead'))
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
            'overall_rating' => '',  
            'time_managment' => '',   
            'over_all_performance' => '',   
            'area_of_improvements' => '',   
            'additional_comments' => '',     
        ];
    }


    public function validated()
    {
        $validated = parent::validated();
        $total_rating = $validated['planning_coordination']+$validated['quality_work']+$validated['communication_skill']+$validated['overall_rating']+$validated['time_managment'];
        return array_merge( $validated, ['total_rating' => $total_rating]);
    }
}
