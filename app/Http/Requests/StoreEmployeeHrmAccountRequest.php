<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class StoreEmployeeHrmAccountRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'secondary_email' => 'required|email|unique:users,secondary_email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' =>'required'
        ];
    }

    public function validated()
    {
        $validated = parent::validated();
        $validated['password'] = Hash::make($this->password);
        return array_merge($validated);    
    }   
}
