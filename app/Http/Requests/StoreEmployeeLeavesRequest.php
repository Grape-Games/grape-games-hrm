<?php

namespace App\Http\Requests;

use App\Models\EmployeeLeaves;
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
            'number_of_leaves' => [
                'numeric', function ($attribute, $value, $fail) {
                    if (fmod($value, 0.5) != 0) {
                        $fail($attribute . " must be a multiple of 0.5."); // your message
                    }
                }
            ],
            'remarks' => 'string',
            'status' => 'in:pending,approved,rejected',
            'from_date' => [
                'date_format:Y-m-d', 'after_or_equal:' . Date('Y-m-d') . '', function ($attribute, $value, $fail) {
                    if (EmployeeLeaves::where('owner_id', auth()->id())->where('from_date', $value)->exists()) {
                        $fail("You have already applied for this leave.");
                    }
                }
            ]
        ];
    }

    public function attributes()
    {
        return [
            'to_date' => 'Leave to',
            'from_date' => 'Leave from'
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
