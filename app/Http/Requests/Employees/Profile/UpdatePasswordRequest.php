<?php

namespace App\Http\Requests\Employees\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Gate::allows('is-employee'))
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
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'file' => 'mimes:jpeg,jpg,png,gif|max:40000'
        ];
    }
    public function validated()
    {
        $validated = parent::validated();
        $validated['password'] = Hash::make($this->password);
        return $validated;
    }
}
