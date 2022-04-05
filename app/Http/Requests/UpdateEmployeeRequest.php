<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'cast_of_staff' => 'string|nullable',
            'blood_group' => 'string|nullable',
            'dob' => 'date|nullable',
            'company_id' => 'exists:companies,id',
            'referred_by' => 'string|nullable',
            'join_date' => 'date|nullable',
            'leave_date' => 'date|nullable',
            'resignation_date' => 'date|nullable',
            'certificate_name' => 'string|nullable',
            'address' => 'string|nullable',
            'job_description' => 'string|nullable',
            'account_number' => 'required_if:type,bank_details,required_with:account_title,bank_name,branch_name',
            'account_title' => 'required_with:account_number,bank_name,branch_name',
            'bank_name' => 'required_with:account_title,account_number,branch_name',
            'branch_name' => 'required_with:account_title,bank_name,account_number',
            'first_person_name' => 'required_with:emergency_contact_1|required_if:type,emergency_contact_details',
            'second_person_name' => 'required_with:emergency_contact_2',
            'emergency_contact_1' => 'required_with:first_person_name|required_if:type,emergency_contact_details|numeric',
            'emergency_contact_2' => 'required_with:second_person_name|numeric',
            'first_person_relationship' => 'required_with:first_person_name|string',
            'second_person_relationship' => 'required_with:second_person_name|string',
            'city' => 'nullable|string',
            'cnic' => 'nullable|string',
            'department_id' => 'nullable|numeric',
            'designation_id' => 'nullable|numeric',
            'email_address' => 'nullable|email',
            'enrollment_no' => 'nullable|string',
            'father_name' => 'nullable|string',
            'first_name' => 'nullable|string',
            'gender' => 'nullable|string|in:male,female',
            'last_name' => 'nullable|string',
            'primary_contact' => 'nullable|numeric',
            'registration_no' => 'nullable|string',
            'secondary_contact' => 'nullable|string',
            'type' => 'required|in:additional_information,bank_details,emergency_contact_details,employee',
        ];
    }
}
